<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    use SiteOption;

    public function __construct(
        protected array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }

    
    public function index()
    {
        $this->data['pageTitle'] = 'Profile Settings';
        $this->data['genders'] = Gender::where(['status_id' => 1])->get();
        return view('backend.admin.profile', $this->data);

    }


    public function update_profile(Request $request) : RedirectResponse
    {

        $formFields = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'username' => ['required', 'min:6'],
            'email' => ['required', 'email'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required'],
            'phone_number' => ['required', 'min:8'],
            'gender_id' => ['required']
        ]);

        $update = Admin::where(['id' => Auth::guard('admin')->user()->id])->update($formFields);

        if($update){
            return redirect()->route('admin.profile')->with('success', 'Profile Updated Successfully');
        }

        return redirect()->route('admin.profile')->with('failure', 'Profile Not Updated Successfully');

    }


    public function update_password(Request $request)
    {

        $formFields = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if(!password_verify($formFields['old_password'], Auth::guard('admin')->user()->password)){
            return redirect()->route('student.profile')->with('failure', 'Incorrect Old Password');
        }

        $newPassword = Hash::make($formFields['password']);
        $passwordUpdate = Admin::where(['id' => Auth::guard('admin')->user()->id])->update(['password' => $newPassword]);

        if($passwordUpdate){
            return redirect()->route('admin.profile')->with('success', 'Password Updated Successfully');
        }
      
        return redirect()->route('admin.profile')->with('failure', 'Password Not Updated Successfully');
    }



    public function update_profile_image(Request $request)
    {

        $formField = $request->validate([
            'profile_image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif'],
        ]);


        $path = $request->file('profile_image')->store('admins', 'public');

        $save = Admin::where(['id' => Auth::guard('admin')->user()->id])->update([
            'profile_image' => $path
        ]);

        if(!$save){
            return redirect()->route('admin.profile')->with('failure', 'Profile Image Not Updated');
        }

        return redirect()->route('admin.profile')->with('success', 'Profile Image Updated');

    }
}
