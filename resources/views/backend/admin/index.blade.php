<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px;">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Students</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalStudents) && ($totalStudents > 0 ) ? $totalStudents
                                    : 0 }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Admins</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalAdmins) && ($totalAdmins > 0 ) ? $totalAdmins : 0
                                    }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Classes</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalClasses) && ($totalClasses > 0 ) ? $totalClasses :
                                    0 }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Courses</h5>
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
                                <h5 class="card-title mb-4">Total Inactive Students</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalInactiveStudents) && ($totalInactiveStudents > 0 )
                                    ? $totalInactiveStudents : 0 }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Active Students</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalActiveStudents) && ($totalActiveStudents > 0 ) ?
                                    $totalActiveStudents : 0 }}</h1>
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

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Live Classes Methods</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalLiveClassMethods) && ($totalLiveClassMethods > 0) ?
                                    $totalLiveClassMethods : 0 }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Genders</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalGenders) && ($totalGenders > 0 ) ?
                                    $totalGenders : 0 }}</h1>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Male Students</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalMaleStudents) && ($totalMaleStudents > 0 ) ?
                                    $totalMaleStudents : 0 }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xl-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total Female Students</h5>
                                <h1 class="mt-1 mb-3">{{ isset($totalFemaleStudents) && ($totalFemaleStudents > 0 ) ?
                                    $totalFemaleStudents : 0 }}</h1>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-master-admin>