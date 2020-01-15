<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Mahasiswa | <?= $app_name ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/admin'); ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?= base_url('assets/admin'); ?>/css/plugins/morris.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?= base_url('assets/admin'); ?>/css/plugins/dataTables.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/admin'); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body bgcolor="white">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Daftar Card ID</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> Silakan salin Card ID yang akan ditambahkan ke mahasiswa, lalu tempel ke kolom "Card ID".
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped dataTables">
                                <thead>
                                    <tr>
                                        <th width="150">Card ID</th>
                                        <th width="50">Ditambahkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list_cards as $u) { ?>
                                    <tr>
                                        <td><?= $u->card_id ?></td>
                                        <td><?= date('j F Y H:i:s', strtotime($u->card_added)) ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-danger btn-md" onclick="window.close();">&times; Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    <?php $this->load->view('admin/footer'); ?>

    <script>
        $('.dataTables').DataTable();
    </script>

</body>

</html>
