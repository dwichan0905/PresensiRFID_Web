<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Mahasiswa | <?= $app_name ?></title>

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
                            Mahasiswa <small>Kelola Mahasiswa Terdaftar</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-users"></i> Mahasiswa
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" onclick="" class="btn btn-success btn-md">Tambah Mahasiswa Baru</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Daftar Mahasiswa</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" style="overflow-x: hidden !important;">
                                    <table class="table table-hover table-striped dataTables">
                                        <thead>
                                            <tr>
                                                <th width="50">NIM</th>
                                                <th>Nama</th>
                                                <th width="150">Card ID</th>
                                                <th width="50">Jml. Hadir</th>
                                                <th width="150">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($list_mhs as $u) { ?>
                                            <tr>
                                                <td><?= $u->nim ?></td>
                                                <td><?= $u->nama ?></td>
                                                <td><?= $u->card_id ?></td>
                                                <td><?= $u->cnt ?> kali</td>
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
