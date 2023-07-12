<br>

<style>
    img {
        width:100%; 
        height:50vh; 
    }
</style>


<div id="frontpage_slides" class="carousel slide" data-ride="carousel">
 
  <!-- indicators -->
  <ul class="carousel-indicators">
    <li data-target="#frontpage_slides" data-slide-to="0" class="active"></li>
    <li data-target="#frontpage_slides" data-slide-to="1"></li>
    <li data-target="#frontpage_slides" data-slide-to="2"></li>
  </ul>
 
  <!-- slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src=<?= base_url()."uploads/city.jpeg"?> >
    </div>
    <div class="carousel-item">
      <img src=<?= base_url()."uploads/city2.jpeg"?> >
    </div>
    <div class="carousel-item">
      <img src=<?= base_url()."uploads/city3.jpeg"?> >
    </div>
  </div>
 
  <!-- left and right button -->
  <a class="carousel-control-prev" href="#frontpage_slides" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#frontpage_slides" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
 
</div>

<br>