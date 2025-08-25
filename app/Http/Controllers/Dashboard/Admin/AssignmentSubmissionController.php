<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;

class AssignmentSubmissionController extends Controller
{
    use SiteOption, Permission;

    public function __construct(
        public array $data = []
    ) {
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }

    public function index(Request $request)
    {
        Permission::all_admin();

        $this->data['pageTitle'] = 'All Assignment Submissions';


        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['assignment_submissions'] = AssignmentSubmission::join('assignments', 'assignments.id', '=', 'assignment_submissions.assignment_id')
                ->where('assignments.title', 'LIKE', "%{$search}%")
                ->orderBy('assignment_submissions.id', 'DESC')
                ->paginate(15);
        } else {

            $this->data['assignment_submissions'] = AssignmentSubmission::paginate(15);
        }




        return view('backend.admin.module.assignmentsubmission.index', $this->data);
    }



    public function assignment(Request $request, int $assignment_id)
    {
        Permission::all_admin();

        $this->data['pageTitle'] = 'All Assignment Submissions';


        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['assignment_submissions'] = AssignmentSubmission::join('assignments', 'assignments.id', '=', 'assignment_submissions.assignment_id')
                ->where('assignments.title', 'LIKE', "%{$search}%")
                ->where(['assignment_submissions.assignment_id' => $assignment_id])
                ->orderBy('assignment_submissions.id', 'DESC')
                ->paginate(15);
        } else {

            $this->data['assignment_submissions'] = AssignmentSubmission::where(['assignment_id' => $assignment_id])->paginate(15);
        }


        return view('backend.admin.module.assignmentsubmission.index', $this->data);
    }


    public function view(int $submission_id)
    {
        $this->data['pageTitle'] = "View Assignment Submission Details";
        $this->data['assignment_submission'] = AssignmentSubmission::where(['id' => $submission_id])->firstOrFail();

        return view('backend.admin.module.assignmentsubmission.view', $this->data);
    }


    public function delete(Request $request, int $submission_id)
    {
        Permission::super_admin();


        try {

            $delete = AssignmentSubmission::where(['id' => $submission_id])->delete();

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
