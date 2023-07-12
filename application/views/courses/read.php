<div class="container">
<h2 class="text-center"><?php echo $title; ?></h2>
</div>

<div class="container">
  <div class="card">
    <div class="card-header"><?php echo $course_item['id']."<br>".$course_item['coursename']; ?></div>
    <div class="card-body">Staff: <?php echo $course_item['staff']; ?></div>   
        <div class="card-footer">
         <a href="<?php echo base_url();?>courses/load_detail/<?php echo $course_item['id'];?>">Go to details</a>
        </div>   
  </div>
</div>