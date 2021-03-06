<!DOCTYPE html>
<html lang="en">
	<head>
  	    <?php $this->load->view('metadata'); ?>
        <title>Login | <?= $app_name ?></title>
        <?php $this->load->view('login/header'); ?>
    </head>
    <body class="app flex-row align-items-center">
		<!-- Background Image -->
		<div class="bg-img" style="background: url('<?= base_url('assets/login'); ?>/img/bg.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->
        <div class="container">
    	    <div class="row justify-content-center">
                <div class="col-md-8">
          			<div class="card-group">
					  	<div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
							<div class="card-body text-center">
								<div>
									<img class="img-responsive" src="<?=base_url()?>assets/resources/mahasiswa.png" height="200px"/>
									<br>
									<p><br><br>Copyright &copy; 2020. Created and Developed by Informatika 2018 A. All Rights Reserved.</p>
								</div>
							</div>
						</div>
            			<div class="card p-4">
							<form action="<?= base_url() ?>" method="POST">
								<div class="card-body">
									<h1>Masuk</h1>
									<p class="text-muted">Masuk ke <?= $app_name ?></p>
									<br />
									<br />
									<p><?= @$err ?></p>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="icon-user"></i>
											</span>
										</div>
										<input class="form-control" name="username" type="text" placeholder="NIDN/NIK" value="<?= @$un; ?>">
									</div>
									<div class="input-group mb-4">
										<div class="input-group-prepend">
											<span class="input-group-text">
											<i class="icon-lock"></i>
											</span>
										</div>
										<input class="form-control" name="password" type="password" placeholder="Kata Sandi">
									</div>
									<div class="row">
										<div class="col-6">
											<input class="btn btn-primary px-4" type="submit" name="submit" value="Masuk">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('login/footer'); ?>
  	</body>
</html>