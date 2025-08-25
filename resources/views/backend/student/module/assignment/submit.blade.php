<x-master site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('student.dashboard') }}" />

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

                        <a href="{{ route('student.assignment') }}" class="btn btn-primary mt-4">All Assignments</a>
                        @if(isset($assignment->file))
                        <a href="{{ asset('storage/'.$assignment->file) }}" class="btn btn-secondary mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-download align-middle">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Download
                        </a>
                        @endif
                    </div>


                </div>



                @if(isset($assignment_submissions) && !empty($assignment_submissions) && count($assignment_submissions) > 0)

                <h3 class="text-center">Submissions</h3>

                @foreach ( $assignment_submissions as $assignment_submission )

                    <div class="card rounded mb-4 p-3 border-top border-2 border-primary">

                       <div class="card-body">
                            <h4 class="text-muted mb-4">{{ $assignment_submission->user->username }} <small><span
                                        class="badge bg-primary rounded-pill">{{ $assignment_submission->user->class->name
                                        }}</span></small> <br /> <small>{{
                                    \Carbon\Carbon::parse($assignment_submission->created_at)->diffForHumans() }}</small></h4>
                            <p class="mb-0">{{ $assignment_submission->notes }}</p>

                            @if(isset($assignment_submission->file))
                            <a href="{{ asset('storage/'.$assignment_submission->file) }}" class="btn btn-secondary mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-download align-middle">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download
                            </a>
                            @endif
                       </div>

                    </div>

                @endforeach

                @endif


                <div class="card">


                    <div class="card-body">
                        <form action="{{ route('student.assignment.submit_store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="assignment_id" value="{{ $assignment->id }}" />
                            <input type="hidden" name="user_id" value="{{ auth('admin')->user()->id }}" />

                            <div class="form-group mb-3">
                                <label for="description">Notes</label>

                                <textarea name="notes" id="notes" class="form-control" style="resize: none"></textarea>

                                @error('notes')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="file">File</label>
                                <input type="file" name="file" id="file" class="form-control form-file w-100" />

                                @error('file')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>

                        </form>
                    </div>


                </div>


            </div>


        </div>

    </div>


</x-master>