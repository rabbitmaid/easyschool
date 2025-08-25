<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Level;
use App\Models\Course;
use App\Models\Gender;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\AdminClass;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;

class TeacherController extends Controller
{

    use SiteOption, Permission;

    public function __construct(
        protected array $data = []
    ) {
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }

    public function index(Request $request)
    {
        Permission::admin_only();

        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['teachers'] = Admin::where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orderBy('id', 'DESC')
                ->paginate(15);
        } else {
            $this->data['teachers'] = Admin::orderBy('id', 'DESC')->paginate(15);
        }

        $this->data['pageTitle'] = 'All Teachers and Admins';

        return view('backend.admin.module.teacher.index', $this->data);
    }


    public function edit(int $admin_id)
    {
        Permission::admin_only();

        if ($admin_id === auth('admin')->user()->id) {
            return redirect()->back()->with('failure', 'Sorry! You View Yourself');
        }

        $this->data['pageTitle'] = 'Modify Teacher or Admins';
        $this->data['teacher'] = Admin::where(['id' => $admin_id])->firstOrFail();
        $this->data['statuses'] = Status::all();
        $this->data['genders'] = Gender::where(['status_id' => 1])->get();
        $this->data['courses'] = Course::where(['status_id' => 1])->get();
        $this->data['roles'] = Role::all();

        return view('backend.admin.module.teacher.edit', $this->data);
    }


    public function activate(int $admin_id)
    {
        Permission::admin_only();

        if ($admin_id === auth('admin')->user()->id) {
            return redirect()->back()->with('failure', 'Sorry! You cannot Activate Yourself');
        }

        $activate = Admin::where(['id' => $admin_id])->update([
            'status_id' => 1
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Administrator Activated Successfully');
        }
        return redirect()->back()->with('failure', 'Administrator Not Activated Successfully');
    }



    public function deactivate(int $admin_id)
    {
        Permission::admin_only();

        if ($admin_id === auth('admin')->user()->id) {
            return redirect()->back()->with('failure', 'Sorry! You cannot Deactivate Yourself');
        }

        $activate = Admin::where(['id' => $admin_id])->update([
            'status_id' => 2
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Administrator Deactivated Successfully');
        }
        return redirect()->back()->with('failure', 'Administrator Not Deactivated Successfully');
    }


    public function create()
    {
        Permission::admin_only();

        $this->data['pageTitle'] = 'Add New Teacher / Administrator';
        $this->data['courses'] = Course::where(['status_id' => 1])->get();
        $this->data['statuses'] = Status::all();
        $this->data['roles'] = Role::all();
        $this->data['genders'] = Gender::where(['status_id' => 1])->get();

        return view('backend.admin.module.teacher.create', $this->data);
    }



    public function assign(int $teacher_id)
    {

        Permission::admin_only();


        $this->data['pageTitle'] = "Assign Classes to Teacher";
        $this->data['classes'] = Level::where('id', '!=', 1)->where(['status_id' => 1])->get();
        $this->data['teacher'] = Admin::where(['id' => $teacher_id])->first();
        $this->data['teacherClass'] = AdminClass::where(['admin_id' => $teacher_id])->get();

        return view('backend.admin.module.teacher.assign', $this->data);
    }



    public function saveAsign(Request $request)
    {

        $formFields = $request->validate([
            'teacher_id' => ['required'],
            'class' => ['nullable']
        ]);

    

        // If all have been deleted, insert new assignment
        // Check also if class array is empty, delete all in db if yes

        if (isset($formFields['class']) && !empty($formFields['class']) && count($formFields['class']) > 0) {

            // If the count the number of assignments is greater than 0
            $countNumberOfAssignments = AdminClass::where(['admin_id' => $formFields['teacher_id']])->count();

            if ($countNumberOfAssignments > 0) {

                // Delete all existing assignments
                $delete = AdminClass::where(['admin_id' => $formFields['teacher_id']])->delete();

                if (!$delete) {
                    return redirect()->back()->with('failure', 'Unexpected error! during assignment');
                }
            }

            // remove duplicate entries from array
            $uniqueClass = array_unique($formFields['class']);


            foreach($uniqueClass as $class){
                $assign = AdminClass::create([
                    'admin_id' => $formFields['teacher_id'],
                    'class_id' => $class
                ]);
            }

            // Assign
            if ($assign) {
                return redirect()->back()->with('success', 'Class Assigned to Teacher Successfully');
            } else {
                return redirect()->back()->with('failure', 'Unexpected error! during assignment');
            }
        } 
        else {

            // Check if there is a duplicate in the formFields class array submission

            $delete = AdminClass::where(['admin_id' => $formFields['teacher_id']])->delete();

            if (!$delete) {
                return redirect()->back()->with('failure', 'Unexpected error! during assignment');
            }


            return redirect()->back()->with('success', 'Class Assigned to Teacher Successfully');
        }
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
            'course_id' => ['required'],
            'status_id' => ['required'],
            'password' => ['required', 'confirmed'],
            'gender_id' => ['required'],
            'role_id' => ['required']
        ]);

        $save = Admin::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'Teachers / Administrator Created Successfully');
        }

        return redirect()->back()->with('failure', 'Teachers / Administrator Not Created Successfully');
    }



    public function update(Request $request, int $teacher_id): RedirectResponse
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
            'course_id' => ['required'],
            'status_id' => ['required'],
            'gender_id' => ['required'],
            'role_id' => ['required']
        ]);

        $update = Admin::where(['id' => $teacher_id])->update($formFields);

        if ($update) {
            return redirect()->back()->with('success', 'Teachers / Administrator Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Teachers / Administrator Not Updated Successfully');
    }


    public function update_profile_image(Request $request, int $teacher_id)
    {
        Permission::admin_only();

        $formField = $request->validate([
            'profile_image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif'],
        ]);

        $path = $request->file('profile_image')->store('teachers', 'public');

        $save = Admin::where(['id' => $teacher_id])->update([
            'profile_image' => $path
        ]);

        if (!$save) {
            return redirect()->back()->with('failure', 'Teachers / Administrator Not Updated Successfully');
        }
        return redirect()->back()->with('success', 'Teachers / Administrator Updated Successfully');
    }



    public function update_password(Request $request, int $teacher_id)
    {
        Permission::admin_only();

        $formFields = $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $newPassword = Hash::make($formFields['password']);
        $passwordUpdate = Admin::where(['id' => $teacher_id])->update(['password' => $newPassword]);

        if ($passwordUpdate) {
            return redirect()->back()->with('success', 'Password Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Password Not Updated Successfully');
    }



    public function delete(int $admin_id)
    {
        Permission::super_admin();
        // Check if user is trying to delete his/herself
        if ($admin_id === auth('admin')->user()->id) {
            return redirect()->back()->with('failure', 'Sorry! You cannot Delete Yourself');
        }

        try {

            $delete = Admin::where(['id' => $admin_id])->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Teachers / Administrator Deleted Successfully');
            }

            return redirect()->back()->with('failure', 'Teachers / Administrator Not Deleted Successfully');
        } catch (QueryException $qe) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        } catch (Exception $e) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        }
    }
}
