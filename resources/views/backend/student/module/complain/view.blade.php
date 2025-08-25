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
                        <h5 class="text-muted">{{ $complain->user->username }}</h5>
                        <h3 class="mb-4">{{ $complain->title }}</h3>

                        <div class="bg-secondary text-white p-3 rounded-2">
                            <p class="mb-0"> {{ $complain->message }} </p>
                        </div>

                        <a href="{{ route('student.complain') }}" class="btn btn-primary mt-4">All Complains</a>
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
            </div>


        </div>

    </div>


</x-master>