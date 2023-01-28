<!doctype html>
<html lang="en" class="dark-theme">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('admin/assets/images/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{asset('admin/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/assets/plugins/input-tags/css/tagsinput.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('admin/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('admin/assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{asset('admin/assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{asset('admin/assets/css/header-colors.css')}}" />

	{{-- DataTable  --}}
	<link href="{{asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	{{-- Toastr --}}
	<link rel="stylesheet" type="text/css" href="{{asset('toastr/toastr.css')}}" >
	{{-- Fa Fa Icons  --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<title>Vendor - Dashboard</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			@include('vendor.body.sidebar')
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		@include('vendor.body.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			@yield('vendor')
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('vendor.body.footer')
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/chartjs/js/Chart.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/jquery-knob/excanvas.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
	{{-- Select2 --}}
	<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
	<script>
		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
	{{-- DataTable --}}
	<script src="{{asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

	{{-- Sweet Alert --}}
	<script src="{{ asset('admin/assets/js/sweetalert.js') }}"></script>
	<script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>
	{{-- Toastr --}}
	<script type="text/javascript" src="{{asset('toastr/toastr.min.js')}}"></script>
	<script>
		@if(Session::has('message'))
		var type = "{{ Session::get('alert-type','info') }}"
		switch(type){
		   case 'info':
		   toastr.info(" {{ Session::get('message') }} ");
		   break;
	   
		   case 'success':
		   toastr.success(" {{ Session::get('message') }} ");
		   break;
	   
		   case 'warning':
		   toastr.warning(" {{ Session::get('message') }} ");
		   break;
	   
		   case 'error':
		   toastr.error(" {{ Session::get('message') }} ");
		   break; 
		}
		@endif 
	</script>
	<script>
		$(function() {
			$(".knob").knob();
		});
	</script>
	<script src="{{asset('admin/assets/plugins/input-tags/js/tagsinput.js')}}"></script>
	<script src="{{asset('admin/assets/js/index.js')}}"></script>
	<script src="{{asset('admin/assets/js/validate.min.js')}}"></script>
	<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
	<script>
		tinymce.init({
		selector: '#mytextarea'
		});
	</script>
	<!--app JS-->
	<script src="{{asset('admin/assets/js/app.js')}}"></script>
</body>
</html>