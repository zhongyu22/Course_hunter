<!DOCTYPE html>
<html>
<head>
<title>Image manipulation using codeigniter</title>
    <!-- Dropzone CSS & JS -->
    <link href='<?= base_url() ?>assets/css/dropzone.css' type='text/css' rel='stylesheet'>
    <script src='<?= base_url() ?>assets/js/dropzone.js' type='text/javascript'></script>
    <style>
    
    .content{
      width: 50%;
      padding: 5px;
      margin: 0 auto;
    }
    .content span{
      width: 250px;
    }
    .dz-message{
      text-align: center;
      font-size: 28px;
    }
    </style>

<script>
// Add restrictions
Dropzone.options.fileupload = {
  acceptedFiles: 'image/*',
  maxFilesize: 10 // MB
};
</script>

<script>
// Show select image using file input.
  function readURL(input) {
  $('#default_img').show();
  if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
  $('#select')
  .attr('src', e.target.result)
  .width(300)
  .height(200);

  };

  reader.readAsDataURL(input.files[0]);
  }
  }
</script>
</head>

<body>
<h2 id="form_head">Manipulate your upload</h2><br/>
<div class='content'>
      <!-- Dropzone -->
      <form action="<?= base_url() ?>upload/fileupload" class="dropzone" id="fileupload">
      </form> 
</div> 


</ul>

<div>
<div>
<div>
<div id="content">

<div id="form_input">
<?php
$data = array(
'enctype' => 'multipart/form-data'
);
// Form open
echo form_open('upload/value', $data);

// File input field.
$file = array(
'type' => 'file',
'name' => 'userfile',
'required' => '',
'onchange' => 'readURL(this);'
);
echo form_input($file);  // "choose file button"
echo "<br>";
echo "<br>";
?>
<?php // show image which we choose in file input?>
<div id='default_img'>
<img id="select" src="#" alt="your image" />
</div>
<br>
<br>
<?php

// Radio Button "resize" field.
$radio = array(
'type' => 'radio',
'name' => 'mode',
'value' => 'resize',
'id' => 'resize_button'
);
echo form_input($radio);
echo form_label('Resize');
echo "<br>";
echo "<br>";

// Radio Button "watermark" field.
$radio = array(
'type' => 'radio',
'name' => 'mode',
'value' => 'watermark',
'id' => 'watermark_button'
);
echo form_input($radio);
echo form_label(' Water Mark');
?>
<div id="form_button">
<?php
// Submit Button.
echo form_submit('submit', 'Upload', "class='submit'");
?>
</div>
</div>

<?php // Input fields for resize option.?>
<div id='resize' style='display: none'>
<div id='content_result'>
<?php
echo "<h3 id='result_id'>Enter width & height for resize image</h3><br/><hr>";
echo "<div id='result_show'>";
echo "<label class='label_output'>Width :</label>";
$data_width = array(
'name' => 'width',
'class' => 'input_box',
'value' => '200',
'id' => 'width'
);
echo form_input($data_width);
echo "<br>";
echo "<br>";
echo "<label class='label_output'>Height:</label>";
$data_height = array(
'name' => 'height',
'class' => 'input_box',
'value' => '200',
'id' => 'height'
);
echo form_input($data_height);
?>
</div>
</div>
</div>

<?php // Result image will show on here.?>
<div id='img_resize'>

<?php
if (isset($img_src)) {
    echo "<p>Success..</p>";
    echo "<img src='" . $img_src . "'/>";
}
?>
<?php
if (isset($rot_image)) {
    echo "<p>Success..</p>";
    echo "<img src='" . $rot_image . "'/>";
}
?>
<?php
if (isset($watermark_image)) {
    echo "<p>Success..</p>";
    echo "<img src='" . $watermark_image . "'/>";
}
?>
<?php
if (isset($crop_image)) {
    echo "<p>Success..</p>";
    echo "<img src='" . $crop_image . "'/>";
}
?>

</div>

<?php // Input fields for watermark option.?>
<div id='water_mark' style='display: none'>
<div id='water_result'>
<?php
echo "<h3 id='result_id'>Enter text for watermark image</h3><br/><hr>";
echo "<div id='result_show'>";
echo "<label class='label_output'>Text :</label>";
$data_text = array(
'name' => 'text',
'class' => 'input_box',
'value' => 'Type anything you like',
'id' => 'watermark_text'
);
echo form_input($data_text);
?>
</div>
</div>
</div>
</div>
</div>
<?php echo form_close(); ?>
</div>

<script> //Only show selected feature and hide unselected features
$("#resize_button").click(function() {
$('div#img_resize').hide();
$('div#crop').hide();
$('div#water_mark').hide();
$('div#rotate').hide();
$('div#resize').show();
});
$("#watermark_button").click(function() {
$('div#img_resize').hide();
$('div#resize').hide();
$('div#crop').hide();
$('div#rotate').hide();
$('div#water_mark').show();
});
</script>

</body>
</html>

<!--
  Multiple files uploading and grag & drop features are powered by dropzone:
   https://www.dropzone.dev/js/ 
  -->