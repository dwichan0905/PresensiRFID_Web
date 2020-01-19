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

                <?php if ($this->session->tempdata('messages')) {?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Informasi</strong><br /><?= $this->session->tempdata('messages'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" onclick="location.href = '<?= base_url('') ?>mahasiswa/add_new.me'" class="btn btn-default btn-md"><img src="<?= base_url()?>assets/resources/plus.png" height="15"/> Tambah Mahasiswa Baru</button>
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
                                <div class="table-responsive">
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
                                                    <a class="btn" href="<?= base_url()?>mahasiswa/modify/<?= $u->nim ?>.me" title="Ubah mahasiswa <?= $u->nama ?>" onclick=""><img src="<?= base_url()?>assets/resources/pencil.png" height="30"/></a>
                                                    <button type="button" class="btn" title="Hapus mahasiswa <?= $u->nama ?>" onclick="delmhs(`<?= base_url(); ?>`,'<?= $u->nim ?>',`<?= $u->nama ?>`)"><img src="<?= base_url()?>assets/resources/delete.png" height="30"/></button>
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
