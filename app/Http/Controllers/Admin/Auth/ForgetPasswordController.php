<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\EmailHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index()
    {
        return view('admin.auth.forget_password');
    }

    public function forgetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns|exists:users,email,type,1,status,1',
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
            <a href=" . route('admin.auth.reset.password', $token) . ">Click here to reset your password</a>
        </p>
        <p>If you did not request a password reset, no further action is required.</p>";

        $email = EmailHelper::sendEmail($request->email, $subject, $content);
        if ($email) {
            return redirect()->route('admin.auth.login')->with('success', 'We have e-mailed your password reset link!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }
}
