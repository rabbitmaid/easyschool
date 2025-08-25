<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Http\Trait\SiteOption;
use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Course;
use App\Models\Gender;
use App\Models\Level;
use App\Models\LiveClass;
use App\Models\LiveClassMethod;

class DashboardController extends Controller
{
    use SiteOption;
    
    public function __construct(
        protected array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }


    public function index()
    {
        $this->data['pageTitle'] = 'Analytics';
        $this->data['totalStudents'] = User::count();
        $this->data['totalAdmins'] = Admin::count();
        $this->data['totalClasses'] = Level::count();
        $this->data['totalCourses'] = Course::count();
        $this->data['totalGenders'] = Gender::count();
        $this->data['totalFemaleStudents'] = User::where(['gender_id' => 2])->count();
        $this->data['totalMaleStudents'] = User::where(['gender_id' => 1])->count();
        $this->data['totalInactiveStudents'] = User::where(['status_id' => 2])->count();
        $this->data['totalActiveStudents'] = User::where(['status_id' => 1])->count();
        $this->data['totalComplains'] = Complain::count();
        $this->data['totalLiveClassMethods'] = LiveClassMethod::count();
        $this->data['totalLiveClasses'] = LiveClass::count();

        return view('backend.admin.index', $this->data);
    }


}
