<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Status;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Models\ComplainReply;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Trait\NotifyComplainReply;
use App\Http\Controllers\Controller;
use App\Models\NotificationComplain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ComplainController extends Controller
{
  use SiteOption, Permission, NotifyComplainReply;

  public function __construct(
    public array $data = []
  ) {
    $this->data['siteTitle'] = SiteOption::siteTitle();
  }


  public function index(Request $request)
  {
    Permission::all_admin();

    // Let only super admin and admin users see all complains
    if(in_array(Auth::guard('admin')->user()->role_id, [1,2])){
    
        if ($request->query('search') != null) {
          $search = $request->query('search');
          $this->data['complains'] = Complain::where('title', 'LIKE', "%{$search}%")
            ->orWhere('message', 'LIKE', "%{$search}%")
            ->orderBy('id', 'DESC')
            ->paginate(10);
        } else {
          $this->data['complains'] = Complain::orderBy('id', 'DESC')->paginate(10);
        }

    }else{

        if ($request->query('search') != null) {
          $search = $request->query('search');
          $this->data['complains'] = Complain::where('title', 'LIKE', "%{$search}%")
            ->orWhere('message', 'LIKE', "%{$search}%")
            ->where(['admin_id' => Auth::guard('admin')->user()->id])
            ->orderBy('id', 'DESC')
            ->paginate(10);
        } else {
          $this->data['complains'] = Complain::orderBy('id', 'DESC')->where(['admin_id' => Auth::guard('admin')->user()->id])->orderBy('id', 'DESC')->paginate(10);
        }

    }


    $this->data['pageTitle'] = "All Complains";

    return view('backend.admin.module.complain.index', $this->data);
  }



  public function edit(int $complain_id)
  {
    $this->data['pageTitle'] = 'Modify Complain';
    $this->data['complain'] = Complain::where(['id' => $complain_id])->firstOrFail();
    $this->data['statuses'] = Status::all();
    return view('backend.admin.module.complain.edit', $this->data);
  }


  public function update(Request $request, int $complain_id)
  {

    Permission::admin_only();

    $formFields = $request->validate([
      'title' => ['required'],
      'message' => ['max:255', 'nullable'],
      'is_read' => ['required'],
    ]);

    $update = Complain::where(['id' => $complain_id])->update($formFields);

    if ($update) {
      return redirect()->back()->with('success', 'Complain Updated Successfully');
    }
    return redirect()->back()->with('failure', 'Complain Not Updated Successfully');
  }


  public function view(int $complain_id)
  {
    Permission::all_admin();

    $this->data['pageTitle'] = 'View Complain';

    // Update view state
    Complain::where(['id' => $complain_id])->update([
      'is_read' => 1
    ]);

    NotificationComplain::where(['complain_id' => $complain_id, 'is_read' => 0])->update([
      'is_read' => 1
    ]);

    $this->data['complain'] = Complain::where(['id' => $complain_id])->firstOrFail();
    $this->data['complain_replies'] = ComplainReply::where(['complain_id' => $this->data['complain']->id])->get();

    // Only super admin and owner and complain can access it
    if($this->data['complain']->admin->id != auth('admin')->user()->id && auth('admin')->user()->role_id != 1){
        abort(403, 'Access Forbidden');
    }

    return view('backend.admin.module.complain.view', $this->data);
  }



  public function reply(Request $request){

      Permission::all_admin();

      $formFields = $request->validate([
        'complain_id' => ['required'],
        'admin_id' => ['required'],
        'reply' => ['max:255', 'required']
      ]);

      $save = ComplainReply::create($formFields);

      if ($save) {
        
          $complain = Complain::find($formFields['complain_id']);

          NotifyComplainReply::run('reply-complain', 'Complain Reply for ' . $complain->title , $formFields['complain_id'], $complain->user_id , $formFields['admin_id'], 'New complain reply from ' . ucwords(auth()->user()->username));

          return redirect()->back()->with('success', 'Comment Submitted Successfully');
      }
      return redirect()->back()->with('failure', 'Comment Not Submitted Successfully');
  }



  public function delete(Request $request, int $course_id)
  {
    Permission::super_admin();

    try {

      $delete = Complain::where(['id' => $course_id])->delete();

      if ($delete) {
        return redirect()->back()->with('success', 'Complain Deleted Successfully');
      }

      return redirect()->back()->with('failure', 'Complain Not Deleted Successfully');
    } catch (QueryException $qe) {
      return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
    } catch (Exception $e) {
      return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
    }
  }
}
