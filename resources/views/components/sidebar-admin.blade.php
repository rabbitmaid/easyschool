<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <span class="align-middle">{{ isset($siteTitle) ? $siteTitle : 'EazySchool' }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>


            <li class="sidebar-header">
                User Management
            </li>
            
    
            <li class="sidebar-item {{ request()->routeIs('admin.student*') ? ' active' : '' }}">
                <a data-target="#student" data-toggle="collapse" class="sidebar-link  {{ request()->routeIs('admin.student*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Students</span>
                </a>
                <ul id="student" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.student*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.student') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.student') }}">All Students</a></li>

                    @can('admin-only')
                        <li class="sidebar-item {{ request()->routeIs('admin.student.create') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.student.create') }}">Add Student</a>
                        </li>
                    @endcan
                </ul>
            </li>
   

            @can('admin-only')
            <li class="sidebar-item {{ request()->routeIs('admin.teacher*') ? ' active' : '' }}">
                <a data-target="#administrator" data-toggle="collapse" class="sidebar-link  {{ request()->routeIs('admin.teacher*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Teachers &
                        Admins</span>
                </a>
                <ul id="administrator" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.teacher*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.teacher') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.teacher') }}">All Admins</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.teacher.create') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.teacher.create') }}">Add Admin</a>
                    </li>
                </ul>
            </li>
            @endcan


            <li class="sidebar-header">
                School Management
            </li>

            @can('admin-only')
            <li class="sidebar-item {{ request()->routeIs('admin.course*') ? ' active' : '' }}">
                <a data-target="#course" data-toggle="collapse" class="sidebar-link  {{ request()->routeIs('admin.course*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Courses</span>
                </a>
                <ul id="course" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.course*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.course') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.course') }}">All Courses</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.course.create') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.course.create') }}">Add Course</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item {{ request()->routeIs('admin.class*') ? ' active' : '' }}">
                <a data-target="#class" data-toggle="collapse" class="sidebar-link  {{ request()->routeIs('admin.class*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Classes</span>
                </a>
                <ul id="class" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.class*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.class') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.class') }}">All Classes</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.class.create') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.class.create') }}">Add Class</a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('all-admin')
            <li class="sidebar-item {{ request()->routeIs('admin.complain*') ? ' active' : '' }}">
                <a data-target="#complain" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.complain*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="at-sign"></i> <span class="align-middle">Complains</span>
                </a>
                <ul id="complain" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.complain*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.complain') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.complain') }}">All Complains</a></li>

                </ul>
            </li>


            <li class="sidebar-item {{ request()->routeIs('admin.assignment*') ? ' active' : '' }}">
                <a data-target="#assignment" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.assignment*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Assignments</span>
                </a>
                <ul id="assignment" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.assignment*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.assignment') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.assignment') }}">All Assignments</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.assignment.submissions') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.assignment.submissions') }}">All Submissions</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.assignment.create') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.assignment.create') }}">Add New</a></li>

                </ul>
            </li>



            <li class="sidebar-item {{ request()->routeIs('admin.attendance*') ? ' active' : '' }}">
                <a data-target="#attendance" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.attendance*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Attendance</span>
                </a>
                <ul id="attendance" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.attendance*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.attendance') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.attendance') }}">All Attendance</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.attendance.mark') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.attendance.mark') }}">Mark Attendance</a></li>

                </ul>
            </li>

            @endcan



            <li class="sidebar-header">
                Live Class Management
            </li>



            <li class="sidebar-item{{ request()->routeIs('admin.liveclass*') ? ' active' : '' }}">
                <a data-target="#liveclass" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.liveclass*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="cast"></i> <span class="align-middle">Live Class</span>
                </a>
                <ul id="liveclass" class="sidebar-dropdown list-unstyled collapse  {{ request()->routeIs('admin.liveclass*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.liveclass') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.liveclass') }}">All Live Classes</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.liveclass.create') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.liveclass.create') }}">Add New</a></li>
                </ul>
            </li>


            @can('admin-only')


            <li class="sidebar-item {{ request()->routeIs('admin.live_class_method*') ? ' active' : '' }}">
                <a data-target="#method" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.live_class_method*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="server"></i> <span class="align-middle">Methods</span>
                </a>
                <ul id="method" class="sidebar-dropdown list-unstyled collapse  {{ request()->routeIs('admin.live_class_method*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.live_class_method') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('admin.live_class_method') }}">All Methods</a></li>
                    <li class="sidebar-item {{ request()->routeIs('admin.live_class_method.create') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.live_class_method.create') }}">Add New</a></li>
                </ul>
            </li>

            @endcan



            <li class="sidebar-header">
                Settings
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.profile') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.profile') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile
                        Settings</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.option') ? ' active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.option') }}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">System
                        Settings</span>
                </a>
            </li>


        </ul>


        {{-- <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Read the Docs</strong>
                <div class="mb-3 text-sm">
                    Check the documentation for more information
                </div>
                <a href="#" target="_blank" class="btn btn-primary btn-block">Documentation</a>
            </div>
        </div> --}}

    </div>
</nav>
