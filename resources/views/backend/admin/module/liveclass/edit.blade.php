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

                        <h3 class="mb-2">Live Class Information</h3>
                        <p class="text-danger mb-4">
                            <em><small>Refresh or Select Teacher incase no class is found</small></em>
                        </p>

                        <form action="{{ route('admin.liveclass.update', $liveclass->id) }}" method="POST">
                            @method('patch')
                            @csrf


                            <div class="form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span> </label>
                                <input type="text" name="title" id="title" value="{{ $liveclass->title }}"
                                    class="form-control w-100" />

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

                                <textarea name="description" id="descripion" class="form-control"
                                    style="resize: none">{{ $liveclass->description }}</textarea>


                                @error('description')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="link">Link <span class="text-danger">*</span></label>
                                <input type="url" name="link" id="link" value="{{ $liveclass->link }}"
                                    class="form-control w-100" />

                                @error('link')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="live_class_method">Select Method <span class="text-danger">*</span></label>
                                <select class="form-select" name="live_class_method_id" id="live_class_method">
                                    <option selected disabled>Select a Method</option>

                                    @if(isset($methods) && !empty($methods))

                                    @foreach ($methods as $method)


                                        @if($liveclass->live_class_method->id == $method->id)
                                            <option value="{{$method->id }}" selected>{{ $method->name }}</option>
                                        @else
                                            <option value="{{$method->id }}">{{ $method->name }}</option>
                                        @endif


                                    @endforeach

                                    @else

                                    <option selected disabled>No Methods Found</option>

                                    @endif
                                </select>

                                @error('live_class_method_id')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>




                            <div class="form-group mb-3">
                                <label for="status">Select Status <span class="text-danger">*</span></label>
                                <select class="form-select" name="status_id" id="status">
                                    <option selected disabled>Select a Status</option>

                                    @if(isset($statuses) && !empty($statuses))

                                    @foreach ($statuses as $status)

                                    @if($liveclass->status->id == $status->id)
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
                                        <label for="start_time">Start Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="start_time" id="start_time" value="{{ $liveclass->start_time }}"
                                            class="form-control w-100" />

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
                                        <label for="end_time">End Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="end_time" id="end_time" value="{{ $liveclass->end_time }}"
                                            class="form-control w-100" />

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

                            <p class="text-danger mb-2">
                                <em><small>Only modify if you want to change the teacher & class</small></em>
                            </p>

                            <div class="form-group mb-3">
                                <label for="dynamic_teacher">Select Teacher</label>
                                <select class="form-select" name="admin_id" id="dynamic_teacher">
                                    <option selected disabled>Select a Teacher</option>

                                    @if(isset($admins) && !empty($admins))

                                    @foreach ($admins as $admin)

                                    <option value="{{$admin->id }}">{{ $admin->firstname . ' ' . $admin->lastname }}</option>

                                    @endforeach

                                    @else

                                    <option selected disabled>No Status Found</option>

                                    @endif
                                </select>

                                @error('admin_id')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="dynamic_class">Select Teacher's Class</label>
                                <select class="form-select" name="class_id" id="dynamic_class">
                                    <option selected disabled>Select a Class</option>


                                </select>

                                @error('class_id')
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
