<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Perangkat | <?= $app_name ?></title>

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
                            Perangkat <small>Kelola Perangkat Terdaftar</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-hdd-o"></i> Perangkat
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" onclick="" class="btn btn-success btn-md">Tambah Perangkat Baru</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-hdd-o fa-fw"></i> Daftar Perangkat</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" style="overflow-x: hidden !important;">
                                    <table class="table table-hover table-striped dataTables">
                                        <thead>
                                            <tr>
                                                <th width="50">Device ID</th>
                                                <th>Nama Perangkat</th>
                                                <th width="50">Waktu Modifikasi</th>
                                                <th width="150">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($list_dev as $u) { ?>
                                            <tr>
                                                <td><?= $u->id ?></td>
                                                <td><?= $u->name ?></td>
                                                <td><?= date("d/m/Y H:i:s", strtotime($u->timestamp)); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" onclick="">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="">Delete</button>
                                                </td>
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
