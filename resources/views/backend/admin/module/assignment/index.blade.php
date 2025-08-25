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
                                    <th style="width:8%;">Administrator</th>
                                    <th style="width:8%">Class</th>
                                    <th style="width:10%">Course</th>
                                    <th style="width:10%;">Title</th>
                                    <th style="width:5%">Status</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($assignments) && !empty($assignments) && count($assignments) > 0)

                                @foreach ( $assignments as $assignment )

                                <tr>
                                
                                    <td>
                                        {{ $assignment->admin->username }}
                                        
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $assignment->admin->course->name}}
                                        </span>
                                    </td>

                                    <td>{{ $assignment->class->name }}</td>
                                    <td>{{ $assignment->course->name }}</td>
                                    
                                    <td>{{ $assignment->title }}</td>
                                   
                                    <td style="text-align:center;">
                                        @if($assignment->status->id == 1)
                                        <span class="badge bg-success">{{ $assignment->status->name }}</span>
                                        @elseif($assignment->status->id == 2)
                                        <span class="badge bg-warning">{{ $assignment->status->name }}</span>
                                        @endif
                                    </td>

                                    <td class="table-action">

                                        <a href="{{ route('admin.assignment.edit', $assignment->id) }}"
                                            class="btn btn-primary text-white" title="view assignment">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor align-middle"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                        </a>

                                        @if($assignment->status->id == 2)
                                        <a href="{{ route('admin.assignment.activate', $assignment->id) }}"
                                            class="btn btn-success text-white" title="activate">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left align-middle"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="8" cy="12" r="3"></circle></svg>
                                        </a>
                                        @elseif($assignment->status->id == 1)
                                        <a href="{{ route('admin.assignment.deactivate', $assignment->id) }}"
                                            class="btn btn-warning text-white" title="deactivate">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right align-middle"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg>
                                        </a>
                                        @endif


                                        @can('super-admin')

                                        <button type="button" class="btn btn-danger deleteButton" title="delete"
                                            data-toggle="modal" data-target="#deleteModal"
                                            resource-id="{{ $assignment->id }}" resource-name="assignment">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>

                                        <x-modal-delete resource="assignment" />

                                        @endcan


                                        @if(isset($assignment->file))
                                            <a href="{{ asset('storage/' . $assignment->file) }}"
                                                class="btn btn-secondary text-white" title="download assignment file">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download align-middle"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                            </a>
                                        @endif


                                        <a href="{{ route('admin.assignment.submissions_assignment', $assignment->id) }}"
                                            class="btn btn-outline-primary" title="submissions">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu align-middle"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                        </a>

                                    </td>
                                </tr>

                                @endforeach

                                @else

                                <tr>
                                    <td colspan="8" class="text-center">No Assignment Found</td>
                                </tr>

                                @endif

                            </tbody>




                        </table>
                    </div>

                    <div class="card-footer">
                            {{ $assignments->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>



</x-master-admin>