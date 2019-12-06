<?php

require_once '../Config/UFunction.php';
$UDF_call = new UFunction();

$select_status = $UDF_call->select_order_limit('notification', 'n_id', 10);

?>

    <?php if($select_status){ foreach($select_status as $se_noti){ ?>
    <div class="dropdown-item" >
        <h6><?php echo $se_noti['n_sub']; ?></h6>
        <span><?php echo $se_noti['n_msg']; ?></span>
        <hr class="mt-1 mb-1">
    </div>
    <?php }} ?>
