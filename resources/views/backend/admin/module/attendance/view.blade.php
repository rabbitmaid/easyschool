<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row">

        <div class="col-12">
            <x-alert-notify />
        </div>

        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <div class="row">
                                <div
                                    class="col-12 col-md-9 d-flex justify-content-center justify-content-md-start align-items-center">
                                    <form action="" method="GET">
                                        <div class="col-12">
                                            <input type="search" class="form-control" title="Press Enter to Search"
                                                placeholder="Search..." name="search" id="search"
                                                value="{{ (request()->query('search') != null) ? request()->query('search') : '' }}">
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="col-12 col-md-3 d-flex justify-content-center justify-content-md-end align-items-center">
                                    
                                </div>
                            </div>
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:25%;">Administrator</th>
                                    <th style="width:25%">Student</th>
                                    <th style="width:25%;">Class</th>
                                    <th style="width:25%">Attendance</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($attendances) && !empty($attendances) && count($attendances) > 0)

                                @foreach ( $attendances as $attendance )

                                <tr>

                                    <td>
                                        {{ $attendance->admin->username }}

                                        <span class="badge bg-primary rounded-pill">
                                            {{ $attendance->admin->course->name }}
                                        </span>

                                    </td>
                                
                                    <td>
                                        {{ $attendance->user->username }}
                                        
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $attendance->user->class->name }}
                                        </span>
                                    </td>
          
                                    <td>{{ $attendance->class->name }}</td>
                                   
                                    <td>
                                        @if($attendance->is_present == 1)
                                        <span class="badge bg-primary">{{ __('Present') }}</span>
                                        @elseif($attendance->is_present == 0)
                                        <span class="badge bg-danger">{{ __('Absent') }}</span>
                                        @endif
                                    </td>
                                    
                                </tr>

                                @endforeach

                                @else

                                <tr>
                                    <td colspan="8" class="text-center">No Attendance Found</td>
                                </tr>

                                @endif

                            </tbody>




                        </table>
                    </div>

                    <div class="card-footer">
                            {{-- {{ $complains->links() }} --}}
                    </div>

                </div>
            </div>

        </div>
    </div>



</x-master-admin>