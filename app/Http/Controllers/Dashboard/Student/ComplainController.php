<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Admin;
use App\Models\Complain;
use App\Models\AdminClass;
use Illuminate\Http\Request;
use App\Models\ComplainReply;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Http\Trait\NotifyComplain;
use App\Models\NotificationComplainReply;

class ComplainController extends Controller
{
    use SiteOption, NotifyComplain;

    public function __construct(
        protected array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }

    
    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'All Complains';
        
        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['complains'] = Complain::where('title', 'LIKE', "%{$search}%")
              ->orWhere('message', 'LIKE', "%{$search}%")
              ->where(['user_id' => auth()->user()->id])
              ->orderBy('id', 'DESC')
              ->paginate(10);

          } else {
                $this->data['complains'] = Complain::where(['user_id' => auth()->user()->id])->orderBy('id', 'DESC')->paginate(10);
          }

      
        return view('backend.student.module.complain.index', $this->data);
    }


    public function create()
    {
        $this->data['pageTitle'] = 'Submit Complain';

        $this->data['admins'] = Admin::join('admin_class', 'admins.id', '=', 'admin_class.admin_id')
                                        ->where(['admins.status_id' => 1])
                                        ->where(['admins.role_id' => 3])
                                        ->where(['admin_class.class_id' => auth()->user()->class_id])
                                        ->get();

        return view('backend.student.module.complain.create', $this->data);
    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => ['required'],
            'message' => ['max:255', 'required'],
            'admin_id' => ['required'],
          ]);

        $formFields['user_id'] = auth()->user()->id;
      
        $save = Complain::create($formFields);
      
        if ($save) {
            // Create Complain Noficication
            NotifyComplain::run('new-complain', $formFields['title'], $save->id , auth()->user()->id, $formFields['admin_id'] , 'New complain from student ' . ucwords(auth()->user()->username));

            return redirect()->back()->with('success', 'Complain Submitted Successfully');
        }
        return redirect()->back()->with('failure', 'Complain Not Submitted Successfully');
    }


    public function edit(int $complain_id)
    {
        $this->data['pageTitle'] = 'Modify Complain';
        $this->data['complain'] = Complain::where(['id' => $complain_id])->firstOrFail();
        return view('backend.student.module.complain.edit', $this->data);
    }


    public function update(Request $request, int $complain_id)
    {

        $formFields = $request->validate([
            'title' => ['required'],
            'message' => ['max:255', 'nullable'],
        ]);

        $update = Complain::where(['id' => $complain_id])->update($formFields);

        if ($update) {
        return redirect()->back()->with('success', 'Complain Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Complain Not Updated Successfully');
    }

    public function view(int $complain_id)
    {
      $this->data['pageTitle'] = 'View Complain';
  
      $this->data['complain'] = Complain::where(['id' => $complain_id])->firstOrFail();
      $this->data['complain_replies'] = ComplainReply::where(['complain_id' => $this->data['complain']->id])->get();
  
      // Only super admin and owner and complain can access it
      if($this->data['complain']->user->id != auth()->user()->id){
          abort(403, 'Access Forbidden');
      }

      // If complained is opened set all replies as read   
      NotificationComplainReply::where(['complain_id' => $complain_id, 'user_id' => auth()->user()->id])->update([
            'is_read' => 1
      ]);
  
      return view('backend.student.module.complain.view', $this->data);
    }
  

}
