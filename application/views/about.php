<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Tentang | <?= $app_name ?></title>

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
                            Tentang <small>Informasi terkait aplikasi ini</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-info"></i> Tentang
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> Informasi Versi Aplikasi</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-responsive table-bordered table-stripped table-hover">
                                    <tr>
                                        <th>Nama Aplikasi</th>
                                        <td><?= $app_name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Versi Aplikasi</th>
                                        <td><?= $app_ver ?></td>
                                    </tr>
                                    <tr>
                                        <th>Framework</th>
                                        <td>CodeIgniter</td>
                                    </tr>
                                    <tr>
                                        <th>Versi Framework</th>
                                        <td><?= CI_VERSION ?></td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan Aplikasi</th>
                                        <td>Dibuat untuk memenuhi tugas akhir Mikroprosesor yang ditugaskan oleh bapak <i>Agus Pramono, MT.</i> selaku dosen di Universitas AMIKOM Purwokerto.</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> Terimakasih Kepada</h3>
                            </div>
                            <div class="panel-body">
                                <br>
                                <ol>
                                    <li>Allah Swt. Serta Para Nabi dan Rasul-Nya</li>
                                    <li>Universitas AMIKOM Purwokerto</li>
                                    <li>Agus Pramono, MT (Dosen Mikroprosesor)</li>
                                    <li>Anak-anak Kelas Informatika 2018-A Semester 3</li>
                                    <li>GoDaddy.com (Layanan Domain dan Hosting)</li>
                                    <li>StackOverflow.com (Forum Programming)</li>
                                    <li>StartBootstrap.com (Template Website)</li>
                                    <li>CodeIgniter.com (Framework)</li>
                                    <li>Microsoft Corporation (Visual Studio Code)</li>
                                </ol>
                                dan masih banyak lagi yang tidak dapat kami sebutkan... 😊<br><br><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-responsive" src="<?=base_url()?>assets/resources/mahasiswa.png" height="600px"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> Credits</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-responsive table-bordered table-stripped table-hover">
                                    <tr>
                                        <th>Penanggungjawab</th>
                                        <td>Paras Taufani (18.11.0028)</td>
                                    </tr>
                                    <tr>
                                        <th>Programmer</th>
                                        <td>
                                            <table class="table table-responsive table-bordered table-stripped table-hover">
                                                <tr>
                                                    <th>Website</th>
                                                    <td>Dwi Candra Permana (18.11.0004)</td>
                                                </tr>
                                                <tr>
                                                    <th>Arduino</th>
                                                    <td>Dwi Candra Permana (18.11.0004)</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Desain Grafis</th>
                                        <td>
                                            <ol>
                                                <li>Achmad Masruri (18.11.0043)</li>
                                                <li>Dede Agung Prastowo (18.11.0049)</li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Desain Komponen</th>
                                        <td>
                                            <ol>
                                                <li>Titin Sulistiowati (18.11.0005)</li>
                                                <li>Diyah Primasari (18.11.0289)</li>
                                                <li>Safangat Tirto Jaya Sakti (18.11.0278)</li>
                                                <li>Paras Taufani (18.11.0028)</li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Peralatan dan Perlengkapan</th>
                                        <td>
                                            <ol>
                                                <li>Ilham Fatkhul Qorib (18.11.0170)</li>
                                                <li>Dicky Kusuma Rubianto (18.11.0033)</li>
                                                <li>Adhitya Wahyu Ridwanto (18.11.0027)</li>
                                            </ol>
                                        </td>
                                    </tr>
                                </table>
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
