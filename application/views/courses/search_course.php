<!-- <form class="form-inline" action="courses/read">
  <label for="course_id"  class="mr-sm-2">Course Id:</label>
  <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter course id" id="course_id" name="course_id">
  <button type="submit" class="btn btn-primary mb-2">Search course</button>
</form> -->


            <?php echo form_open(base_url().'courses/show_search_result'); ?>
				<h2 class="text-center">Search courses</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter course info(course name, id or staff name )" required="required" name="course_info">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block" >Search now</button>
					</div>
			<?php echo form_close(); ?>