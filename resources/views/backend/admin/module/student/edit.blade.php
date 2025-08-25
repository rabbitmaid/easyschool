<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">

            <x-alert-notify />

        </div>


        <div class="col-12 col-md-4 col-xl-4 col-xxl-4 d-flex">
            <div class="w-100">

                <div class="card">

                    <div class="card-body">
                        <a class="btn btn-primary d-block"
                            href="{{ route('admin.student.class', $student->class->id) }}">Back to Class List</a>
                    </div>

                </div>

                <div class="card mt-4">
                    <div class="card-body text-center">


                        <form action="{{ route('admin.student.update_profile_image', $student->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')


                            @if($student->profile_image == NULL)

                            <img src="https://ui-avatars.com/api/?name={{ $student->username }}&color=7F9CF5&background=EBF4FF&format=svg"
                                alt="Profile"
                                style="width: 150px; height: 150px; border: 8px solid white; outline: 2px solid #f2f2f2;"
                                class="rounded-circle shadow-lg">

                            @else
                            <div class="mx-auto rounded-circle bg-light shadow-lg"
                                style="width: 150px; height: 150px; overflow: hidden; transition: all 650ms ease-in-out; border: 8px solid white; outline: 2px solid #f2f2f2;">
                                <img src="{{ asset('storage/' . $student->profile_image ) }}"
                                    style="object-fit: cover; height: 150px;" class="w-100">
                            </div>

                            @endif


                            <div class="container-fluid mt-4 mb-4">
                                <label for="profile_image" class="text-center w-100 mb-2">Upload a Profile Image</label>
                                <div class="upload-field">
                                    <input name="profile_image" type="file" id="profile_image" class="form-control"
                                        accept="image/*">
                                </div>
                                @error('profile_image')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror

                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </div>


                        </form>

                    </div>
                </div>


                {{-- Other User Information Below profile image --}}
                <div class="card mt-4">

                    <div class="card-body">
                        <h2 class="text-center">{{ $student->firstname . ' ' . $student->lastname }}</h2>
                        <div class="text-center badge bg-primary rounded-pill p-2 w-100">
                            <p class="mb-0 text-uppercase">Current class: {{ $student->class->name }}</p>
                        </div>
                    </div>

                </div>



            </div>
        </div>


        <div class="col-12 col-md-8 col-xl-8 col-xxl-8 d-flex">

            <div class="w-100">

                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Modify Profile Information</h3>

                        <form action="{{ route('admin.student.update', $student->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group mb-3">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" value="{{ $student->firstname }}"
                                    class="form-control w-100" />

                                @error('firstname')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" value="{{ $student->lastname }}"
                                    class="form-control w-100" />

                                @error('lastname')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="{{ $student->username }}"
                                    class="form-control w-100" />

                                @error('username')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ $student->email }}"
                                    class="form-control w-100" />

                                @error('email')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ $student->date_of_birth }}" class="form-control w-100" />

                                @error('date_of_birth')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" value="{{ $student->address }}"
                                    class="form-control w-100" />

                                @error('address')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="phone_number">Phone Number</label>
                                <input type="phone_number" name="phone_number" id="phone_number"
                                    value="{{ $student->phone_number }}" class="form-control w-100" />

                                @error('phone_number')
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
                                    <option disabled>Select a Class</option>

                                    @if(isset($classes) && !empty($classes))

                                    @foreach ($classes as $class)

                                    @if($student->class->id == $class->id)
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
                                <label for="status">Select Status</label>
                                <select class="form-select" name="status_id" id="status">
                                    <option disabled>Select a Status</option>

                                    @if(isset($statuses) && !empty($statuses))

                                    @foreach ($statuses as $status)

                                    @if($student->status->id == $status->id)
                                    <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
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



                            <div class="form-group mb-3">
                                <label for="gender">Gender</label>
                                <select class="rounded form-select" name="gender_id" id="gender">
                                    <option selected disabled>Select a Gender</option>

                                    @if(isset($genders) && !empty($genders))

                                    @foreach ( $genders as $gender )

                                    @if($student->gender->id == $gender->id)
                                    <option value="{{ $gender->id }}" selected>{{ $gender->name }}</option>

                                    @else
                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @endif


                                    @endforeach

                                    @endif

                                </select>

                                @error('gender_id')
                                <x-alert-failure message="{{ $message }}" />
                                @enderror
                            </div>







                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                            </div>

                        </form>



                    </div>

                </div>




                {{-- Password Management Card below --}}



                <div class="card">

                    <div class="card-body">

                        <h3 class="mb-4">Update Password</h3>

                        <form action="{{ route('admin.student.update_password', $student->id) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-3">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control w-100" />

                                @error('password')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror

                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control w-100" />

                                @error('password_confirmation')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                            </div>

                        </form>


                    </div>

                </div>


            </div>





        </div>

    </div>


</x-master-admin>