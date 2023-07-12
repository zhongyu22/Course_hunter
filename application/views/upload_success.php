<div class="row justify-content-center"> 
    <div class="col-md-4 col-md-offset-6 centered">
        <h3>"You was successfully uploaded!"</h3>
        <ul>
            <?php foreach ($upload_data as $item => $value): ?>
                <li> <?php echo $item;?> <?php echo $value;?> </li>
                <?php endforeach;?>
        </ul>
        <p><?php echo anchor('upload', 'Upload Another File!') ?></p>
    </div>
</div>