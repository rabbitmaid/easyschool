<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Level;
use App\Models\Course;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CourseController extends Controller
{
    use SiteOption, Permission;

    public function __construct(public array $data = []){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }


    public function index(Request $request)
    {

        Permission::admin_only();

        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['courses'] = Course::where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->whereNot('id', '!=', 1)
                ->orderBy('id','DESC')
                ->paginate(15);
        } else {

            $this->data['courses'] = Course::where('id', '!=', 1)->orderBy('id','DESC')->paginate(15);
        }

        $this->data['pageTitle'] = "All Courses";
     
        return view('backend.admin.module.course.index', $this->data);
    }


    public function create()
    {
        Permission::admin_only();

        $this->data['pageTitle'] = 'Add New Course';
        $this->data['statuses'] = Status::all();
        $this->data['classes'] = Level::all();

        return view('backend.admin.module.course.create', $this->data);
    }


    public function store(Request $request)
    {

        Permission::admin_only();

        $formFields = $request->validate([
            'name' => ['required'],
            'description' => ['max:255', 'nullable'],
            'class_id' => ['required'],
            'status_id' => ['required'],
        ]);

        $save = Course::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'Course Created Successfully');
        }

        return redirect()->back()->with('failure', 'Course Not Created Successfully');

    }

    public function edit(int $course_id)
    {
        $this->data['pageTitle'] = "Modify Course";
        $this->data['course'] = Course::where(['id' => $course_id])->firstOrFail();
        $this->data['statuses'] = Status::all();
        $this->data['classes'] = Level::all();

        return view('backend.admin.module.course.edit', $this->data);
    }


    public function update(Request $request, int $course_id)
    {
        Permission::admin_only();

        $formFields = $request->validate([
            'name' => ['required'],
            'description' => ['max:255', 'nullable'],
            'class_id' => ['required'],
            'status_id' => ['required'],
        ]);

        $update = Course::where(['id' => $course_id])->update($formFields);

        if ($update) {
            return redirect()->back()->with('success', 'Course Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Course Not Updated Successfully');
    }


    public function activate(int $course_id)
    {
        Permission::admin_only();

        $activate = Course::where(['id' => $course_id])->update([
            'status_id' => 1
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Course Activated Successfully');
        }
        return redirect()->back()->with('failure', 'Course Not Activated Successfully');
    }


    public function deactivate(int $course_id)
    {
        Permission::admin_only();

        $deactivate = Course::where(['id' => $course_id])->update([
            'status_id' => 2
        ]);

        if ($deactivate) {
            return redirect()->back()->with('success', 'Course Deactivated Successfully');
        }

        return redirect()->back()->with('failure', 'Course Not Deactivated Successfully');
    }

    

    public function delete(Request $request, int $course_id)
    {
        Permission::super_admin();


        try {

            $delete = Course::where(['id' => $course_id])->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Course Deleted Successfully');
            }

            return redirect()->back()->with('failure', 'Course Not Deleted Successfully');
        } catch (QueryException $qe) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        } catch (Exception $e) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        }
    }

}
