<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'registration/check_reg'); ?>
				<h2 class="text-center">Registration</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username(Only Numbers and letters)" required="required" name="username">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Email Address" required="required" name="email">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password(More than 5 characters)" required="required" name="password">
					</div>
                    <div class="form-group">
						<input type="password" class="form-control" placeholder="Confirm your passpord" required="required" name="confirm_psw">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter captcha number below" required="required" name="cap_word">
					</div>
					<div>
						<?php echo $image; ?>
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info btn-block">Register Now</button>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="captcha number " required="required" value=<?php echo $cap_word; ?> name="word" style="visibility: hidden;">
					</div>

			<?php echo form_close(); ?>
	</div>
</div>


