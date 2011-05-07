<a id="ajax-dashboard-refresh" href="#"><div class="ajax-status" id="<?php if ($ajax['updates'] == '0') {
	echo "none";
} else {
	echo "true"	;
}
?>
">
<?php echo $ajax['updates']; ?> Updates <?php $views->getIMG('i/arrow_refresh_small.png'); ?></div></a>