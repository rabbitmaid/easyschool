<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"  dashboard-route="{{ route('admin.dashboard') }}"  />

    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">

                    @if(isset($classes) && !empty($classes))

                        @foreach ( $classes as $class )
                            
                        <div class="col-sm-4">


                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h2 class="card-title">{{ $class->name }}</h2>
                                        </div>
        
                                        <div class="col-auto">
                                            @if($class->id != 1)
                                                <a href="{{ route('admin.student.class', $class->id) }}" class="btn btn-primary" title="See Students">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor align-middle"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    @if($class->status->id == 1)
                                    <div class="text-success mb-3"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $class->status->name }} </div>
                                    @else
                                        <div class="text-danger mb-3"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $class->status->name }} </div>
                                    @endif
                        
                                </div>
                            </div>

                        </div>


                        @endforeach

                    @endif




                </div>
            </div>
        </div>
    </div>


</x-master-admin>