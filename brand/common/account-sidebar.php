<div class="col-xl-3 col-lg-2 col-md-12 mb-4 mb-lg-0">
    <ul class="nav flex-column bg-light h-100 dashboard-list" role="tablist">
        <li><a href="<?php echo $base_url1;?>index" <?php if($current_page == 'index.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Dashboard</a></li>
        <li><a href="<?php echo $base_url1;?>view-brand-post" <?php if($current_page == 'view-brand-post.php' || $current_page == 'edit-brand-post.php' || $current_page == 'add-brand-post.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Manage Brand Post</a></li>
        <li><a href="<?php echo $base_url1;?>view-brand-inquiry" <?php if($current_page == 'view-brand-inquiry.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Brand Inquiry</a></li>
        <li><a href="<?php echo $base_url1;?>account-information" <?php if($current_page == 'account-information.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Account Information </a></li>
        <li><a href="<?php echo $base_url1;?>edit-password" <?php if($current_page == 'edit-password.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Chnage Password</a></li>
        <li><a href="<?php echo $base_url1;?>view-brand-payment" <?php if($current_page == 'view-brand-payment.php' || $current_page == 'add-brand-payment.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Payment History</a></li>
        <li><a href="<?php echo $base_url1;?>view-video-history" <?php if($current_page == 'view-video-history.php' || $current_page == 'edit-video-history.php'){ echo 'class="nav-link active"';}else{ echo 'class="nav-link"';} ?>>Video History</a></li>
        <li><a href="<?php echo $base_url1;?>logout">logout</a></li>
    </ul>
    <!-- End Nav tabs -->
</div>