<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\User;
use App\Models\Level;
use App\Models\Gender;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;

class StudentController extends Controller
{

    use SiteOption, Permission;

    public function __construct(
        protected array $data = []
    ) {
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }


    public function index()
    {
        Permission::all_admin();

        $this->data['pageTitle'] = 'All Students';

        if(auth('admin')->user()->role_id == 3){

            $this->data['classes'] = auth('admin')->user()->classes;

        }else{

            $this->data['classes'] = Level::where('id', '!=', 1)->get();

        }

        return view('backend.admin.module.student.index', $this->data);
    }


    public function get_students(Request $request, int $class_id)
    {
        Permission::all_admin();

        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['students'] = User::where(['class_id' => $class_id])
                ->where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orderBy('id','DESC')
                ->paginate(15);
        } else {

            $this->data['students'] = User::where(['class_id' => $class_id])->orderBy('id','DESC')->paginate(15);
        }

        $this->data['pageTitle'] = 'Students';
        $this->data['class'] = Level::where(['id' => $class_id])->firstOrFail();

        return view('backend.admin.module.student.all', $this->data);
    }


    public function edit(int $student_id)
    {
        Permission::admin_only();

        $this->data['pageTitle'] = 'Modify Student';
        $this->data['student'] = User::where(['id' => $student_id])->firstOrFail();
        $this->data['classes'] = Level::all();
        $this->data['statuses'] = Status::all();
        $this->data['genders'] = Gender::where(['status_id' => 1])->get();

        return view('backend.admin.module.student.edit', $this->data);
    }


    public function create()
    {
        Permission::admin_only();

        $this->data['pageTitle'] = 'Add New Student';
        $this->data['classes'] = Level::all();
        $this->data['statuses'] = Status::all();
        $this->data['genders'] = Gender::where(['status_id' => 1])->get();

        return view('backend.admin.module.student.create', $this->data);
    }


    public function store(Request $request)
    {
        Permission::admin_only();

        $formFields = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'username' => ['required', 'min:6', 'unique:users,username'],
            'email' => ['required', 'email'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required'],
            'phone_number' => ['required', 'min:8'],
            'class_id' => ['required'],
            'status_id' => ['required'],
            'password' => ['required', 'confirmed'],
            'gender_id' => ['required']
        ]);

        $save = User::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'Student Created Successfully');
        }

        return redirect()->back()->with('failure', 'Student Not Created Successfully');
    }


    public function update(Request $request, int $student_id): RedirectResponse
    {
        Permission::admin_only();

        $formFields = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'username' => ['required', 'min:6'],
            'email' => ['required', 'email'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required'],
            'phone_number' => ['required', 'min:8'],
            'class_id' => ['required'],
            'status_id' => ['required'],
            'gender_id' => ['required']
        ]);

        $update = User::where(['id' => $student_id])->update($formFields);

        if ($update) {
            return redirect()->back()->with('success', 'Student Updated Successfully');
        }

        return redirect()->back()->with('failure', 'Student Not Updated Successfully');
    }


    public function update_profile_image(Request $request, int $student_id)
    {

        Permission::admin_only();

        $formField = $request->validate([
            'profile_image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif'],
        ]);


        $path = $request->file('profile_image')->store('students', 'public');

        $save = User::where(['id' => $student_id])->update([
            'profile_image' => $path
        ]);

        if (!$save) {
            return redirect()->back()->with('failure', 'Student Not Updated Successfully');
        }

        return redirect()->back()->with('success', 'Student Updated Successfully');
    }

    public function update_password(Request $request, int $student_id)
    {

        Permission::admin_only();

        $formFields = $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $newPassword = Hash::make($formFields['password']);
        $passwordUpdate = User::where(['id' => $student_id])->update(['password' => $newPassword]);

        if ($passwordUpdate) {
            return redirect()->back()->with('success', 'Password Updated Successfully');
        }

        return redirect()->back()->with('failure', 'Password Not Updated Successfully');
    }


    public function activate(int $student_id)
    {
        Permission::admin_only();

        $activate = User::where(['id' => $student_id])->update([
            'status_id' => 1
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Student Activated Successfully');
        }

        return redirect()->back()->with('failure', 'Student Not Activated Successfully');
    }



    public function deactivate(int $student_id)
    {
        Permission::admin_only();

        $activate = User::where(['id' => $student_id])->update([
            'status_id' => 2
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Student Deactivated Successfully');
        }

        return redirect()->back()->with('failure', 'Student Not Deactivated Successfully');
    }


    public function delete(int $student_id)
    {
        Permission::super_admin();

        try {

            $delete = User::where(['id' => $student_id])->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Student Deleted Successfully');
            }

            return redirect()->back()->with('failure', 'Student Not Deleted Successfully');
        } catch (QueryException $qe) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        } catch (Exception $e) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        }
    }
}
