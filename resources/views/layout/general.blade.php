<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title ?? '' }} | Diakonia Efrata Wosi</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">

    <!-- Main styles for this application-->
    <link rel="stylesheet" href="{{ asset('assets/css/coreui.css') }}">
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    @yield('style')
</head>

<body>
    <div class="bg-body-tertiary min-vh-100 d-flex flex-row align-items-center">
        @yield('content')

    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#tableBase").DataTable({
                dom: "<'.row'<'col-12 col-md-6 pb-2'l><'col-12 col-md-4 ms-auto pb-2'f>><'.row'<'col-12'tr>><'.row'<'col-4'i><'col-8'p>>",
                language: {
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Data ke _START_ - _END_ dari _TOTAL_",
                    infoFiltered: "(disaring dari total _MAX_ data)",
                    emptyTable: "Tidak ada data",
                    infoEmpty: "Menampilkan 0 data",
                    zeroRecords: "Data tidak ditemukan",
                },
                pageLength: 25,
                autoWidth: false,
            });
        });
    </script>
    @yield('script')
</body>

</html>
