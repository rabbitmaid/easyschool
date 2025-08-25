<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>



        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card mb-4">

                    <div class="card-body">

                        <h5 class="text-muted">{{ $complain->user->username }}</h5>
                        <h3 class="mb-4">{{ $complain->title }}</h3>

                        <div class="bg-secondary text-white p-3 rounded-2">
                            <p class="mb-0"> {{ $complain->message }} </p>
                        </div>

                        <a href="{{ route('admin.complain') }}" class="btn btn-primary mt-4">All Complains</a>
                    </div>
    
                </div>


                @if(isset($complain_replies) && !empty($complain_replies) && count($complain_replies) > 0)

                    <h3 class="text-center">Replies</h3>

                    @foreach ( $complain_replies as $complain_reply )

                    <div class="card rounded mb-4 p-3 border-top border-2 border-primary">
        
                        <h4 class="text-muted mb-4">{{ $complain_reply->admin->username }} <small><span class="badge bg-primary rounded-pill">{{  $complain_reply->admin->course->name }}</span></small> <br /> <small>{{ \Carbon\Carbon::parse($complain->created_at)->diffForHumans() }}</small></h4>
                        <p class="mb-0">{{ $complain_reply->reply }}</p>

                    </div>
                        
                    @endforeach

                @endif


                <div class="card mb-4">
                    
                    <div class="card-body">
                        <form action="{{ route('admin.complain.reply') }}" method="POST">
                            @csrf

                            <input type="hidden" name="complain_id" value="{{ $complain->id }}" />
                            <input type="hidden" name="admin_id" value="{{ auth('admin')->user()->id }}" />
                        
                            <div class="form-group mb-3">
                                <label for="description">Comment</label>
    
                                <textarea name="reply" id="reply" class="form-control"
                                    style="resize: none"></textarea>
    
                                @error('reply')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">
                                Reply
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-down-left align-middle"><polyline points="9 10 4 15 9 20"></polyline><path d="M20 4v7a4 4 0 0 1-4 4H4"></path></svg>
                                  
                            </button>
    
                        </form>
                    </div>
                </div>


            </div>


        </div>

    </div>


</x-master-admin>