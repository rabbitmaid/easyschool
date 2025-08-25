<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="Easyschool">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
	<title>{{ isset($siteTitle) ? $siteTitle : 'EasySchool' }}{{ isset($pageTitle) ?  ' - ' . $pageTitle : '' }}</title>
	<link href="{{ asset('assets/dashboard/css/app.css') }}" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

        <x-sidebar />

        
        <div class="main">

            <x-navbar />

            <main class="content">
				<div class="container p-0">

                    {{ $slot }}

				</div>
			</main>

            <x-footer site-title="{{ $siteTitle }}" />
           
        </div>



    </div>


<script src="{{ asset('assets/dashboard/js/app.js') }}"></script>

</body>

</html>