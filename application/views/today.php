<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Presensi Hari Ini | <?= $app_name ?></title>

    <?php $this->load->view('admin/header'); ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php $this->load->view('admin/nav'); ?>
            <?php $this->load->view('admin/sidebar'); ?>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Aktivitas Presensi <small>Hari Ini</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-file"></i> Aktivitas Presensi
                            </li>
                            <li class="active">
                                <i class="fa fa-calendar"></i> Hari Ini
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-calendar fa-fw"></i> Presensi Hari Ini</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" style="overflow-x: hidden !important;">
                                    <table class="table table-hover table-striped dataTables">
                                        <thead>
                                            <tr>
                                                <th width="50">NIM</th>
                                                <th>Nama</th>
                                                <th width="50">Jam Masuk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($list_log as $u) { ?>
                                            <tr>
                                                <td><?= $u->nim ?></td>
                                                <td><?= $u->nama ?></td>
                                                <td><?= date('H:i:s', strtotime($u->timestamp)) ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php $this->load->view('admin/footer'); ?>

    <script>
        $('.dataTables').DataTable();
    </script>

</body>

</html>
