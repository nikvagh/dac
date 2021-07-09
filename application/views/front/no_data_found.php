<a class="no_data_found_box">
    <img src="<?php echo $this->front; ?>img/icon/no_data_found.png" alt="no data found">
    <?php if(isset($message)){ ?>
        <h3><?php echo $message; ?></h2>
    <?php }else{ ?>
        <h3>No items found</h2>
    <?php } ?>
</a>