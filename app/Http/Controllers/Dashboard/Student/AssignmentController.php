<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\AssignmentSubmission;

class AssignmentController extends Controller
{
    use SiteOption;

    public function __construct(
        public array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }


    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'All Assignments';

        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['assignments'] = Assignment::where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->where(['class_id' => auth()->user()->class_id])
                ->orderBy('id','DESC')
                ->paginate(15);
        } else {

            $this->data['assignments'] = Assignment::where(['class_id' => auth()->user()->class_id])->paginate(15);
        }


        return view('backend.student.module.assignment.index', $this->data);
    }


    public function view(int $assignment_id){
        $this->data['pageTitle'] = "View Assignment";
        $this->data['assignment'] = Assignment::where(['id' => $assignment_id])->firstOrFail();

        return view('backend.student.module.assignment.view', $this->data);
    }


    public function submit(int $assignment_id)
    {

        $this->data['pageTitle'] = 'Submit Assignment';
        $this->data['assignment'] = Assignment::where(['id' => $assignment_id])->firstOrFail();

        // You cannot submit if time as passed
        if((isset($this->data['assignment']->end_time) && $this->data['assignment']->end_time < now() ) || $this->data['assignment']->status_id == 2){
            abort('403', 'Late Submission Not Allowed');
        }

        $this->data['assignment_submissions'] = AssignmentSubmission::where(['assignment_id' => $assignment_id, 'user_id' => auth()->user()->id])->get();

        return view('backend.student.module.assignment.submit', $this->data);
    }


    public function submit_store(Request $request)
    {
        $formFields = $request->validate([
            'assignment_id' => ['required'],
            'user_id' => ['required'],
            'file' => ['mimes:docx,pdf,txt,jpg,png,zip', 'nullable'],
            'notes' => ['nullable'],
        ]);

        if($request->file('file')){
            $path = $request->file('file')->store('assignment_submissions', 'public');
            $formFields['file'] = $path;
        }

        $formFields['admin_id'] = auth('admin')->user()->id;


        $save = AssignmentSubmission::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'Assignment Submitted Successfully');
        }

        return redirect()->back()->with('failure', 'Assignment Not Submitted Successfully');

    }

}
