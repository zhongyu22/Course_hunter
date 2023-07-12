
<div class="container">
<h2 class="text-center"><?php echo $title; ?></h2>
</div>

<div class="container">
  <div class="row">
<?php foreach ($courses as $course_item): ?>
  <div class="card col-4">
  <img class="card-img-top" src=<?= $course_item['cover_path'] ?> alt="Card image" style="width:100%">
  <div class="card-body"><?php echo $course_item['id']."<br>".$course_item['coursename']."<br>"; ?>Staff: <?php echo $course_item['staff'].'<br> Price: A$'.$course_item['price'].'<br> Likes:'.$course_item['likes'];?></div>     
  <div class="card-footer">
         <a href="<?php echo base_url();?>courses/load_detail/<?php echo $course_item['id'];?>">Go to details</a>
        </div>    
  </div>
<?php endforeach; ?>


<script>   
$(document).ready(function(){

  window.scroll(0, <?php echo (int)get_cookie('position'); ?>);

  $(document).scroll(function() {
        var position = $(this).scrollTop();        
        // console.log(position);
        $("#position").val(position);
        document.cookie = "position="+position; //Remember page scroll position
      })

});
</script>
