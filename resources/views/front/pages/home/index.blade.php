<!DOCTYPE html>
<html lang="en">

<head>
    <!-- INCLUDE HEAD -->
    @include('front.layout.head')
    <!-- INCLUDE ASSETS -->
    <link rel="stylesheet" href="{{ asset('front-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @include('front.layout.assets')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- INCLUDE NAVBAR -->
        @include('front.layout.navbar')


        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Customer List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Submitted Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customer as $cust)
                                                <tr>
                                                    <td>{{$cust['id']}}</td>
                                                    <td>{{$cust['name']}}
                                                    </td>
                                                    <td>{{$cust['phone']}}</td>
                                                    <td>{{$cust['email']}}</td>
                                                    <td>{{$cust['created_at']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Submitted Date</th>
                                                </tr>
                                            </tfoot>
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
            </div>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <!-- INCLUDE FOOTER -->
        @include('front.layout.footer')

    </div>


    <script src="{{ asset('front-assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('front-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>