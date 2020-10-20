<html lang="en" class="no-js">
   
    <head>
        <?php $this->load->view("psmsfrontend/template/header-css"); ?>
       <link rel="stylesheet" href="<?php echo base_url(); ?>psmsfrontendtheme/pages/login_c.css" >
    </head>

<body id="body" data-spy="scroll" data-target=".header">

           
    
        <div class="container" style="margin-top:50px">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong> Sign in to continue</strong>
					</div>
					<div class="panel-body">
						<form class="submitlogin_form form-horizontal" method="POST" action="<?php echo base_url(); ?>login_controller/loginhandle">
							<fieldset>
								<div class="row">
									<div class="center-block">
										<img class="profile-img"
											src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" alt="">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                                            
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control" placeholder="Username" name="loginname" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control" placeholder="Password" name="password" type="password" value="">
											</div>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
										</div>
                                                                                    </form>
									</div>
								</div>
							</fieldset>
                                                </form>
					</div>
					<div class="panel-footer ">
						Forgot your password? <a href="#" onClick=""> Click Here </a>
                                        </div> 
                                </div>
                </div>
			</div>
		</div>
	</div>
    
    <footer class="footer">
        <?php $this->load->view("psmsfrontend/template/footer"); ?>
    </footer>

        <?php $this->load->view("psmsfrontend/template/header-js"); ?>

    </body>
    <!-- END BODY -->
</html>