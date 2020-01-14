<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Dashboard | <?= $app_name ?></title>

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
                            Beranda <small>Sekilas Informasi</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Beranda
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Informasi</strong><br />Selamat Datang di <?= $app_name; ?>, <?= $username; ?>!
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $mhs_count->mhs_cnt; ?></div>
                                        <div>Mahasiswa Terdaftar!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= base_url(''); ?>mahasiswa.me">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Selengkapnya</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $dev_count->dev_cnt; ?></div>
                                        <div>Perangkat Terdaftar!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= base_url(''); ?>devices.me">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Selengkapnya</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $act_count->act_cnt; ?></div>
                                        <div>Aktivitas Presensi Hari Ini! <?= @$dt; ?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= base_url(''); ?>activity/today.me">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Selengkapnya</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> 10 Aktivitas Presensi Terbaru</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="50">NIM</th>
                                                <th>Nama</th>
                                                <th width="150">Tanggal Masuk</th>
                                                <th width="50">Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($last_activity as $u) { ?>
                                            <tr>
                                                <td><?= $u->nim ?></td>
                                                <td><?= $u->nama ?></td>
                                                <td><?= date('j F Y', strtotime($u->timestamp)) ?></td>
                                                <td><?= date('H:i:s', strtotime($u->timestamp)) ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="<?= base_url(''); ?>activity/all.me">Lihat semua aktivitas <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> 10 Aktivitas Presensi Hari Ini</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="50">NIM</th>
                                                <th>Nama</th>
                                                <th width="50">Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($today_activity as $u) { ?>
                                            <tr>
                                                <td><?= $u->nim ?></td>
                                                <td><?= $u->nama ?></td>
                                                <td><?= date('H:i:s', strtotime($u->timestamp)) ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="<?= base_url(''); ?>activity/today.me">Lihat semua aktivitas <i class="fa fa-arrow-circle-right"></i></a>
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

</body>

</html>
