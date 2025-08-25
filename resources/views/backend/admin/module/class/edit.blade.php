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

                        <h3 class="mb-4">Class Information</h3>

                        <form action="{{ route('admin.class.update', $class->id) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ $class->name }}"
                                    class="form-control w-100" />

                                @error('name')
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
                                    style="resize: none">{{ $class->description }}</textarea>


                                @error('description')
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

                                    @if($class->status->id == $status->id)
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