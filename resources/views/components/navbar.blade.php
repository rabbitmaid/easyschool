<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
        <i class="hamburger align-self-center"></i>
    </a>

    {{-- <form class="d-none d-sm-inline-block">
        <div class="input-group input-group-navbar">
            <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
            <button class="btn" type="button">
                <i class="align-middle" data-feather="search"></i>
            </button>
        </div>
    </form> --}}

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">{{ ($unread_complain_replies_count > 0) ? $unread_complain_replies_count : 0 }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        {{ ($unread_complain_replies_count > 0) ? $unread_complain_replies_count : 0 }} New Notifications
                    </div>
                    <div class="list-group">
                        
                        @if(isset($unread_complain_replies) && !empty($unread_complain_replies))

                        @foreach ($unread_complain_replies as $unread_complain_reply)
                            <a href="{{ route('student.complain.view', $unread_complain_reply->complain_id) }}" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-danger" data-feather="message-square"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">{{ $unread_complain_reply->title }}</div>
                                        <div class="text-muted small mt-1">{{ $unread_complain_reply->description }}</div>
                                        <div class="text-muted small mt-1">
                                            {{ \Carbon\Carbon::parse($unread_complain_reply->created_at)->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        @endif
                        
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="{{ route('student.complain') }}" class="text-muted">Show all complains</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">

                    @if(Auth::user()->profile_image == NULL)
                            
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->username }}&color=7F9CF5&background=EBF4FF&format=svg" alt="Profile"
                        class="avatar rounded img-fluid">
        
                    @else
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" style="object-fit: cover; height: 35px" class="avatar rounded img-fluid">
                    @endif
                  
                    
                    <span class="text-dark">{{ ucwords(Auth::user()->username) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('student.profile') }}"><i class="align-middle mr-1"
                            data-feather="user"></i> Profile Settings</a>
                    <form action="{{ route('student.logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <i class="align-middle mr-1" data-feather="lock"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>