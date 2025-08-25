<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row">

        <div class="col-12">
            <x-alert-notify />
        </div>

        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <div class="row">
                                <div
                                    class="col-12 col-md-9 d-flex justify-content-center justify-content-md-start align-items-center">
                                    <form action="" method="GET">
                                        <div class="col-12">
                                            <input type="search" class="form-control" title="Press Enter to Search"
                                                placeholder="Search..." name="search" id="search"
                                                value="{{ (request()->query('search') != null) ? request()->query('search') : '' }}">
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="col-12 col-md-3 d-flex justify-content-center justify-content-md-end align-items-center">
                                    
                                </div>
                            </div>
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%">Profile</th>
                                    <th style="width:10%;">Username</th>
                                    <th style="width:10%;">Full Name</th>
                                    <th style="width:10%">Phone Number</th>
                                    <th style="width:10%">Role</th>
                                    <th style="width:10%">Date of Birth</th>
                                    <th style="width:5%">Status</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($teachers) && !empty($teachers) && count($teachers) > 0)

                                @foreach ( $teachers as $teacher )

                                <tr>
                                    <td>
                                        @if($teacher->profile_image == NULL)

                                        <img src="https://ui-avatars.com/api/?name={{ $teacher->username }}&color=7F9CF5&background=EBF4FF&format=svg"
                                            alt="Profile" class="avatar rounded-circle img-fluid">

                                        @else
                                        <img src="{{ asset('storage/' . $teacher->profile_image) }}"
                                            style="object-fit: cover; width:35px; height: 35px" class="avatar rounded-circle img-fluid">
                                        @endif
                                    </td>
                                    <td>{{ $teacher->username }}</td>
                                    <td>{{ ucwords($teacher->firstname . ' ' . $teacher->lastname) }}</td>
                                    <td>{{ $teacher->phone_number }}</td>
                                    <td>{{ $teacher->role->name }}</td>
                                    <td>{{ $teacher->date_of_birth }}</td>
                                    <td>
                                        @if($teacher->status->id == 1)
                                        <span class="badge bg-success">{{ $teacher->status->name }}</span>
                                        @elseif($teacher->status->id == 2)
                                        <span class="badge bg-warning">{{ $teacher->status->name }}</span>
                                        @endif
                                    </td>
                                    <td class="table-action">

                                        {{-- Do not show options for authenticated user --}}
                                        @if($teacher->id != auth('admin')->user()->id)

                                        <a href="{{ route('admin.teacher.edit', $teacher->id) }}"
                                            class="btn btn-primary text-white" title="view teacher">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor align-middle"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                        </a>
                                        @if($teacher->status->id == 2)
                                        <a href="{{ route('admin.teacher.activate', $teacher->id) }}"
                                            class="btn btn-success text-white" title="activate">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left align-middle"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="8" cy="12" r="3"></circle></svg>
                                        </a>
                                        @elseif($teacher->status->id == 1)
                                        <a href="{{ route('admin.teacher.deactivate', $teacher->id) }}"
                                            class="btn btn-warning text-white" title="deactivate">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right align-middle"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg>
                                        </a>
                                        @endif

                                        
                                            @can('super-admin')

                                            <button type="button" class="btn btn-danger deleteButton" title="delete"
                                                data-toggle="modal" data-target="#deleteModal"
                                                resource-id="{{ $teacher->id }}" resource-name="teacher">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            </button>

                                            <x-modal-delete resource="teacher" />

                                            @endcan

                                        
                                        @else


                                        <a href="{{ route('admin.profile') }}" class="btn btn-primary text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings align-middle"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                        </a>

                                           
                                           
                                        @endif 


                                        @can('admin-only')
                                            
                                        {{-- Show button if teacher has role "Teacher" --}}
                                        @if($teacher->role->id == 3)

                                        <a href="{{ route('admin.teacher.assign', $teacher->id) }}" class="btn btn-info text-white" title="Assign Class">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square align-middle"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                        </a>

                                        @endif

                                        @endcan
                                   

                                    </td>
                                </tr>

                                @endforeach

                                @else

                                <tr>
                                    <td colspan="8" class="text-center">No Teachers Found</td>
                                </tr>

                                @endif

                            </tbody>




                        </table>
                    </div>

                    <div class="card-footer">
                            {{ $teachers->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>



</x-master-admin>