<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'login/send_reset_link'); ?>
				<h2 class="text-center">Forgot password</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter your email address" required="required" name="email">
					</div>
					<div class="form-group">
					<?php //echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Reset your password </button>
					</div>
					<p>You will recieve an email attaching an link, just click it and then reset your new password.</p>
			<?php echo form_close(); ?>
	</div>
</div>