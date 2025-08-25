<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}" dashboard-route="{{ route('student.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>



        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card mb-4">

                    <div class="card-body">
                        <h5 class="text-muted">{{ $assignment_submission->user->username }}</h5>
                        <h3 class="mb-4">{{ $assignment_submission->assignment->title }}</h3>

                        <div class="bg-secondary text-white p-3 rounded-2">
                            <p class="mb-0"> {{ $assignment_submission->notes }} </p>
                        </div>
                        @if(isset($assignment_submission->created_at))
                        <p class="mt-3">Submitted Date: {{ \Carbon\Carbon::parse($assignment_submission->created_at)->toDayDateTimeString() }}</p>
                        @endif

                        <a href="{{ route('admin.assignment') }}" class="btn btn-primary mt-4">All Assignments</a>
                        @if(isset($assignment_submission->file))
                        <a href="{{ asset('storage/'.$assignment_submission->file) }}" class="btn btn-secondary mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download align-middle">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Download
                        </a>
                        @endif

                    </div>

                </div>


            </div>


        </div>

    </div>


</x-master-admin>
