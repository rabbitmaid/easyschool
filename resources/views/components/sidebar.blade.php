<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('student.dashboard') }}">
            <span class="align-middle">{{ isset($siteTitle) ? $siteTitle : 'EazySchool' }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('student.dashboard') ? "active" : "" }}">
                <a class="sidebar-link" href="{{ route('student.dashboard') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                School Management
            </li>

            <li class="sidebar-item{{ request()->routeIs('student.complain*') ? ' active' : '' }}">
                <a data-target="#complain" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('student.complain*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="at-sign"></i> <span class="align-middle">Complains</span>
                </a>
                <ul id="complain" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('student.complain*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('student.complain') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('student.complain') }}">All Complains</a></li>
                    <li class="sidebar-item {{ request()->routeIs('student.complain.create') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('student.complain.create') }}">Submit Complain</a></li>

                </ul>
            </li>


            <li class="sidebar-item {{ request()->routeIs('student.assignment*') ? ' active' : '' }}">
                <a data-target="#assignment" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('student.assignment*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Assignments</span>
                </a>
                <ul id="assignment" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('student.assignment*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('student.assignment') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('student.assignment') }}">All Assignments</a></li>

                </ul>
            </li>



            <li class="sidebar-header">
                Live Class Management
            </li>

            <li class="sidebar-item{{ request()->routeIs('student.liveclass*') ? ' active' : '' }}">
                <a data-target="#liveclass" data-toggle="collapse" class="sidebar-link {{ request()->routeIs('student.liveclass*') ? '' : ' collapsed' }}">
                    <i class="align-middle" data-feather="cast"></i> <span class="align-middle">Live Class</span>
                </a>
                <ul id="liveclass" class="sidebar-dropdown list-unstyled collapse  {{ request()->routeIs('student.liveclass*') ? ' show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('student.liveclass') ? ' active' : '' }}"><a class="sidebar-link" href="{{ route('student.liveclass') }}">All Live Classes</a></li>
                   
                </ul>
            </li>

            


            <li class="sidebar-header">
                Account Management
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.profile') ? "active" : "" }}">
                <a class="sidebar-link" href="{{ route('student.profile') }}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Profile Settings</span>
                </a>
            </li>

            
        </ul>


    </div>
</nav>

