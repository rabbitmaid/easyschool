<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="Easyschool">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
	<title>{{ isset($siteTitle) ? $siteTitle : 'EasySchool' }}{{ isset($pageTitle) ? ' - ' . $pageTitle : '' }}</title>
	<link href="{{ asset('assets/dashboard/css/app.css') }}" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

		<x-sidebar-admin />


		<div class="main">

			<x-navbar-admin />

			<main class="content">
				<div class="container p-0">

					{{ $slot }}

				</div>
			</main>

			<x-footer site-title="{{ $siteTitle }}" />

		</div>



	</div>


	<script src="{{ asset('assets/dashboard/js/app.js') }}"></script>


	<script>
		let modalDeleteForm = document.querySelector('#deleteForm');
    	let deleteButton = document.querySelectorAll('.deleteButton');

		deleteButton.forEach(button => {

			let resourceId = button.getAttribute('resource-id');
			let resourceName = button.getAttribute('resource-name');
			let baseURI = `{{ url('') }}`;
			let adminPoint = "master";

			let routeString = `${baseURI}/${adminPoint}/${resourceName}/delete/${resourceId}`;

			button.addEventListener('click', function(){
				modalDeleteForm.setAttribute('action', routeString);
			});

		});




		let addButton = document.querySelector('#addButton');
		let asignGroup = document.querySelector('#asign-group');


		function addSelect(){

				let count = 0;

				const row = document.createElement('div');
				row.className = 'row align-items-center mb-3';

				const columnLeft = document.createElement('div');
				columnLeft.className = 'col-11';

				const columnRight = document.createElement('div');
				columnRight.className = 'col-1';


				const select = document.createElement('select');
				select.className = 'form-select';
				select.setAttribute('name', 'class[]');



				const deleteBtn = document.createElement('button');
				deleteBtn.setAttribute('type', 'button')
				deleteBtn.className = 'btn btn-danger w-100 text-white mt-2 mt-md-0';

				deleteBtn.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
														viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
														stroke-linecap="round" stroke-linejoin="round"
														class="feather feather-trash-2 align-middle">
														<polyline points="3 6 5 6 21 6"></polyline>
														<path
															d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
														</path>
														<line x1="10" y1="11" x2="10" y2="17"></line>
														<line x1="14" y1="11" x2="14" y2="17"></line>
										</svg>`;
				// Remove corresponding row when delete button is clicked
				deleteBtn.addEventListener('click' , () => {
					row.remove();
				});



				row.appendChild(columnLeft);
				row.appendChild(columnRight);



		// Fetch options through laravel api and set them in the select

			let defaultOption = document.createElement('option');
			defaultOption.text = 'Select a Class';
			defaultOption.setAttribute('disabled', 'disabled');

			select.add(defaultOption);
			select.selectedIndex = 0;

			const url = '{{ route('es.class.api') }}';

			fetch(url)
			.then(
				function(response) {
				if (response.status !== 200) {
					console.warn('Looks like there was a problem. Status Code: ' +
					response.status);
					return;
				}

				// Examine the text in the response
				response.json().then(function(data) {
					let option;

					for (let i = 0; i < data.length; i++) {
					option = document.createElement('option');
					option.text = data[i].name;
					option.value = data[i].id;
					select.add(option);
					}
				});
				}
			)
			.catch(function(err) {
				console.error('Fetch Error -', err);
			});


			columnLeft.appendChild(select);
			columnRight.appendChild(deleteBtn);
			asignGroup.appendChild(row);
	}

	if(addButton){
		addButton.addEventListener('click', addSelect);
	}

	// Delete Button for already existing fields
	let allDeletBtns = document.querySelectorAll('.delete-btn');
	let existingRow = document.querySelectorAll('.default-row');


	for(let i = 0 ; i < allDeletBtns.length ; i++){
		allDeletBtns[i].addEventListener('click', ()=> {
			existingRow[i].remove();
		});
	}


	// ====================================================================

	let dynamicTeacher = document.querySelector('#dynamic_teacher');
	let dynamicClass = document.querySelector('#dynamic_class');


	dynamicTeacher.addEventListener('change', function() {
		let selectedOption = dynamicTeacher.value;
        fetchOptions(selectedOption);
	});


	function fetchOptions(selectedOption) {

		let baseUrl = `{{ url('') }}`;
		let requestUrl = baseUrl + '/api/teacher_class/' + selectedOption;

        fetch(requestUrl)
          .then(function(response) {
			if (response.status !== 200) {
				console.warn('Looks like there was a problem. Status Code: ' + response.status);
				return;
			}

            response.json()
				.then(function(data) {
            		populateSelectField(data);
        		});
          });
    }



    function populateSelectField(options) {

        dynamicClass.options.length = 0; // Make Sure the select field refreshes for each request

        options.forEach(function(option) {
          let optionElement = document.createElement('option');
          optionElement.value = option.id;
          optionElement.text = option.name;
          dynamicClass.add(optionElement);
        });

    }









	</script>


</body>

</html>
