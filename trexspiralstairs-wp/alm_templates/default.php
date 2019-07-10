<?php if(get_post_type(get_the_ID()) == 'inspire' ):?>

<?php
// pattern for masonry grid
$pattern = array(
	'wide',
	'small',
	'tall',
	'tall',
	'small',
	'wide',
	'small',
	'small',
	'tall',
	'small',
	'small',
	'small',
	);
$pattern_classes = array(
	'wide' => 'width2 height2',
	'small' => 'small',
	'tall' => 'height2'
	);
?>
<?php
	$imgID = get_field('image');
	$imgSize = "full";
	$imgArr = wp_get_attachment_image_src( $imgID, $imgSize );
	$crop = get_field('image_crop');

	$pattern_key = $alm_current - 1;
	$size = $pattern_classes['wide'];
		if (isset($pattern[$pattern_key])) {
			$size = $pattern_classes[$pattern[$pattern_key]];
		}

	$reveal_id = 'inspiration-'.get_the_ID();
?>
<div class="grid-item <?php echo $size; ?>" data-reveal-id="<?php echo $reveal_id; ?>">
	<div class="padding-border">
		<div class="inspiration_image image is-hover" data-open="inspiration-<?php $postid = get_the_ID(); echo $postid ?>" style="<?php if($crop): ?>background-position:<?php echo $crop; ?>;<?php endif; ?>background-image:url('<?php echo $imgArr[0]; ?>');">
			<div class="overlay">
				<div class="inspiration_content-wrap">
					<?php the_content(); ?>
					<button type="button" class="btn button">View Larger <i class="icon icon-open-external"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="large reveal inspiration-reveal" id="<?php echo $reveal_id; ?>" data-animation-in="fadeIn fast" data-reveal>
		<div class="close-button-wrap">
			<button class="close-button" data-close aria-label="Close modal" type="button"><i class="icon icon-close"></i></button>
		</div>
		<?php 
		$image = get_field('image');
		$size = 'full'; // (thumbnail, medium, large, full or custom size)
		if( $image ) {
			echo wp_get_attachment_image( $image, $size );
		}
		?>
	</div>
</div>
<?php endif;?>

