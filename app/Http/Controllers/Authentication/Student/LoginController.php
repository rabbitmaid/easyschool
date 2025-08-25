<?php

namespace App\Http\Controllers\Authentication\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{

    public function __construct(
        public array $data = []
    ){ 
        $this->data['siteTitle'] = Option::select('value')->where(['name' => 'site_title'])->first();
    }
    

    public function login()
    {
    
        $this->data['pageTitle'] = 'Authentication';
        return view('auth.student.login', $this->data);
    }


    public function authenticate(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status_id' => 1])){
   
            $request->session()->regenerate();
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');

    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
     
        return redirect()->route('student.login');
    }

}
