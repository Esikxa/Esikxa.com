<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Helpers\ConstantHelper;
use App\Helpers\EmailHelper;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function registerView(Request $request)
    {
        $countries = Country::where('title', 'Nepal')->where('status', ConstantHelper::STATUS_ACTIVE)->pluck('title', 'id')->toArray();
        $grades = Grade::where('status', ConstantHelper::STATUS_ACTIVE)->pluck('title', 'id')->toArray();
        $subjects = Subject::where('status', ConstantHelper::STATUS_ACTIVE)->pluck('title', 'id')->toArray();
        $data = [
            'countries' => $countries,
            'grades' => $grades,
            'subjects' => $subjects
        ];
        // dd($data);
        return view('frontend.student.auth.register', $data);
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,3,type',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|digits:10|unique:users,mobile,3,type'
        ]);
        // dd($request->all());
        try {
            DB::beginTransaction();
            $user_data = [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make('password'),
                'type' => ConstantHelper::USER_TYPE_STUDENT,

            ];
            $user = User::create($user_data);
            if ($user) {
                $student_data = [
                    'user_id' => $user->id,
                    'grade' => $request->grade,
                    'country' => $request->country,
                    'institute' => $request->institute,
                    'expected_tution_fee' => $request->expected_tution_fee,
                    'major_subjects' => json_encode($request->major_subjects),
                    'preferred_shift' => $request->preferred_shift,
                    'preferred_time_start' => $request->preferred_time_start,
                    'preferred_time_end' => $request->preferred_time_end,
                    'additional_info' => $request->additional_info,
                    'accept_term_condition' => $request->accept_term_condition,
                ];
                Student::create($student_data);
            }
            DB::commit();
            return redirect()->route('student.login')->with('success', 'The account has been created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            return redirect()->back()->with('error', $th->getMessage());

            //throw $th;
        }
    }
    public function loginView(Request $request)
    {
        return view('frontend.student.auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email,type,3,status,1',
            'password' => 'required|min:6'
        ]);
        $credentials = $request->except(['_token', 'remember']);
        $remember = $request->has('remember') ? true : false;

        if (Auth::guard('student')->attempt($credentials, $remember)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->back()->withInput()->with('error', trans('auth.failed'));
        }
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // if ($response = $this->loggedOut($request)) {
        //     return $response;
        // }
        return $request->wantsJson()
            ? new JsonResource([], 204)
            : redirect()->route('student.login')->with('success', $request->message ?? 'You have been logged out!!');
    }


    protected function loggedOut(Request $request)
    {
        //
    }
    protected function guard()
    {
        return Auth::guard('student');
    }

    public function forgetPasswordView()
    {
        return view('student.auth.forget');
    }
    public function forgetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns|exists:users,email,type,3,status,1',
        ]);
        $token = Str::random(64);
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $subject = 'Reset Password';
        $content = "<h1>Reset Password Notification</h1>
        <p>Hello,</p>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <p>
            <a href=" . route('student.reset.password', $token) . ">Click here to reset your password</a>
        </p>
        <p>If you did not request a password reset, no further action is required.</p>";

        $email = EmailHelper::sendEmail($request->email, $subject, $content);
        if ($email) {
            return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }

    public function resetPasswordView($token)
    {
        $data = DB::table('password_reset_tokens')->where('token', $token)->first();
        if (!$data) {
            abort(404);
        }
        return view('student.auth.reset', ['data' => $data]);
    }

    public function resetPassword(Request $request, $token)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6',
            'confirm-password' => 'required|same:password',
        ]);

        $data = DB::table('password_reset_tokens')->where('token', $token)->first();
        if (!$data) {
            return redirect()->route('admin.auth.forget.password')->with('error', 'Link might be broken please try again');
        }
        $user = User::where('email', $data->email)->where('type', 3)->first();
        if (!$user) {
            return back()->with('error', 'Detail not found!');
        }
        try {
            DB::beginTransaction();
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            DB::commit();
            return redirect()->route('student.login.view')->with('success', 'Password reset successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }
}