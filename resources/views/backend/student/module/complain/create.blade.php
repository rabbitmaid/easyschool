<x-master site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('student.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>



        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Complain Information</h3>

                        <form action="{{ route('student.complain.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
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
                                <label for="message">Message</label>

                                <textarea name="message" id="message" class="form-control" style="resize: none">{{ old('message') }}</textarea>
          

                                @error('message')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            

                            <div class="form-group mb-3">
                                <label for="teacher">Select Teacher <span class="text-danger">*</span></label>
                                <select class="form-select" name="admin_id" id="teacher">
                                    <option selected disabled>Select a Teacher</option>

                                    @if(isset($admins) && !empty($admins))

                                    @foreach ($admins as $admin)

                                    <option value="{{$admin->id }}">{{ $admin->firstname . ' ' . $admin->lastname }}</span></option>

                                    @endforeach

                                    @else

                                    <option selected disabled>No Teacher Found</option>

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



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>

                        </form>



                    </div>

                </div>


            </div>


        </div>

    </div>


</x-master>