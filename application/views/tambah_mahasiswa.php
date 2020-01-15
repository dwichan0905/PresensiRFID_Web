<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Tambah Dosen Baru | <?= $app_name ?></title>

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
                            <small>Tambah Mahasiswa Baru</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-users"></i> Mahasiswa
                            </li>
                            <li>
                                <i class="fa fa-users"></i> Tambah Mahasiswa Baru
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-plus fa-fw"></i> Tambah</h3>
                            </div>
                            <div class="panel-body">
                                <!-- isi disini -->
                                <?php if ($error == true) { ?><label class="control-label" style="color: red;">ERROR: <?= $errorText ?></label><br><?php } ?>
                                <!-- isi disini -->
                                <form action="<?=base_url()?>mahasiswa/add_new.me" method="POST">
                                    <label class="control-label" for="inputError">NIM:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'nim') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon">NIM</span>
                                        <input type="text" name="nim" class="form-control" id="inputError" placeholder="Masukkan NIM disini..." value="<?= @$nim; ?>">
                                    </div>
                                    <label class="control-label" for="inputError">Nama Mahasiswa:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'nama') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon"><i class="fa fa-hdd-o fa-fw"></i></span>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama mahasiswa disini..." value="<?= @$nama; ?>">
                                    </div>
                                    <label class="control-label" for="inputError">Card ID:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'card') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon"><i class="fa fa-hdd-o fa-fw"></i></span>
                                        <input type="text" name="card_id" class="form-control" placeholder="Masukkan Card ID disini..." value="<?= @$card; ?>">
                                        <span class="input-group-btn"><button class="btn btn-default" type="button" onclick="window.open('<?=base_url()?>mahasiswa/rfcards/get_rfcards.me', '_blank', 'location=no,toolbar=no,height=500,width=450,status=no')"><i class="fa fa-search fa-fw"></i> Cari...</button></span>
                                    </div>
                                    <input type="submit" name="simpan" onclick="" class="btn btn-success btn-md" value="Simpan">
                                    <button type="reset" onclick="" class="btn btn-danger btn-md">Reset</button>
                                    <button type="button" onclick="location.href='<?= base_url() ?>mahasiswa.me'" class="btn btn-info btn-md">Kembali</button>
                                    
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
