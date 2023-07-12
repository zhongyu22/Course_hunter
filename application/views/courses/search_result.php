<div class="container">
<h2 class="text-center"><?php echo $title;?></h2>
</div>

<div class="container">
  <div class="row">
<?php foreach ($courses as $course_item): ?>
  <div class="card col-4">
   <img class="card-img-top" src=<?= ".".$course_item['cover_path'] ?> alt="Card image" style="width:100%">
    <div class="card-body"><?php echo $course_item['id']."<br>".$course_item['coursename']."<br>"; ?>Staff: <?php echo $course_item['staff']; ?></div> 
    <div class="card-footer">
         <a href="<?php echo base_url();?>courses/load_detail/<?php echo $course_item['id'];?>">Go to details</a>
        </div>   
  </div>
<?php endforeach; ?>
</div>
</div>






