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
                                    <th style="width:10%;">Student</th>
                                    <th style="width:10%;">Administrator</th>
                                    <th style="width:10%">Course</th>
                                    <th style="width:5%">Time Submitted</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($assignment_submissions) && !empty($assignment_submissions) && count($assignment_submissions) > 0)

                                @foreach ( $assignment_submissions as $assignment_submission )

                                <tr>

                                    <td>
                                        {{ $assignment_submission->user->username }} <br>
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $assignment_submission->user->class->name}}
                                        </span>
                                    </td>
                                
                                    <td>
                                        {{ $assignment_submission->assignment->admin->username }} <br>
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $assignment_submission->assignment->admin->course->name}}
                                        </span>
                                    </td>

                                    <td>{{ $assignment_submission->assignment->course->name }}</td>
                                    
                                    <td>{{ \Carbon\Carbon::parse($assignment_submission->created_at)->diffForHumans() }}</td>
            

                                    <td class="table-action">

                                        <a href="{{ route('admin.assignment.submission_view', $assignment_submission->id) }}"
                                            class="btn btn-success text-white" title="view assignment">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>

                                        
                                        @if(isset($assignment_submission->file))
                                            <a href="{{ asset('storage/' . $assignment_submission->file) }}"
                                                class="btn btn-secondary text-white" title="download submitted file">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download align-middle"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                            </a>
                                        @endif


                                         @can('super-admin')
                                        <button type="button" class="btn btn-danger deleteButton" title="delete"
                                            data-toggle="modal" data-target="#deleteModal"
                                            resource-id="{{ $assignment_submission->id }}" resource-name="assignment_submission">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>

                                        <x-modal-delete resource="assignment submission" />
                                            
                                        @endcan
                                       
                                    </td>
                                </tr>

                                @endforeach

                                @else

                                <tr>
                                    <td colspan="8" class="text-center">No Assignment Submissions Found</td>
                                </tr>

                                @endif

                            </tbody>




                        </table>
                    </div>

                    <div class="card-footer">
                            {{ $assignment_submissions->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>



</x-master-admin>