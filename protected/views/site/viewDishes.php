
<?php foreach($view as $data){ ?>

    <label><input type="checkbox" name="dishes" id="dish1" value="<?php echo $data["dish_name"] ?>"> <?php echo $data["dish_name"] ?></label>

<?php } ?>    
