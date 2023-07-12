<!DOCTYPE html>
<html>
<h1>Details of <?php echo $course_item['id']." ".$course_item['coursename'];?></h1>

<div class="container bg-info">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'courses/add_fav'); ?>  
					<div class="form-group">
						<input type="text" class="form-control courseid" placeholder="courseid" required="required"  name="courseid" style="visibility: hidden;height:1px;">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Add to your favourites </button>
					</div>  
			<?php echo form_close(); ?>
	</div>
</div>
<br>
<br>
<br>

<div class="container bg-light" >
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'courses/add_comment'); ?>  
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Write comments here" required="required" id="comment" name="comment">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Submit comments </button>
					</div> 
					<div class="form-group">
						<input type="text" class="form-control courseid" placeholder="courseid" required="required"  name="courseid" style="visibility: hidden;height:1px;">
					</div> 
			<?php echo form_close(); ?>
	</div>
</div>
<br>
<br>

<div class="container bg-info">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'courses/like_course'); ?>  
					<div class="form-group">
						<input type="text" class="form-control courseid" value=<?= $course_item['id'] ?> required="required"  name="courseid" style="visibility: hidden;height:1px;">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Like this course </button>
					</div>  
			<?php echo form_close(); ?>
	</div>
</div>

<!-- Show comments -->
<div class="container bg-light" >
<h3>Course comments for <?php echo $course_item['coursename'];  ?>:</h3>
<div class="container">
  <div class="row" id="comments_box">

  <?php if ($comments == "") {echo "No comments";} else {foreach ($comments as $comment_item): ?>
	<div class="card col-12">
    <div class="card-header"><?php echo "User: ".$comment_item['username']; ?></div>
    <div class="card-body">Contents: <?php echo $comment_item['comment']; ?></div>  
  </div>
  <?php endforeach;} ?>





</div>
</div>
</div>
</html>






<script>
    $(document).ready(function(){
        var courseid = "<?php echo $course_item['id'];?>";
        // console.log(courseid);
        $(".courseid").val(courseid);
        
	
});

</script>

