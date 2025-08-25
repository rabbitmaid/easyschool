<x-master site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('student.dashboard') }}" />

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
                                    <th style="width:10%;">Administrator</th>
                                    <th style="width:5%;">Title</th>
                                    <th style="width:20%">Message</th>
                                    <th style="width:5%">State</th>
                                    <th style="width:8%">Time</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($complains) && !empty($complains) && count($complains) > 0)

                                @foreach ( $complains as $complain )

                                <tr>
                                    <td>
                                        {{ $complain->admin->firstname . ' ' . $complain->admin->lastname }}

                                        <span class="badge bg-primary rounded-pill">
                                            {{ $complain->admin->course->name }}
                                        </span>

                                    </td>
                                    <td>{{ $complain->title }}</td>
                                    <td>{{ substr( $complain->message, 0, 50) }}</td>
                                   
                                    <td>
                                        @if($complain->is_read == 1)
                                        <span class="badge bg-primary">{{ __('Read') }}</span>
                                        @elseif($complain->is_read == 0)
                                        <span class="badge bg-secondary">{{ __('Unread') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php

                                            $complainDate = \Carbon\Carbon::parse($complain->created_at)->diffForHumans();
                                        @endphp

                                        {{ $complainDate }}

                                    </td>
                                    <td class="table-action">

                                        <a href="{{ route('student.complain.view', $complain->id) }}" class="btn btn-success text-white" title="view">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>

                                        <a href="{{ route('student.complain.edit', $complain->id) }}" class="btn btn-primary text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor align-middle"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                        </a>

                                        
                                    </td>
                                </tr>

                                @endforeach

                                @else

                                <tr>
                                    <td colspan="8" class="text-center">No Complains Found</td>
                                </tr>

                                @endif

                            </tbody>




                        </table>
                    </div>

                    <div class="card-footer">
                            {{ $complains->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>



</x-master>