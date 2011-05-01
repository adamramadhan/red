<div class="ajax-status" id="<?php if ($ajax['updates'] == '0') {
	echo "none";
} else {
	echo "true"	;
}
?>
">
<?php echo $ajax['updates']; ?> Updates <a id="ajax-dashboard-refresh" href="#"><?php $views->getIMG('i/arrow_refresh_small.png'); ?></a></div>