<div class="row justify-content-center"> 
    <div class="col-md-4 col-md-offset-6 centered">
        <div class="alert alert-success">
        <strong>You was successfully registered!<br> Please verify your email now!</strong> 
        </div>
    </div>    
</div>

<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'registration/check_code'); ?>
				<h2 class="text-center">Email Verification</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter verification code you received." required="required" name="code">
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info btn-block"> Verify Now </button>
					</div>

			<?php echo form_close(); ?>
	</div>
</div>
