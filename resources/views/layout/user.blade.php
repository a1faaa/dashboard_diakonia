<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>{{ $title ?? '' }} | Diakonia Efrata Wosi</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('assets/css/coreui.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <style>
        .responsive-chart {
            width: 45vw;
            /* 45% of the viewport width */
            height: 45vw;
            /* Keeps the chart square */
            max-width: 600px;
            max-height: 600px;
            margin: 10px;
            /* Space between the charts */
        }
        
        /* Reset for body and html to avoid overflow */
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* Prevent horizontal scroll */
        }

        /* GANTI WARNA CUI */
        /* Custom background color classes for the new ranges */
        .bg-cui-red {
            background-color: var(--cui-red) !important;
        }

        .bg-cui-orange {
            background-color: var(--cui-orange) !important;
        }

        .bg-cui-yellow {
            background-color: var(--cui-yellow) !important;
        }
    </style>
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand">
                Diakonia Efrata Wosi
                {{-- <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui.svg#full"></use>
                </svg>
                <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui.svg#signet"></use>
                </svg> --}}
            </div>
            <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas" data-coreui-theme="dark"
                aria-label="Close"
                onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item">
                <a class="nav-link <?= isset($sidebar) && $sidebar == 'dashboard' ? 'active' : '' ?>"
                    href="{{ route('user.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" viewBox="0 0 512 512">
                        <path fill="var(--ci-primary-color, currentColor)"
                            d="M425.706,142.294A240,240,0,0,0,16,312v88H160V368H48V312c0-114.691,93.309-208,208-208s208,93.309,208,208v56H352v32H496V312A238.432,238.432,0,0,0,425.706,142.294Z"
                            class="ci-primary" />
                        <rect width="32" height="32" x="80" y="264" fill="var(--ci-primary-color, currentColor)"
                            class="ci-primary" />
                        <rect width="32" height="32" x="240" y="128" fill="var(--ci-primary-color, currentColor)"
                            class="ci-primary" />
                        <rect width="32" height="32" x="136" y="168" fill="var(--ci-primary-color, currentColor)"
                            class="ci-primary" />
                        <rect width="32" height="32" x="400" y="264" fill="var(--ci-primary-color, currentColor)"
                            class="ci-primary" />
                        <path fill="var(--ci-primary-color, currentColor)"
                            d="M297.222,335.1l69.2-144.173-28.85-13.848L268.389,321.214A64.141,64.141,0,1,0,297.222,335.1ZM256,416a32,32,0,1,1,32-32A32.036,32.036,0,0,1,256,416Z"
                            class="ci-primary" />
                    </svg> Dashboard</a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link <?= isset($sidebar) && $sidebar == 'kegiatan' ? 'active' : '' ?>"
                    href="{{ route('user.kegiatan.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" viewBox="0 0 512 512">
                        <path fill="var(--ci-primary-color, currentColor)"
                            d="M334.627,16H48V496H472V153.373ZM440,166.627V168H320V48h1.373ZM80,464V48H288V200H440V464Z"
                            class="ci-primary" />
                        <rect width="224" height="32" x="136" y="296" fill="var(--ci-primary-color, currentColor)"
                            class="ci-primary" />
                        <rect width="224" height="32" x="136" y="376" fill="var(--ci-primary-color, currentColor)"
                            class="ci-primary" />
                    </svg> Kegiatan
                </a>
            </li>
        </ul>
        <div class="sidebar-footer border-top d-none d-md-flex">
            <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
        </div>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100">
        <header class="header header-sticky p-0 mb-4">
            <div class="container-fluid border-bottom px-4">
                <button class="header-toggler" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
                    style="margin-inline-start: -14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" viewBox="0 0 512 512">
                        <rect width="352" height="32" x="80" y="96"
                            fill="var(--ci-primary-color, currentColor)" class="ci-primary" />
                        <rect width="352" height="32" x="80" y="240"
                            fill="var(--ci-primary-color, currentColor)" class="ci-primary" />
                        <rect width="352" height="32" x="80" y="384"
                            fill="var(--ci-primary-color, currentColor)" class="ci-primary" />
                    </svg>
                </button>
                <ul class="header-nav">
                    <li class="nav-item dropdown"><a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->fullname }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold">
                                <div class="fw-semibold">Settings</div>
                            </div><a class="dropdown-item" href="{{ route('user.profile') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" viewBox="0 0 512 512">
                                    <path fill="var(--ci-primary-color, currentColor)"
                                        d="M411.6,343.656l-72.823-47.334,27.455-50.334A80.23,80.23,0,0,0,376,207.681V128a112,112,0,0,0-224,0v79.681a80.236,80.236,0,0,0,9.768,38.308l27.455,50.333L116.4,343.656A79.725,79.725,0,0,0,80,410.732V496H448V410.732A79.727,79.727,0,0,0,411.6,343.656ZM416,464H112V410.732a47.836,47.836,0,0,1,21.841-40.246l97.66-63.479-41.64-76.341A48.146,48.146,0,0,1,184,207.681V128a80,80,0,0,1,160,0v79.681a48.146,48.146,0,0,1-5.861,22.985L296.5,307.007l97.662,63.479h0A47.836,47.836,0,0,1,416,410.732Z"
                                        class="ci-primary" />
                                </svg> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('general.aksi.logout') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" viewBox="0 0 512 512">
                                        <polygon fill="var(--ci-primary-color, currentColor)"
                                            points="77.155 272.034 351.75 272.034 351.75 272.033 351.75 240.034 351.75 240.033 77.155 240.033 152.208 164.98 152.208 164.98 152.208 164.979 129.58 142.353 15.899 256.033 15.9 256.034 15.899 256.034 129.58 369.715 152.208 347.088 152.208 347.087 152.208 347.087 77.155 272.034"
                                            class="ci-primary" />
                                        <polygon fill="var(--ci-primary-color, currentColor)"
                                            points="160 16 160 48 464 48 464 464 160 464 160 496 496 496 496 16 160 16"
                                            class="ci-primary" />
                                    </svg> Logout
                                </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="container-fluid px-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0">
                        <?php
                        if (isset($breadcrumb) && is_array($breadcrumb)) {
                            $lastIndex = count($breadcrumb) - 1; // Get the index of the last breadcrumb item
                            $counter = 0;
                            foreach ($breadcrumb as $key => $value) {
                                if ($counter == $lastIndex) {
                                    // Last item, no link
                                    echo '<li class="breadcrumb-item active" aria-current="page">' . htmlspecialchars($value) . '</li>';
                                } else {
                                    // Non-last item with link
                                    echo '<li class="breadcrumb-item"><a href="' . htmlspecialchars($key) . '">' . htmlspecialchars($value) . '</a></li>';
                                }
                                $counter++;
                            }
                        }
                        ?>
                    </ol>
                </nav>
            </div>
        </header>
        <div class="body flex-grow-1">
            <div class="px-4">
                <h1 class="app-page-title mb-0">{{ $page_title ?? '' }}</h1>
                <p>{{ $page_subtitle ?? '' }}</p>
                @if (session('flash'))
                    {!! session('flash')['message'] !!}
                @endif
                @yield('content')
            </div>
        </div>
        <footer class="footer px-4">
            <div class="row">
                <div class="col-12">
                    <span class="float-end">Diakonia Efrata Wosi © 2024</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#tableBase").DataTable({
                dom: "<'.row'<'col-md-6 pb-2'l><'col-md-6 ms-auto pb-2'f>><'.row'<'col-12'tr>><'.row'<'col-4'i><'col-8'p>>",
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
    <script>
        const header = document.querySelector('header.header');

        document.addEventListener('scroll', () => {
            if (header) {
                header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
            }
        });
    </script>
    @yield('script')
</body>

</html>
