{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pengeluaran</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('module/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('module/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('module/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('module/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('module/dist/css/adminlte.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('module/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('module/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('module/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('module/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('module/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('module/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('module/plugins/summernote/summernote-bs4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link" role="button">
                            <button type="submit" style="border: none;background:#ffffff">Logout</button>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('module/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">LTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('module/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    Siswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('savings.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Tabungan
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Informasi Tabungan Siswa</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Home</a></li>
                                <li class="breadcrumb-item active">Siswa</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @if (session('success'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        @if (session('failed'))
                            <div class="col-sm-12">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    {{ session('failed') }}
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Data Diri Siswa</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-key mr-1"></i> NIS</strong>
                                    <p class="text-muted">{{ $student->nis }}</p>
                                    <hr>

                                    <strong><i class="fas fa-user mr-1"></i> Nama</strong>
                                    <p class="text-muted">{{ $student->name }}</p>
                                    <hr>

                                    <strong><i class="fas fa-phone mr-1"></i> Telp</strong>
                                    <p class="text-muted">{{ $student->phone }}</p>
                                    <hr>

                                    <strong><i class="fas fa-book mr-1"></i> Kelas</strong>
                                    <p class="text-muted">{{ $student->class }}</p>
                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                                    <p class="text-muted">{{ $student->address }}</p>
                                </div>
                                <!-- /.card-footer-->
                            </div>


                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Total Saldo Tabungan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button> --}}
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <strong><i class="fas fa-money-bill mr-1"></i> Hari Ini</strong>
                                            <p class="text-muted" id="saving_in_day">Rp
                                                {{ number_format($totalSavingInDay, 2) }}</p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <input type="date" class="form-control" placeholder="Lihat tanggal"
                                                onchange="getSavingInDay(this.value)">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <strong><i class="fas fa-money-bill mr-1"></i> Bulan Ini</strong>
                                            <p class="text-muted" id="saving_in_month">Rp
                                                {{ number_format($totalSavingInMonth, 2) }}</p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <input type="month" class="form-control" placeholder="Lihat bulan"
                                                onchange="getSavingInMonth(this.value)">
                                        </div>
                                    </div>
                                    <hr>

                                    <strong><i class="fas fa-money-bill mr-1"></i> Total Tabungan</strong>
                                    <p class="text-muted">Rp {{ number_format($balance, 2) }}</p>

                                </div>
                            </div>

                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="m-0"> Data Pengeluaran </h5>
                                        </div>

                                        <div class="col-6 text-right">
                                            <a href="{{ route('expenses.created', $student->id) }}"
                                                class="btn btn-info">Tambah Data Pengeluaran</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Nominal</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <td>{{ $data->created_at }}</td>
                                                    <td>{{ $data->student->nis }}</td>
                                                    <td>{{ $data->student->name }}</td>
                                                    <td>Rp {{ number_format($data->amount, 2) }}</td>
                                                    <td>{{ $data->note }}</td>
                                                    <td>
                                                        <div class="margin">
                                                            <div class="btn-group">
                                                                <form
                                                                    action="{{ route('expenses.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    <a href="{{ route('expenses.edit', $data->id) }}"
                                                                        class="btn-sm btn-warning"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        style="border: none; padding: 0.3em 0.6em"
                                                                        class="btn-sm btn-danger"
                                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total Pengeluaran</th>
                                                <th colspan="3">Rp {{ number_format($totalExpense, 2) }}</th>
                                            </tr>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>




                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="m-0"> Data Pemasukan </h5>
                                        </div>

                                        <div class="col-6 text-right">
                                            <a href="{{ route('savings.create', $student->id) }}"
                                                class="btn btn-info">Tambah Data Pemasukan</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Nominal</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($saving as $data)
                                                <tr>
                                                    <td>{{ $data->created_at }}</td>
                                                    <td>{{ $data->student->nis }}</td>
                                                    <td>{{ $data->student->name }}</td>
                                                    <td>Rp {{ number_format($data->amount, 2) }}</td>
                                                    <td>{{ $data->note }}</td>
                                                    <td>
                                                        <div class="margin">
                                                            <div class="btn-group">
                                                                <form
                                                                    action="{{ route('savings.destroy', $data->id) }}"
                                                                    method="POST">
                                                                    <a href="{{ route('savings.edit', $data->id) }}"
                                                                        class="btn-sm btn-warning"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        style="border: none; padding: 0.3em 0.6em"
                                                                        class="btn-sm btn-danger"
                                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total Pemasukan</th>
                                                <th colspan="3">Rp {{ number_format($totalSaving, 2) }}</th>
                                            </tr>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('module/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('module/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('module/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('module/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('module/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('module/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('module/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('module/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('module/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('module/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('module/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('module/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('module/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('module/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('module/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('module/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('module/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('module/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('module/dist/js/adminlte.js') }}"></script>


    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "aLengthMenu": [
                    [15, 50, 100, 200, -1],
                    [15, 50, 100, 200, "All"]
                ],
                "buttons": ["csv", "excel", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "aLengthMenu": [
                    [15, 50, 100, 200, -1],
                    [15, 50, 100, 200, "All"]
                ],
                "buttons": ["csv", "excel", "pdf"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });


        function getSavingInDay(value) {
            let url = window.location.href;
            let id = url.substring(url.lastIndexOf('/') + 1);

            $.ajax({
                url: `/amount-savings-day?student_id=${id}&date=${value}`,
                type: "GET",
                success: (res) => {
                    $('#saving_in_day').html(res)
                }
            })
        }

        function getSavingInMonth(value) {
            let url = window.location.href;
            let id = url.substring(url.lastIndexOf('/') + 1);

            $.ajax({
                url: `/amount-savings-month?student_id=${id}&date=${value}`,
                type: "GET",
                success: (res) => {
                    $('#saving_in_month').html(res)
                }
            })
        }
    </script>
</body>

</html>
