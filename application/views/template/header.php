<html>
        <head>
                <title>Course Hunter</title>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/autocomplete.css">
                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        </head>
        <body>
  <nav class="navbar navbar-expand-sm bg-primary navbar-dark navbar-fixed-top">
  <a class="navbar-brand" href="#">Course Hunter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse navbar-fixed-top" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
            <a class="nav-link" href="<?php echo base_url(); ?>welcome"> Home </a>

            <?php if($this->session->userdata('logged_in')) : ?> 
            <a class="nav-link" href="<?php echo base_url(); ?>upload"> Upload </a>  
            <?php endif; ?> 
             
            <a class="nav-link" href="<?php echo base_url(); ?>courses"> Courses </a>  
            <!--Show Profile if user has logged in -->
            <?php if($this->session->userdata('logged_in')) : ?> 
            <a class="nav-link" href="<?php echo base_url(); ?>profile"> Profile </a>
           <?php endif; ?>   
    </ul>
    <ul class="navbar-nav my-lg-0">
    <?php if(!$this->session->userdata('logged_in')) : ?>
            <a class="nav-link" href="<?php echo base_url(); ?>login"> Login </a>
          <?php endif; ?>
          <?php if($this->session->userdata('logged_in')) : ?>
            <a class="nav-link" href="<?php echo base_url(); ?>login/logout"> Logout </a>
           <?php endif; ?>
        
           <!-- Registration -->
           <?php if(!$this->session->userdata('logged_in')) : ?> 
            <a class="nav-link" href="<?php echo base_url(); ?>registration"> Register </a>

           <?php endif; ?>
    </ul>

    </div>
    <form class="form-inline my-2 my-lg-0">
      <?php echo form_open('ajax'); ?>
      <input class="form-control mr-sm-2" type="search" id="search_text" value="" placeholder="Search" name="search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="button" id="search_button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> </button>
      <?php echo form_close(); ?>
</nav>
<div class="container">
<div class="collapse" id="collapseExample">
  <div class="card card-body" id="result">

  </div>
</div>
<script>
    $(document).ready(function(){
    load_data();
        function load_data(query){
            $.ajax({
            url:"<?php echo base_url(); ?>ajax/fetch",
            method:"GET",
            data:{query:query},
            success:function(response){
                $('#result').html("");
                if (response == "" ) {
                    $('#result').html(response);
                }else{
                    var obj = JSON.parse(response);
                    if(obj.length>0){
                        var items=[];
                        $.each(obj, function(i,val){
                            items.push($("<h4>").text(val.filename));
                            if (val.filename.includes("jpeg") || val.filename.includes("jpg")) {
                                items.push($('<img width="320" height="240" src="' +'<?php echo base_url(); ?>/uploads/' +val.filename + '" />'));
                            }else{
                                items.push($('<video width="320" height="240" controls><source  src="' +'<?php echo base_url(); ?>/uploads/' +val.filename + '" type="video/mp4"></video>'));
                            }
                    });
                    $('#result').append.apply($('#result'), items);         
                    }else{
                    $('#result').html("Not Found!");
                    }; 
                };
            }
        });
        }

        function auto_match(query) {
            $.ajax({
                url:"<?php echo base_url(); ?>ajax/fetch",
                method:"GET",
                data:{query:query},
                success:function(response) {
                    if (response != "") {
                        var obj = JSON.parse(response);
                        console.log(obj);
                        if (obj.length == 1) {
                            document.getElementsByTagName("input")[0].value = obj[0].filename;
                        }
                    } else {}
                }
            })
        }


        // Press Show result button
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            }else{
                load_data();
            }
        });

        $("#search_text").bind("input propertychange", function() { // get text in input field
            var current_text = $(this).val();
            auto_match(current_text);
        });

    });
</script>

<style>
#search_button.btn.collapsed:before 
{ 
    content:'Show Result' ; 
}
#search_button.btn:before
{
    content:'Hide Result' ;
}
</style>