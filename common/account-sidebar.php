<div class="col-xl-3 col-lg-2 col-md-12 mb-4 mb-lg-0">
    <ul class="nav flex-column bg-light h-100 dashboard-list" role="tablist">
        <li><a href="<?php echo $base_url;?>account-dashboard" <?php if($current_page == 'account-dashboard.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Account Dashboard</a></li>
        <li><a href="<?php echo $base_url;?>account-information" <?php if($current_page == 'account-information.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Account Information </a></li>
        <li><a href="<?php echo $base_url;?>edit-password" <?php if($current_page == 'edit-password.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Chnage Password</a></li>
        <li><a href="<?php echo $base_url;?>my-wishlist" <?php if($current_page == 'my-wishlist.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>My Wishlist</a></li>
        <li><a href="<?php echo $base_url;?>my-order" <?php if($current_page == 'my-order.php' || $current_page == 'view-order.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>My Order</a></li>
        <li><a href="<?php echo $base_url;?>logout">logout</a></li>
    </ul>
</div>