<x-master site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}" dashboard-route="{{ route('student.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>



        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card mb-4">

                    <div class="card-body">
                        <h5 class="text-muted">{{ $assignment->admin->username }}</h5>
                        <h3 class="mb-4">{{ $assignment->title }}</h3>

                        <div class="bg-secondary text-white p-3 rounded-2">
                            <p class="mb-0"> {{ $assignment->description }} </p>
                        </div>
                        @if(isset($assignment->end_time))
                        <p class="mt-3">Last Submission Date: {{ \Carbon\Carbon::parse($assignment->end_time)->toDayDateTimeString() }}</p>
                        @endif

                        <a href="{{ route('student.assignment') }}" class="btn btn-primary mt-4">All Assignments</a>
                        @if(isset($assignment->file))
                        <a href="{{ asset('storage/'.$assignment->file) }}" class="btn btn-secondary mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download align-middle">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Download
                        </a>
                        @endif

                        <a href="{{ route('student.assignment.submit', $assignment->id) }}" class="btn btn-warning text-dark mt-4" title="submit assignment">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book align-middle">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                            Submit
                        </a>

                    </div>

                </div>


            </div>


        </div>

    </div>


</x-master>
