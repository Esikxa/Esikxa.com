<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index($token)
    {
        $data = DB::table('password_reset_tokens')->where('token', $token)->first();
        if (!$data) {
            abort(404);
        }
        return view('admin.auth.reset_password', ['data' => $data]);
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
        $user = User::where('email', $data->email)->where('type', 1)->first();
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
            return redirect()->route('admin.auth.login')->with('success', 'Password reset successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }
}
