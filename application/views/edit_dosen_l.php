<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Ubah Pengguna | <?= $app_name ?></title>

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
                            <small>Pengaturan Pengguna</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-user fa-fw"></i> Pengguna
                            </li>
                            <li>
                            <i class="fa fa-gear fa-fw"></i> Pengaturan
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

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

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-pencil fa-fw"></i> Ubah Data</h3>
                            </div>
                            <div class="panel-body">
                                <!-- isi disini -->
                                <?php if ($error == true) { ?><label class="control-label" style="color: red;">ERROR: <?= $errorText ?></label><br><?php } ?>
                                <!-- isi disini -->
                                <form action="<?= base_url() ?>users/modify.me" method="POST">
                                    <label class="control-label" for="inputError">NIDN/NIK:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'id') || ($errorOn == 'req') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon">ID</span>
                                        <input type="text" name="nidn" class="form-control" id="inputError" placeholder="Masukkan NIDN/NIK disini..." value="<?= @$id; ?>">
                                    </div>
                                    <label class="control-label" for="inputError">Nama Lengkap:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'nama') || ($errorOn == 'req') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama dosen disini..." value="<?= @$nama; ?>">
                                    </div>
                                    <div class="col-lg">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-plus fa-fw"></i> Ubah Kata Sandi</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-info">
                                                        <i class="fa fa-info-circle"></i> Kosongkan apabila Anda tidak ingin mengubah kata sandi Anda!
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="control-label" for="inputError">Kata Sandi:</label>
                                            <div class="form-group input-group <?= (($errorOn == 'pw') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                <input type="password" name="pw" class="form-control" placeholder="Masukkan kata sandi disini...">
                                            </div>
                                            <label class="control-label" for="inputError">Ulangi Kata Sandi:</label>
                                            <div class="form-group input-group <?= (($errorOn == 'pw') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                                <input type="password" name="pw2" class="form-control" placeholder="Masukkan ulang kata sandi disini...">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="simpan" onclick="" class="btn btn-success btn-md" value="Simpan"/>
                                    <button type="reset" onclick="" class="btn btn-danger btn-md"><i class="fa fa-refresh fa-fw"></i> Reset</button>
                                </form>
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

</body>

</html>
