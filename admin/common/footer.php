<!-- Footer -->
<?php
    $current_year = date('Y', strtotime(_get_current_date()));
?>
<div class="footer text-muted">
	<span style="float: left;">
		&copy; <?php echo $current_year ?>. <a href="<?php echo $base_url; ?>index"><?php echo $company_title ;?></a>
	</span>
</div>
<!-- /footer -->
