<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Tambah Perangkat Baru | <?= $app_name ?></title>

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
                            <small>Tambah Perangkat Baru</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-hdd-o"></i> Perangkat
                            </li>
                            <li>
                                <i class="fa fa-hdd-o"></i> Tambah Perangkat Baru
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
                                <?php if ($error == true) { ?><label class="control-label" style="color: red;">ERROR: <?= $errorText ?></label><br><?php } ?>
                                <!-- isi disini -->
                                <form action="<?=base_url()?>devices/add_new.me" method="POST">
                                    <label class="control-label" for="inputError">Device ID:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'id') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon">ID</span>
                                        <input type="text" name="id" maxlength="20" class="form-control" id="inputError" placeholder="Masukkan Device ID disini..." value="<?= @$id; ?>">
                                    </div>
                                    <label class="control-label" for="inputError">Nama Perangkat:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'nama') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon"><i class="fa fa-hdd-o fa-fw"></i></span>
                                        <input type="text" name="nama" maxlength="50" class="form-control" placeholder="Masukkan nama perangkat disini..." value="<?= @$nama; ?>">
                                    </div>
                                    <input type="submit" name="simpan" onclick="" class="btn btn-success btn-md" value="Simpan">
                                    <button type="reset" onclick="" class="btn btn-danger btn-md">Reset</button>
                                    <button type="button" onclick="location.href='<?= base_url() ?>devices.me'" class="btn btn-info btn-md">Kembali</button>
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
