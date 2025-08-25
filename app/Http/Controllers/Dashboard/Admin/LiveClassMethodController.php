<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Exception;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Models\LiveClassMethod;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class LiveClassMethodController extends Controller
{
    use SiteOption, Permission;


    public function __construct(public array $data = [])
    {
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }


    public function index(Request $request)
    {
        Permission::admin_only();

        $this->data['pageTitle'] = 'All Live Class Methods';

        if ($request->query('search') != null) {
            $search = $request->query('search');
            $this->data['methods'] = LiveClassMethod::where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orderBy('id','DESC')
                ->paginate(15);
        } else {

            $this->data['methods'] = LiveClassMethod::paginate(15);
        }


      
        return view('backend.admin.module.liveclassmethod.index', $this->data);
    }


    public function create()
    {
        Permission::admin_only();

        $this->data['pageTitle'] = 'Add New Method';
        $this->data['statuses'] = Status::all();

        return view('backend.admin.module.liveclassmethod.create', $this->data);
    }


    public function store(Request $request)
    {

        Permission::admin_only();

        $formFields = $request->validate([
            'name' => ['required'],
            'description' => ['max:255', 'nullable'],
            'status_id' => ['required'],
        ]);

        $save = LiveClassMethod::create($formFields);

        if ($save) {
            return redirect()->back()->with('success', 'Method Created Successfully');
        }

        return redirect()->back()->with('failure', 'Method Not Created Successfully');

    }


    public function edit(int $method_id)
    {
        $this->data['pageTitle'] = "Modify Method";
        $this->data['method'] = LiveClassMethod::where(['id' => $method_id])->firstOrFail();
        $this->data['statuses'] = Status::all();

        return view('backend.admin.module.liveclassmethod.edit', $this->data);
    }


    public function update(Request $request, int $method_id)
    {
        Permission::admin_only();

        $formFields = $request->validate([
            'name' => ['required'],
            'description' => ['max:255', 'nullable'],
            'status_id' => ['required'],
        ]);

        $update = LiveClassMethod::where(['id' => $method_id])->update($formFields);

        if ($update) {
            return redirect()->back()->with('success', 'Method Updated Successfully');
        }
        return redirect()->back()->with('failure', 'Method Not Updated Successfully');
    }




    public function activate(int $method_id)
    {
        Permission::admin_only();

        $activate = LiveClassMethod::where(['id' => $method_id])->update([
            'status_id' => 1
        ]);

        if ($activate) {
            return redirect()->back()->with('success', 'Method Activated Successfully');
        }
        return redirect()->back()->with('failure', 'Method Not Activated Successfully');
    }


    public function deactivate(int $method_id)
    {
        Permission::admin_only();

        $deactivate = LiveClassMethod::where(['id' => $method_id])->update([
            'status_id' => 2
        ]);

        if ($deactivate) {
            return redirect()->back()->with('success', 'Method Deactivated Successfully');
        }

        return redirect()->back()->with('failure', 'Method Not Deactivated Successfully');
    }

    

    public function delete(Request $request, int $method_id)
    {
        Permission::super_admin();


        try {

            $delete = LiveClassMethod::where(['id' => $method_id])->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Method Deleted Successfully');
            }

            return redirect()->back()->with('failure', 'Method Not Deleted Successfully');
        } catch (QueryException $qe) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        } catch (Exception $e) {
            return redirect()->back()->with('failure', 'Unexpected Error! While carrying out command');
        }
    }

}
