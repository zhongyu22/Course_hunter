<?php 
if ($comments <> "") {foreach ($comments as $comment_item):
?>
  <div class="card col-12">
    <div class="card-header"><?php echo "User: ".$comment_item['username']; ?></div>
    <div class="card-body">Contents: <?php echo $comment_item['comment']; ?></div>  
  </div>
<?php 
endforeach;} else { echo "No comments yet." ;} 
?>