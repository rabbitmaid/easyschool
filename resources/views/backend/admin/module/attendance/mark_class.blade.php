<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}" dashboard-route="{{ route('admin.dashboard') }}" />

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


                    <form action="{{ route('admin.attendance.mark_store') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:5%">Profile</th>
                                        <th style="width:10%;">Username</th>
                                        <th style="width:20%;">Full Name</th>
                                        <th style="width:15%">Phone Number</th>
                                        <th style="width:15%">Date of Birth</th>
                                        <th style="width:15%">Status</th>
                                        <th class="text-center" style="width:5%">Present</th>
                                        <th class="text-center" style="width:5%">Absent</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(isset($students) && !empty($students) && count($students) > 0)

                                    @foreach ( $students as $student )

                                    <tr>
                                        <td>
                                            @if($student->profile_image == NULL)

                                            <img src="https://ui-avatars.com/api/?name={{ $student->username }}&color=7F9CF5&background=EBF4FF&format=svg" alt="Profile" class="avatar rounded-circle img-fluid">

                                            @else
                                            <img src="{{ asset('storage/' . $student->profile_image) }}" style="object-fit: cover; width:35px; height: 35px" class="avatar rounded-circle img-fluid">
                                            @endif
                                        </td>
                                        <td>{{ $student->username }}</td>
                                        <td>{{ ucwords($student->firstname . ' ' . $student->lastname) }}</td>
                                        <td>{{ $student->phone_number }}</td>
                                        <td>{{ $student->date_of_birth }}</td>
                                        <td>
                                            @if($student->status->id == 1)
                                            <span class="badge bg-success">{{ $student->status->name }}</span>
                                            @elseif($student->status->id == 2)
                                            <span class="badge bg-warning">{{ $student->status->name }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <input type="radio" class="form-check d-block mx-auto" name="attendance[{{ $student->id }}]" value="true" />
                                        </td>
                                        <td>
                                            <input type="radio" class="form-check d-block mx-auto" name="attendance[{{ $student->id }}]" value="false" />
                                        </td>
                                    </tr>

                                    @endforeach

                                    @else

                                    <tr>
                                        <td colspan="8" class="text-center">No Students Found</td>
                                    </tr>

                                    @endif

                                </tbody>




                            </table>
                        </div>

                        <div class="row p-3 mb-3 align-items-center">
                            <div class="col-12 col-md-4">
                                <input type="date" class="form-control" name="mark_date" id="mark_date" value="{{ now() }}">
                                @error('mark_date')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <div class="col-12 col-md-4">
                                <button class="btn btn-primary" type="submit">Mark Attendance</button>
                            </div>
                        </div>


                    </form>

                    <div class="card-footer">
                        {{ $students->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>



</x-master-admin>
