<?php

namespace App\Http\Controllers\Authentication\Student;

use App\Models\User;
use App\Models\Level;
use App\Models\Gender;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Trait\SiteOption;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{

    use SiteOption;

    public function __construct(
        public array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }
    

    public function register()
    {
        $this->data['pageTitle'] = 'Registration';
        $this->data['classes'] = Level::where(['status_id' => 1])->where('id', '!=', 1)->get();
        $this->data['genders'] = Gender::where(['status_id' => 1])->get();
        return view('auth.student.register', $this->data);
    }


    public function create(Request $request): RedirectResponse
    {

        $formFields = $request->validate([
            'username' => ['required', 'min:6', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'class' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required', 'date'],
        ]);

        $hashedPassword = Hash::make($formFields['password']);
    
        $save = User::create([
            'username' => $formFields['username'],
            'email' => $formFields['email'],
            'password' => $hashedPassword,
            'class_id' => $formFields['class'],
            'status_id' => 1,
            'gender_id' => $formFields['gender'],
            'date_of_birth' => $formFields['date_of_birth']
        ]);


        if($save)
        {
            return redirect()->route('student.login')->with('message', 'Account Created Successfully');
        }

        return redirect()->route('student.register')->with('message', 'Account Not Created Successfully');

    }
}




