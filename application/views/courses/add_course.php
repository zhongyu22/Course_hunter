
<div class="container-fluid">
  <div class="row" style="padding-top: 5vh;">
    <div class="col" style="background-color:lavender;">
    <h1 class="text-center">Add course</h1>

    <div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'profile/add_course'); ?>    
					<div class="form-group" style="padding-top:2vh;">
						<input type="text" class="form-control" placeholder="Enter course id" required="required" name="course_id">
					</div>
                    <div class="form-group" style="padding-top:2vh;">
						<input type="text" class="form-control" placeholder="Enter course name" required="required" name="course_name">
					</div>
					<div class="form-group" style="padding-top:2vh;">
						<input type="text" class="form-control" placeholder="Enter course staff" required="required" name="course_staff">
					</div>
                    <div class="form-group" style="padding-top:2vh;">
						<input type="text" class="form-control" placeholder="Enter course intro" required="required" name="course_intro">
					</div>				
          <div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Add course </button>
					</div>   
			<?php echo form_close(); ?>
	</div>
</div>
    </div>
  </div>
</div>