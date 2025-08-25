<?php

namespace App\Http\Controllers\Dashboard\Student;

use Illuminate\Http\Request;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\LiveClass;

class LiveClassController extends Controller
{
    use SiteOption;

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
                ->where(['class_id' => auth()->user()->class_id])
                ->orderBy('id','DESC')
                ->paginate(15);
        } else {

            $this->data['live_classes'] = LiveClass::where(['class_id' => auth()->user()->class_id])->paginate(15);
        }


        return view('backend.student.module.liveclass.index', $this->data);
    }


    public function view(int $live_class_id)
    {
        $this->data['pageTitle'] = 'View Live Class Details';

        $this->data['live_class'] = LiveClass::where(['id' => $live_class_id])->firstOrFail();
  
        return view('backend.student.module.liveclass.view', $this->data);
    }
}
