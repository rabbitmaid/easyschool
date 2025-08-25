<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}" dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>



        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Assignment Information</h3>

                        <form action="{{ route('admin.assignment.update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{ $assignment->title }}" class="form-control w-100" />

                                @error('title')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="description">Description</label>

                                <textarea name="description" id="descripion" class="form-control" style="resize: none">{{ $assignment->description }}</textarea>


                                @error('description')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="class">Select a Class</label>
                                <select class="form-select" name="class_id" id="class">
                                    <option selected disabled>Select a Class</option>

                                    @if(isset($classes) && !empty($classes))

                                    @foreach ($classes as $class)

                                    @if($assignment->class->id == $class->id)
                                    <option value="{{ $class->id }}" selected>{{ $class->name }}</option>
                                    @else
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endif



                                    @endforeach

                                    @else

                                    <option selected disabled>No Class Found</option>

                                    @endif
                                </select>

                                @error('class_id')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="course">Select a Course</label>
                                <select class="form-select" name="course_id" id="course">
                                    <option selected disabled>Select a Course</option>

                                    @if(isset($courses) && !empty($courses))

                                    @foreach ($courses as $course)

                                    @if($assignment->course->id == $course->id)
                                    <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                    @else
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endif



                                    @endforeach

                                    @else

                                    <option selected disabled>No Cpurse Found</option>

                                    @endif
                                </select>

                                @error('course_id')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="status">Select Status</label>
                                <select class="form-select" name="status_id" id="status">
                                    <option selected disabled>Select a Status</option>

                                    @if(isset($statuses) && !empty($statuses))

                                    @foreach ($statuses as $status)

                                    @if($assignment->status->id == $status->id)
                                    <option value="{{$status->id }}" selected>{{ $status->name }}</option>
                                    @else
                                    <option value="{{$status->id }}">{{ $status->name }}</option>
                                    @endif

                                    @endforeach

                                    @else

                                    <option selected disabled>No Status Found</option>

                                    @endif
                                </select>

                                @error('status_id')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="row mb-3">

                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="start_time">Start Date / Time</label>
                                        <input type="datetime-local" name="start_time" id="start_time" value="{{ $assignment->start_time }}" class="form-control w-100" />

                                        @error('start_time')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="end_time">End Date / Time</label>
                                        <input type="datetime-local" name="end_time" id="end_time" value="{{ $assignment->end_time }}" class="form-control w-100" />

                                        @error('end_time')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                            </div>


                            <div class="form-group mb-3">
                                <label for="file">File <span class="text-danger"><small><em>(Upload only if you want to modify the assignment file)</em></small></span></label>
                                <input type="file" name="file" id="file" class="form-control form-file w-100" />

                                @error('file')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>




                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                            </div>

                        </form>



                    </div>

                </div>


            </div>


        </div>

    </div>


</x-master-admin>
