<x-master site-title="{{ $siteTitle['value'] }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle['value'] }}" dashboard-route="{{ route('student.dashboard') }}" />

    
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px;">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Assignments</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalAssignments) && ($totalAssignments > 0 ) ? $totalAssignments
                                    : 0 }}</h1>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Class Courses</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalCourses) && ($totalCourses > 0 ) ? $totalCourses :
                                    0 }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Complains</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalComplains) && ($totalComplains > 0 )
                                    ? $totalComplains : 0 }}</h1>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Live Classes</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalLiveClasses) && ($totalLiveClasses > 0 ) ?
                                    $totalLiveClasses : 0 }}</h1>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-master>