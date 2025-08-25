<?php

namespace App\Http\Controllers\Authentication\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('auth.admin.login', $this->data);
    }
    

    public function authenticate(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::guard('admin')->attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status_id' => 1])){
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');

    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
     
        return redirect()->route('admin.login');
    }

}
