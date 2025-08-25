<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>


        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Assign Classes to {{ $teacher->firstname . ' ' . $teacher->lastname }}</h3>

                        <form action="{{ route('admin.teacher.save_assign') }}" method="POST">
                            @csrf


                            <div class="mb-5">

                                <label for="teacher">Teacher</label>

                                <input type="text" class="form-control"
                                    value="{{ $teacher->firstname . ' ' . $teacher->lastname }}" id="teacher"
                                    name="teacher" readonly>
                                <input type="hidden" class="form-control" value="{{ $teacher->id }}" name="teacher_id">
                            </div>

                            <div id="asign-group">

                                @if(isset($teacherClass) && !empty($teacherClass) && count($teacherClass) > 0)


                                @foreach ( $teacherClass as $classAssign )

                                <div class="row align-items-center default-row mb-3">

                                    <div class="col-11">

                                        <select class="form-select" name="class[]" id="class">
                                            <option selected disabled>Select a Class</option>
                                            @if(isset($classes) && !empty($classes) && count($classes) > 0)

                                            @foreach ( $classes as $class )

                                            @if($classAssign->class_id == $class->id)
                                            <option value="{{ $class->id }}" selected>{{ $class->name }}</option>
                                            @else
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endif



                                            @endforeach

                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-1">
                                        <button type="button" class="btn btn-danger w-100 text-white mt-2 mt-md-0 delete-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2 align-middle">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </div>


                                </div>



                                @endforeach


                                @else



                                <div class="row align-items-center default-row mb-3">


                                    <div class="col-11">

                                        <select class="form-select" name="class[]" id="class">
                                            <option selected disabled>Select a Class</option>
                                            @if(isset($classes) && !empty($classes) && count($classes) > 0)

                                            @foreach ( $classes as $class )

                                            <option value="{{ $class->id }}">{{ $class->name }}</option>

                                            @endforeach

                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-1">
                                        <button type="button" class="btn btn-danger w-100 text-white mt-2 mt-md-0 delete-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2 align-middle">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </div>



                                </div>


                                @endif


                            </div>


                            <div class="col-12 mt-2">
                                <button type="button" id="addButton" class="btn btn-primary mt-5">Add More</button>
                            </div>


                            <button type="submit" class="btn btn-primary mt-5 w-100">Save Changes</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>





</x-master-admin>