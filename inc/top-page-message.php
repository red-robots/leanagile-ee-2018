<?php
    $notification_header = get_field('event_nofication_header');
    if($notification_header):
?>
<div class="top-page-message">
	<?php echo $notification_header; ?>
</div>
<?php endif; ?>