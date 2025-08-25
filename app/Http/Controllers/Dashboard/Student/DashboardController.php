<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\User;
use App\Models\Course;
use App\Models\Option;
use App\Models\Complain;
use App\Models\LiveClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    
    public function __construct(
        protected array $data = []
    ){
        $this->data['siteTitle'] = Option::select('value')->where(['name' => 'site_title'])->first();
    }


    public function index()
    {
        $this->data['pageTitle'] = 'Analytics';
        $this->data['totalAssignments'] = Assignment::where(['class_id' => auth()->user()->class_id])->count();
        $this->data['totalCourses'] = Course::where(['class_id' => auth()->user()->class_id])->count();
        $this->data['totalComplains'] = Complain::where(['user_id' => auth()->user()->id])->count();
        $this->data['totalLiveClasses'] = LiveClass::where(['class_id' => auth()->user()->class_id])->count();


        return view('backend.student.index', $this->data);
    }



}
