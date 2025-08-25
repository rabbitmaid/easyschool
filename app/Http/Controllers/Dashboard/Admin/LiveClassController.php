<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Admin;
use App\Models\Level;
use App\Models\Status;
use App\Models\LiveClass;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\LiveClassMethod;
use Illuminate\Database\QueryException;

class LiveClassController extends Controller
{
    use SiteOption, Permission;

    public function __construct(
        public array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();    
    }


    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'All Live Classes';

        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['live_classes'] = LiveClass::where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orderBy('id','DESC')
                ->paginate(15);
        } else {

            $this->data['live_classes'] = LiveClass::paginate(15);
        }


        return view('backend.admin.module.liveclass.index', $this->data);
    }


    public function create()
    {
        Permission::all_admin();

        $this->data['pageTitle'] = 'Add New Live Class';
        
        $this->data['statuses'] = Status::all();
        $this->data['methods'] = LiveClassMethod::where(['status_id' => 1])->get();
        $this->data['classes'] = Level::all();
        $this->data['admins'] = Admin::where(['role_id' => 3])->get();
        return view('backend.admin.module.liveclass.create', $this->data);
    }


    public function store(Request $request)
    {

        Permission::admin_only();

        $formFields = $request->validate([
            'title' => ['required'],
            'description' => ['max:255', 'nullable'],
            'link' => ['required'],
            'live_class_method_id' => ['required'],
            'status_id' => ['required'],
            'class_id' => ['required'],
            'admin_id' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required']
        ]);

        $save = LiveClass::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'LiveClass Created Successfully');
        }

        return redirect()->back()->with('failure', 'LiveClass Not Created Successfully');

    }



    public function edit(int $live_class_id)
    {
        $this->data['pageTitle'] = "Modify Live Class";
        $this->data['liveclass'] = LiveClass::where(['id' => $live_class_id])->firstOrFail();
        $this->data['statuses'] = Status::all();
        $this->data['methods'] = LiveClassMethod::where(['status_id' => 1])->get();
        $this->data['classes'] = Level::all();
        $this->data['admins'] = Admin::where(['role_id' => 3])->get();

        return view('backend.admin.module.liveclass.edit', $this->data);
    }


    public function update(Request $request, int $live_class_id)
    {

        Permission::admin_only();

        $formFields = $request->validate([
            'title' => ['required'],
            'description' => ['max:255', 'nullable'],
            'link' => ['required'],
            'live_class_method_id' => ['required'],
            'status_id' => ['required'],
            'class_id' => ['nullable'],
            'admin_id' => ['nullable'],
            'start_time' => ['required'],
            'end_time' => ['required']
        ]);

        if(!isset($formFields['admin_id']) || ($formFields['class_id'])){

            $update = LiveClass::where(['id' => $live_class_id])->update([
                'title' => $formFields['title'],
                'description' => $formFields['description'],
                'link' => $formFields['link'],
                'live_class_method_id' => $formFields['live_class_method_id'],
                'status_id' => $formFields['status_id'],
                'start_time' => $formFields['start_time'],
                'end_time' => $formFields['end_time'],
            ]);

        }else{

            $update = LiveClass::where(['id' => $live_class_id])->update($formFields);
        }

       
        if ($update) {
            return redirect()->back()->with('success', 'Live Class Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Live Class Not Updated Successfully');
    }



    public function activate(int $live_class_id)
    {
        Permission::admin_only();

        $activate = LiveClass::where(['id' => $live_class_id])->update([
            'status_id' => 1
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Live Class Activated Successfully');
        }
        return redirect()->back()->with('failure', 'Live Class Not Activated Successfully');
    }


    public function deactivate(int $live_class_id)
    {
        Permission::admin_only();

        $deactivate = LiveClass::where(['id' => $live_class_id])->update([
            'status_id' => 2
        ]);

        if ($deactivate) {
            return redirect()->back()->with('success', 'Live Class Deactivated Successfully');
        }

        return redirect()->back()->with('failure', 'Live Class Not Deactivated Successfully');
    }

    

    public function delete(Request $request, int $live_class_id)
    {
        Permission::super_admin();


        try {

            $delete = LiveClass::where(['id' => $live_class_id])->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Live Class Deleted Successfully');
            }

            return redirect()->back()->with('failure', 'Live Class Not Deleted Successfully');
        } catch (QueryException $qe) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        } catch (Exception $e) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        }
    }




}
