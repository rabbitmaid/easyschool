<x-master site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('student.dashboard') }}" />

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

                                        <a href="{{ route('student.assignment.view', $assignment->id) }}"
                                            class="btn btn-success text-white" title="view assignment">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>


                                        @if(isset($assignment->file))
                                            <a href="{{ asset('storage/' . $assignment->file) }}"
                                                class="btn btn-secondary text-white" title="download assignment asset file">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download align-middle"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                            </a>
                                        @endif

                                        <a href="{{ route('student.assignment.submit', $assignment->id) }}"
                                            class="btn btn-warning text-dark" title="submit assignment">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book align-middle"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                        </a>

                                       
                                    </td>
                                </tr>

                                @endforeach

                                @else

                                <tr>
                                    <td colspan="8" class="text-center">No Assignments Found</td>
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



</x-master>