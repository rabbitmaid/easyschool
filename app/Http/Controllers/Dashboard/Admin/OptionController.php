<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\Option;

class OptionController extends Controller
{
    use SiteOption, Permission;

    public function __construct(public array $data = []){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }

    public function index()
    {

        Permission::admin_only();

        $this->data['pageTitle'] = "Site Options";
        $this->data['options'] = Option::all();

        return view('backend.admin.module.setting.index', $this->data);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'site_title' => 'required',
            'site_tag' => 'required'
        ]);

        foreach($formFields as $key => $value)
        {
            $update = Option::where(['name' => $key])->update([
                'value' => $value
            ]);
        }

        if ($update) {
            return redirect()->back()->with('success', 'Option update Successfully');
        }
        return redirect()->back()->with('failure', 'Option Not Updated Successfully');
    }


}
