<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Level;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Trait\Permission;
use App\Http\Trait\SiteOption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    use SiteOption, Permission;

    public function __construct(
        public array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();    
    }


    public function index()
    {
        Permission::all_admin();

        $this->data['pageTitle'] = 'All Class Attendance';
        
        // If admin is a teacher get only his classes
        if(auth('admin')->user()->role_id == 3){

            $this->data['classes'] = auth('admin')->user()->classes;

        }else{

            $this->data['classes'] = Level::where('id', '!=', 1)->get();

        }

        return view('backend.admin.module.attendance.index', $this->data);
    }


    public function attendance_date(int $class_id)
    {
        Permission::all_admin();

        $class = Level::find($class_id);

        $this->data['pageTitle'] = 'Attendance Dates for ' . ucwords($class->name);
        $this->data['class'] = $class;
        $this->data['attendance_dates'] = Attendance::where(['class_id' => $class_id])->select(DB::raw('mark_date as day'))
                                                    ->groupBy('day')
                                                    ->orderBy('day', 'DESC')
                                                    ->paginate(10);

        return view('backend.admin.module.attendance.date', $this->data);
    }

    public function view(Request $request, int $class_id, string $date)
    {
        Permission::all_admin();
        $class = Level::find($class_id);
        $this->data['pageTitle'] = ucwords($class->name) . ' Attendance ' . \Carbon\Carbon::parse($date)->format('l jS \\of F Y');

        if ($request->query('search') != null) {
            $search = $request->query('search');

            $this->data['attendances'] = Attendance::join('users', 'users.id', '=', 'attendances.user_id')
                                        ->where('users.username', 'LIKE', "%{$search}%")
                                        ->whereDate('attendances.mark_date', '=', $date)
                                        ->where(['attendances.class_id' => $class_id])
                                        ->orderBy('attendances.mark_date', 'DESC')
                                        ->paginate(10);
          
        } else {

            $this->data['attendances'] = Attendance::where(['class_id' => $class_id])
            ->whereDate('mark_date', '=', $date)
            ->orderBy('mark_date', 'DESC')
            ->paginate(10);
        }
        
        return view('backend.admin.module.attendance.view', $this->data);
        
    }


    public function mark()
    {
        Permission::all_admin();

        $this->data['pageTitle'] = 'All Classes';

        if(auth('admin')->user()->role_id == 3){
            $this->data['classes'] = auth('admin')->user()->classes;
        }else{
            $this->data['classes'] = Level::where('id', '!=', 1)->get();            
        }


        return view('backend.admin.module.attendance.mark', $this->data);
    }


    public function mark_class(int $class_id)
    {
        Permission::all_admin();

        $this->data['class'] = Level::find($class_id);
        $this->data['pageTitle'] = 'Mark Attendance for Class ' . ucwords($this->data['class']->name);
        $this->data['students'] = User::where(['class_id' => $class_id])->orderBy('id','DESC')->paginate(10);
        
        return view('backend.admin.module.attendance.mark_class', $this->data);
    }

    public function mark_store(Request $request)
    {
      
        $formFields = $request->validate([
            'attendance' => ['required'],
            'mark_date' => ['required'],
            'class_id' => ['required']
        ]);

        // If there is an existing attendance for the same day delete it
        $countAttendance = Attendance::where('class_id', $formFields['class_id'])->whereDate('mark_date', '=', $formFields['mark_date'])->count();

        if($countAttendance > 0){
            Attendance::where('class_id', $formFields['class_id'])->whereDate('mark_date', '=', $formFields['mark_date'])->delete();
        }

        foreach($formFields['attendance'] as $user_id => $attendance){
            $mark = Attendance::create([
                'user_id' => $user_id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'class_id' => $formFields['class_id'],
                'is_present' => ($attendance == 'true') ? 1 : 0,
                'mark_date' => $formFields['mark_date'],
            ]);
        }


        if ($mark) {
            return redirect()->back()->with('success', 'Attendance Marked Successfully');
        }

        return redirect()->back()->with('failure', 'Attendance Not Marked Successfully');

    }
}
