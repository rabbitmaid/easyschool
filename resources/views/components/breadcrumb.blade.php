<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>{{ $pageTitle }}</strong> - Dashboard</h3>
    </div>

    <div class="col-auto ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                <li class="breadcrumb-item"><a href="{{ $dashboardRoute }}">{{ $siteTitle }}</a></li>
                <li class="breadcrumb-item"><a href="{{ $dashboardRoute }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
            </ol>
        </nav>
    </div>
</div>