<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Dashboard</title>

    <!-- Font Awesome Icons -->
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('css/admin-css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
		@include('layouts.admin.header') 
		@include('layouts.admin.sidebar') 

		@yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        @include('layouts.admin.footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- Sweet Alert 2 cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        (function($) {
            $(document).ready(function() {
                @if(Session::has('success'))
                    swtoaster("{{ Session::get('success') }}", 'success');
                @endif
                @if(Session::has('error'))
                    swtoaster("{{ Session::get('error') }}", 'error');
                @endif
                @if(Session::has('warning'))
                    swtoaster("{{ Session::get('warning') }}", 'warning');
                @endif
                @if(Session::has('info'))
                    swtoaster("{{ Session::get('info') }}", 'info');
                @endif
                @if(Session::has('question'))
                    swtoaster("{{ Session::get('question') }}", 'question');
                @endif

                function swtoaster(text, icon, timer=3000, timerProgressBar=true) {
                    Swal.fire({
                        title: text,
                        showConfirmButton: false,
                        icon: icon,
                        toast: true,
                        position: 'top-end',
                        timer: timer,
                        timerProgressBar: timerProgressBar,
                        customClass: {
                            // popup: 'bg-warning',
                            // title: 'text-light',
                            // content: 'text-light'
                        }
                    })
                }
            });

            $(document).ready(function() {
                $(document).on('click', '.delete', function(e) {
                    e.preventDefault();
                    var swal_link = $(this).attr('href');
                    Swal.fire({
                        title: "Are you sure to delete?",
                        text: "This will delete your data permanently!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire({
                                title: "Deleted!",
                                text: 'You data has been deleted.',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                            })
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire ({
                                title: 'Cancelled!',
                                text: 'You have chosen to keep data.',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    })
                })
            });
        })(jQuery);
    </script>

    <!-- AdminLTE App -->
	<script src="{{ asset('js/admin-js/adminlte.js') }}"></script>
	<script src="{{ asset('js/admin-js/custom.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    {{-- <script src="{{ asset('js/admin-js/demo.js') }}"></script> --}}

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
	<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- PAGE SCRIPTS -->
    {{-- <script src="{{ asset('js/admin-js/pages/dashboard2.js') }}"></script> --}}
</body>

</html>