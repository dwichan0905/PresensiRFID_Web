<!DOCTYPE html>
<html lang="en">
	<head>
  	    <?php $this->load->view('metadata'); ?>
        <title>Login | <?= $app_name ?></title>
        <?php $this->load->view('login/header'); ?>
    </head>
    <body class="app flex-row align-items-center">
        <div class="container">
    	    <div class="row justify-content-center">
                <div class="col-md-8">
          			<div class="card-group">
					  	<div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
							<div class="card-body text-center">
								<div>
									<h2>Sign up</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
									<button class="btn btn-primary active mt-3" type="button">Register Now!</button>
								</div>
							</div>
						</div>
            			<div class="card p-4">
              				<div class="card-body">
                				<h1>Masuk</h1>
                				<p class="text-muted">Masuk ke <?= $app_name ?></p>
                				<div class="input-group mb-3">
                  					<div class="input-group-prepend">
                    					<span class="input-group-text">
                      						<i class="icon-user"></i>
                    					</span>
            		      			</div>
                  					<input class="form-control" type="text" placeholder="NIDN/NIK">
                				</div>
                				<div class="input-group mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text">
										<i class="icon-lock"></i>
										</span>
									</div>
                  					<input class="form-control" type="password" placeholder="Kata Sandi">
                				</div>
                				<div class="row">
									<div class="col-6">
										<button class="btn btn-primary px-4" type="button">Masuk</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('login/footer'); ?>
  	</body>
</html>