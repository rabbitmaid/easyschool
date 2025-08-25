<x-master site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}" dashboard-route="{{ route('student.dashboard') }}" />

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
                                <div class="col-12 col-md-9 d-flex justify-content-center justify-content-md-start align-items-center">
                                    <form action="" method="GET">
                                        <div class="col-12">
                                            <input type="search" class="form-control" title="Press Enter to Search" placeholder="Search..." name="search" id="search" value="{{ (request()->query('search') != null) ? request()->query('search') : '' }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 col-md-3 d-flex justify-content-center justify-content-md-end align-items-center">

                                </div>
                            </div>
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:10%">Title</th>
                                    <th style="width:10%;">Admin</th>
                                    <th style="width:5%;">Class</th>
                                    <th style="width:10%;">Method</th>
                                    <th style="width:10%;">Start time</th>
                                    <th style="width:10%;">End time</th>
                                    <th style="width:10%; text-align:center;">Status</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($live_classes) && !empty($live_classes) && count($live_classes) > 0)

                                @foreach ( $live_classes as $live_class )

                                <tr>

                                    <td>{{ $live_class->title }}</td>
                                    <td>
                                        {{ $live_class->admin->username }}
                                       <span class="badge bg-primary rounded-pill">
                                            {{ $live_class->admin->course->name }}
                                       </span>
                                    </td>
                                    <td>{{ $live_class->class->name }}</td>
                                    <td>{{ $live_class->live_class_method->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($live_class->start_time)->toDayDateTimeString(); }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($live_class->end_time)->toDayDateTimeString(); }}</td>
                                    <td style="text-align:center;">
                                        @if($live_class->status->id == 1)
                                        <span class="badge bg-success">{{ $live_class->status->name }}</span>
                                        @elseif($live_class->status->id == 2)
                                        <span class="badge bg-warning">{{ $live_class->status->name }}</span>
                                        @endif
                                    </td>
                                    <td class="table-action">


                                        <a href="{{ route('student.liveclass.view', $live_class->id) }}"
                                            class="btn btn-primary text-white" title="view liveclass">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor align-middle"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                        </a>

                                        @if($live_class->status->id == 1 && $live_class->end_time >= now())

                                        <a href="{{ $live_class->link }}" class="btn btn-info text-white" title="join class" target="__blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link align-middle">
                                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6">
                                                </path>
                                                <polyline points="15 3 21 3 21 9"></polyline>
                                                <line x1="10" y1="14" x2="21" y2="3"></line>
                                            </svg>

                                            Join
                                        </a>

                                        @else

                                        <button disabled="disabled" class="btn btn-outline-danger text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link align-middle">
                                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6">
                                                </path>
                                                <polyline points="15 3 21 3 21 9"></polyline>
                                                <line x1="10" y1="14" x2="21" y2="3"></line>
                                            </svg>

                                            Expired
                                        </button>

                                        @endif


                                    </td>
                                </tr>

                                @endforeach

                                @else

                                <tr>
                                    <td colspan="8" class="text-center">No Live Classes Found</td>
                                </tr>

                                @endif

                            </tbody>

                        </table>
                    </div>

                    <div class="card-footer">
                        {{ $live_classes->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>



</x-master>
