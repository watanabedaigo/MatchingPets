<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('admin.login');
    }
    
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'email|required',
    //         'password' => 'required|min:8',
    //     ]);
    //     if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
    //         return redirect()->route('top');//リダイレクト先は好きなところへ
    //     }else{
    //         return redirect()->back()->with('ログインに失敗しました');
    //     }
    // }

    protected function guard()
    {
        return Auth::guard('admin');
    }
   
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
}
