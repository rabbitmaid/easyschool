<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Level;
use App\Models\Course;
use App\Models\Status;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\AssignmentSubmission;
use Illuminate\Database\QueryException;

class AssignmentController extends Controller
{
    use SiteOption, Permission;

    public function __construct(
        public array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();    
    }


    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'All Assignments';

        if(auth('admin')->user()->role_id == 3){

            if ($request->query('search') != null) {
                $search = $request->query('search');
                $this->data['assignments'] = Assignment::where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->where(['admin_id' => auth('admin')->user()->id])
                    ->orderBy('id','DESC')
                    ->paginate(15);
            } else {
    
                $this->data['assignments'] = Assignment::where(['admin_id' => auth('admin')->user()->id])->paginate(15);
            }

        }else {

            if ($request->query('search') != null) {
                $search = $request->query('search');
                $this->data['assignments'] = Assignment::where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orderBy('id','DESC')
                    ->paginate(15);
            } else {
    
                $this->data['assignments'] = Assignment::paginate(15);
            }
        }


        return view('backend.admin.module.assignment.index', $this->data);
    }




    public function create()
    {
        Permission::all_admin();

        $this->data['pageTitle'] = 'Add New Assignment';
        $this->data['statuses'] = Status::all();
        $this->data['classes'] = Level::all();
        $this->data['courses'] = Course::all();

        return view('backend.admin.module.assignment.create', $this->data);
    }


    public function store(Request $request)
    {

        Permission::all_admin();

        $formFields = $request->validate([
            'title' => ['required'],
            'description' => ['max:255', 'nullable'],
            'class_id' => ['required'],
            'course_id' => ['required'],
            'status_id' => ['required'],
            'file' => ['mimes:docx,pdf,txt,jpg,png,zip', 'nullable'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable']
        ]);

        if($request->file('file')){
            $path = $request->file('file')->store('assignments', 'public');
            $formFields['file'] = $path;
        }

        $formFields['admin_id'] = auth('admin')->user()->id;
 
        $save = Assignment::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'Assignment Created Successfully');
        }

        return redirect()->back()->with('failure', 'Assignment Not Created Successfully');

    }


    
    public function edit(int $assignment_id)
    {
        $this->data['pageTitle'] = "Modify Assignment";
        $this->data['assignment'] = Assignment::where(['id' => $assignment_id])->firstOrFail();
        $this->data['statuses'] = Status::all();
        $this->data['classes'] = Level::all();
        $this->data['courses'] = Course::all();

        return view('backend.admin.module.assignment.edit', $this->data);
    }


    public function update(Request $request, int $assignment_id)
    {
        Permission::all_admin();

        $formFields = $request->validate([
            'title' => ['required'],
            'description' => ['max:255', 'nullable'],
            'class_id' => ['required'],
            'course_id' => ['required'],
            'status_id' => ['required'],
            'file' => ['mimes:docx,pdf,txt,jpg,png,zip', 'nullable']
        ]);

        if($request->file('file')){
             $path = $request->file('file')->store('assignments', 'public');
             $formFields['file'] = $path;
        }

        $update = Assignment::where(['id' => $assignment_id])->update($formFields);

        if ($update) {
            return redirect()->back()->with('success', 'Assignment Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Assignment Not Updated Successfully');
    }



    public function activate(int $assignment_id)
    {
        Permission::all_admin();

        $activate = Assignment::where(['id' => $assignment_id])->update([
            'status_id' => 1
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Assignment Activated Successfully');
        }
        return redirect()->back()->with('failure', 'Assignment Not Activated Successfully');
    }


    public function deactivate(int $assignment_id)
    {
        Permission::all_admin();

        $deactivate = Assignment::where(['id' => $assignment_id])->update([
            'status_id' => 2
        ]);

        if ($deactivate) {
            return redirect()->back()->with('success', 'Assignment Deactivated Successfully');
        }

        return redirect()->back()->with('failure', 'Assignment Not Deactivated Successfully');
    }

    

    public function delete(Request $request, int $assignment_id)
    {
        Permission::super_admin();


        try {

            $delete = Assignment::where(['id' => $assignment_id])->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Assignment Deleted Successfully');
            }

            return redirect()->back()->with('failure', 'Assignment Not Deleted Successfully');
        } catch (QueryException $qe) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        } catch (Exception $e) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        }
    }






}
