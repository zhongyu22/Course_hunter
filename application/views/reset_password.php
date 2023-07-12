<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'login/resetPassword'); ?>
				<h2 class="text-center">Reset Password</h2>   
                <div class="form-group">
						<input type="text" class="form-control" value=<?php echo $email;?> required="required" name="email" style="visibility: hidden;">
					</div>    
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter your new password" required="required" name="password">
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Reset </button>
					</div>
   
			<?php echo form_close(); ?>
	</div>
</div>