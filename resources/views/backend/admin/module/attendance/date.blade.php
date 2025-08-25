<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}" dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row">

        <div class="col-12">
            <x-alert-notify />
        </div>

        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="col-12 col-xl-12">


                    @if(isset($attendance_dates) && !empty($attendance_dates) && count($attendance_dates) > 0)

                    @foreach ( $attendance_dates as $attendance_date )

                    <div class="card rounded mb-4 p-3 border-top border-2 border-primary">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4 class="text-muted">{{\Carbon\Carbon::parse( $attendance_date->day)->format('l jS \\of F Y') }}</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end">
                                <a href="{{ route('admin.attendance.view', [$class->id, $attendance_date->day]) }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor align-middle"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    @else

                    <div class="card rounded mb-4 p-3 border-top border-2 border-primary text-center">
                        <h4 class="text-muted">No Marked Attendance Found</h4>
                    </div>

                    @endif

                 

                    {{ $attendance_dates->links() }}
           
            </div>
        </div>
    </div>



</x-master-admin>
