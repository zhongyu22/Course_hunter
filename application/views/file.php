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

<?php echo form_open_multipart('upload/do_upload');?>
<div class="row justify-content-center">
    <div class="col-md-4 col-md-offset-6 centered">
        <?php echo $error;?>
		<div class="form-group">
            <input type="file" name="userfile" size="20" /> 
        </div>

        <div id='default_img'>
        <img id="select" src="#" alt="your image" />
        </div>

		<div class="form-group">
            <input type="submit" value="upload" />
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<h3></h3>
<div class="main"> </div>
