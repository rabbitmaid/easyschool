<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Level;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ClassController extends Controller
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
            $this->data['classes'] = Level::where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->whereNot('id', '!=', 1)
                ->orderBy('id','DESC')
                ->paginate(15);
        } else {

            $this->data['classes'] = Level::where('id', '!=', 1)->orderBy('id','DESC')->paginate(15);
        }

        $this->data['pageTitle'] = "All Classes";
     
        return view('backend.admin.module.class.index', $this->data);
    }


    public function create()
    {
        Permission::admin_only();

        $this->data['pageTitle'] = 'Add New Class';
        $this->data['statuses'] = Status::all();

        return view('backend.admin.module.class.create', $this->data);
    }


    public function store(Request $request)
    {
        Permission::admin_only();

        $formFields = $request->validate([
            'name' => ['required'],
            'description' => ['max:255', 'nullable'],
            'status_id' => ['required'],
        ]);

        $save = Level::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'Class Created Successfully');
        }

        return redirect()->back()->with('failure', 'Class Not Created Successfully');

    }


    public function edit(int $class_id)
    {
        $this->data['pageTitle'] = "Modify Class";
        $this->data['class'] = Level::where(['id' => $class_id])->firstOrFail();
        $this->data['statuses'] = Status::all();

        return view('backend.admin.module.class.edit', $this->data);
    }



    public function update(Request $request, int $class_id)
    {
        Permission::admin_only();

        $formFields = $request->validate([
            'name' => ['required'],
            'description' => ['max:255', 'nullable'],
            'status_id' => ['required'],
        ]);

        $update = Level::where(['id' => $class_id])->update($formFields);

        if ($update) {
            return redirect()->back()->with('success', 'Class Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Class Not Updated Successfully');
    }




    public function activate(int $class_id)
    {
        Permission::admin_only();

        $activate = Level::where(['id' => $class_id])->update([
            'status_id' => 1
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Class Activated Successfully');
        }
        return redirect()->back()->with('failure', 'Class Not Activated Successfully');
    }


    public function deactivate(int $class_id)
    {
        Permission::admin_only();

        $deactivate = Level::where(['id' => $class_id])->update([
            'status_id' => 2
        ]);

        if ($deactivate) {
            return redirect()->back()->with('success', 'Class Deactivated Successfully');
        }

        return redirect()->back()->with('failure', 'Class Not Deactivated Successfully');
    }


    public function delete(int $class_id)
    {
        Permission::super_admin();


        try {

            $delete = Level::where(['id' => $class_id])->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Class Deleted Successfully');
            }

            return redirect()->back()->with('failure', 'Class Not Deleted Successfully');
        } catch (QueryException $qe) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        } catch (Exception $e) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        }
    }

}
