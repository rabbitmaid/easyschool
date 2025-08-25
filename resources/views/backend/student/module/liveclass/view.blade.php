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
                        <h5 class="text-muted">{{ $live_class->live_class_method->name }}</h5>
                        <h3 class="mb-4">{{ $live_class->title }}</h3>

                        <div class="bg-secondary text-white p-3 rounded-2">
                            <p class="mb-0"> {{ $live_class->description }} </p>
                        </div>

                        @if(isset($live_class->start_time))
                        <p class="mt-3">Start Time: <span class="badge bg-primary rounded-pill">{{ \Carbon\Carbon::parse($live_class->start_time)->toDayDateTimeString() }}</span></p>
                        @endif

                        @if(isset($live_class->end_time))
                        <p class="mt-3">End Time: <span class="badge bg-danger rounded-pill"> {{ \Carbon\Carbon::parse($live_class->end_time)->toDayDateTimeString() }}</span></p>
                        @endif

                        <a href="{{ route('student.liveclass') }}" class="btn btn-primary mt-4">All Live Classes</a>

                        @if($live_class->status->id == 1 && $live_class->end_time >= now())

                        <a href="{{ $live_class->link }}" class="btn btn-info text-white mt-4" title="join class" target="__blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link align-middle">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6">
                                </path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>

                            Join
                        </a>

                        @else

                        <button disabled="disabled" class="btn btn-outline-danger text-white mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link align-middle">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6">
                                </path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>

                            Expired
                        </button>

                        @endif


                    </div>

                </div>


            </div>


        </div>

    </div>


</x-master>
