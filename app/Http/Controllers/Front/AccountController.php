<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/')->with('loggedInNotification', 'User is already logged in!'); // Redirect to the home page or any other page
        }
        return view('front.account.login');
    }

    public function checkLogin(Request $request)
    {
//        $credentials = [
//            'email' => $request->email,
//            'password' => $request->password,
//            'level' => 2,
//        ];

//        var_dump($credentials);


        $user = User::where('email', $request->email)
            ->where('level', 2)
            ->first();

//        var_dump($user);


        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->remember);
            return redirect('');
        } else {
            return back()->with('loginNotification', 'Login failed. Check your entered information!');
//            return back()->with('loginNotification', 'Đăng nhập không thành công, vui lòng kiểm tra lại thông tin đã nhập!');
        }

//        if (Auth::attempt($credentials, $savePassword)){
//            return 'Success!';
//        }else {
//            return 'Failed!';
//        }
    }

    public function logout()
    {
        Auth::logout();

        return back();
    }

}
