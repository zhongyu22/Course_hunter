
<script>
$(document).ready(function() {
  $("#change_email_form").hide();

  $("#change_email_button").click(function() {
    if ($("#change_email_form").is(':hidden')) {
      $("#change_email_form").show();
    } else {
      $("#change_email_form").hide()
    }
  })
})
</script>



<div class="container-fluid">
  <div class="row" style="padding-top: 5vh;">
    <div class="col" style="background-color:lavender;">
    <p class="text-center"><img src=<?= base_url()."uploads/avatar.jpeg"?> alt="avatar"></p>
    <h1 class="text-center">Welcome, <?php echo $user_item['username']; ?> !</h1>
    <p class="text-center">Your current identity is: <?php echo $user_item['identity'];?></p>
    <p class="text-center">Your current email is: <?php echo $user_item['email'];?></p>
    <p class="text-center">Your Email is <?php if($user_item['verified'] == 0){echo "not verified";} else{echo "verified";} ?></p>

    <div id="verify_email_form" class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'registration/send_verfication_in_profile/'.$user_item["email"]);?>    
					<div class="form-group" >
						<input type="text" class="form-control" placeholder="Current email address" required="required" id="current_email1" name="email" style="visibility:hidden;">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Send verification code </button>
					</div>   
	     <?php echo form_close(); ?>
    </div>
    </div>

    <div id="enter_code_form" class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'registration/check_code'); ?> 
      <div class="form-group" >
						<input type="text" class="form-control" placeholder="Current email address" required="required" id="current_email2" name="email" style="visibility:hidden;">
					</div>   
					<div class="form-group" >
						<input type="text" class="form-control" placeholder="Enter verification code you received" required="required" name="code">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Verify Now </button>
					</div>   
	     <?php echo form_close(); ?>
    </div>
    </div>





    <div class="row">
      <div class="col-3"></div>
    <button id="change_email_button" type="button" class="btn btn-info col-6">Click here to change your email</button>
    </div>
    <div id="change_email_form" class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'profile/change_email'); ?>    
					<div class="form-group" style="padding-top:2vh;">
						<input type="text" class="form-control" placeholder="Enter your new email address" required="required" name="new_email">
					</div>
          <div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Change </button>
					</div>   
			<?php echo form_close(); ?>    
	</div>
</div>
    </div>
  </div>
</div>

<br>
<br>
<br>

<!-- Show user's favourite courses -->
<div class="container bg-light" >
<h3>Your favourite courses:</h3>

<div class="container">
  <div class="row">
<?php if ($favourites <> "") {foreach ($favourites as $favourite_item):?>
  <div class="card col-12">
    <div class="card-body">Course: <?php echo $favourite_item['courseid']; ?> 
			<?php echo form_open(base_url().'courses/remove_fav'); ?>     
						<input type="text" class="form-control" value=<?php echo $favourite_item['courseid'];?>  required="required" name="courseid" style="visibility:hidden;">
						<button type="submit" class="btn btn-primary btn-block"> Remove </button>
			<?php echo form_close(); ?>

      <?php echo form_open(base_url().'pdf_/print_course'); ?>     
						<input type="text" class="form-control" value=<?php echo $favourite_item['courseid'];?>  required="required" name="print" style="visibility:hidden;">
						<button type="submit" class="btn btn-primary btn-block"> Print course information </button>
			<?php echo form_close(); ?>

      <?php echo form_open(base_url().'pay/do_pay'); ?>     
						<input type="text" class="form-control" value=<?php echo $favourite_item['courseid'];?>  required="required" name="buy" style="visibility:hidden;">
						<button type="submit" class="btn btn-primary btn-block"> Buy this course </button>
			<?php echo form_close(); ?>

      </div>
      </div>
<?php endforeach;} else { echo "No favourites yet." ;} ?>
</div>
</div>
</div>

<br>
<br>
<br>



<div class="container">
  <h2>Your current location:</h2>
  <div id="map" style="width:100%;height:400px;"></div>
</div>




<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOWRs527lKmQVQLj2O3l_qUWQrRje3oJU&callback=myMap"></script>

<script>
 //Show verify button
 $(document).ready(function() {
    $("#current_email1").val("<?php echo $user_item["email"];?>");
    $("#current_email2").val("<?php echo $user_item["email"];?>");
    
    var verified = <?php echo $user_item["verified"];?>;
    if (verified == 1) {
      $("#verify_email_form").hide();
      $("#enter_code_form").hide();
    }
 })
 



  // load map
function initialize() {
  function success(position) {
      var latitude  = position.coords.latitude;
      var longitude = position.coords.longitude;
      var yourmap = {
          center:new google.maps.LatLng(latitude  ,longitude),
          zoom:11,
          mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      var map=new google.maps.Map(document.getElementById("map"), yourmap);
      var marker=new google.maps.Marker({
      position:new google.maps.LatLng(latitude  ,longitude),
      });
      marker.setMap(map);
      var infowindow = new google.maps.InfoWindow({
        content:"You are here!"
        });
      infowindow.open(map,marker);
        };
      function error() {
        alert('Geolocation is unavailabl!');
        };

        if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(success, error);
        } else {
        alert('Geolocation is unavailabl!');
        }
      };
      google.maps.event.addDomListener(window, 'load', initialize);
</script>