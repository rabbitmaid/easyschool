<?php

namespace App\Http\Controllers\Authentication\Admin;

use App\Models\Role;
use App\Models\Admin;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Trait\SiteOption;
use App\Models\Course;
use App\Models\Gender;
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
        $this->data['courses'] = Course::where(['status_id' => 1])->where('id', '!=', 1)->get();
        $this->data['roles'] = Role::all();
        $this->data['genders'] = Gender::where(['status_id' => 1])->get();
        return view('auth.admin.register', $this->data);
    }


    public function create(Request $request): RedirectResponse
    {

        $formFields = $request->validate([
            'username' => ['required', 'min:6', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'confirmed'],
            'course' => ['required'],
            'date_of_birth' => ['required', 'date'],
            'role' => ['required'],
            'gender' => ['required'],
        ]);

        $hashedPassword = Hash::make($formFields['password']);
    
        $save = Admin::create([
            'username' => $formFields['username'],
            'email' => $formFields['email'],
            'password' => $hashedPassword,
            'course_id' => $formFields['course'],
            'status_id' => 1,
            'gender_id' => $formFields['gender'],
            'date_of_birth' => $formFields['date_of_birth'],
            'role_id' => $formFields['role']
        ]);


        if($save)
        {
            return redirect()->route('admin.login')->with('message', 'Account Created Successfully');
        }

        return redirect()->route('admin.register')->with('message', 'Account Not Created Successfully');

    }
}
