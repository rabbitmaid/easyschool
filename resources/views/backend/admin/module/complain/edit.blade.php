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

                        <h3 class="mb-4">Complain Information</h3>

                        <form action="{{ route('admin.complain.update', $complain->id) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{ $complain->title }}"
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

                                <textarea name="message" id="message" class="form-control" style="resize: none">{{ $complain->message }}</textarea>
          

                                @error('description')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            

                            <div class="form-group mb-3">
                                <label for="is_read">State</label>
                                <select class="form-select" name="is_read" id="is_read">
                                    <option selected disabled>Select a State</option>
                                    @if($complain->is_read == 1)
                                        <option value="1" selected>Read</option>
                                        <option value="0">Unread</option>
                                    @else
                                        <option value="1">Read</option>
                                        <option value="0" selected>Unread</option>
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