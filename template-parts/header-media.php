<?php
$obj        = ucfwp_get_queried_object();
$videos     = ucfwp_get_header_videos( $obj );
$images     = ucfwp_get_header_images( $obj );
$video_loop = get_field( 'page_header_video_loop', $obj );
$header_content_type = ucfwp_get_header_content_type( $obj );
$header_height       = get_field( 'page_header_height', $obj );
$exclude_nav         = get_field( 'page_header_exclude_nav', $obj );
$is_fullscreen       = $header_height === 'header-media-fullscreen';
?>

<?php if ( $is_fullscreen ): ?>
<div class="header-media-layout-fullscreen">
<?php endif; ?>

<?php
// Keep site navigation on its own solid background above the header media.
if ( ! $exclude_nav ) { echo ucfwp_get_nav_markup( false ); }
?>

<div class="header-media <?php echo $header_height; ?> mb-0 d-flex flex-column">
	<div class="header-media-background-wrap">
		<div class="header-media-background media-background-container">
			<?php
			// Display the media background (video + picture)
			if ( $images ) {
				$bg_image_srcs = ucfwp_get_header_media_picture_srcs( $header_height, $images );
				echo ucfwp_get_media_background_picture( $bg_image_srcs );
			}
			if ( $videos ) {
				echo ucfwp_get_media_background_video( $videos, $video_loop );
			}
			?>
		</div>
	</div>

	<?php
	// Display the inner header contents
	?>
	<div class="header-content">
		<div class="header-content-flexfix">
			<?php echo ucfwp_get_header_content_markup(); ?>
		</div>
	</div>

	<?php
	// Print a spacer div for headers with background videos (to make
	// control buttons accessible), and for headers showing a standard
	// title/subtitle to push them up a bit
	if ( $videos || $header_content_type === 'title_subtitle' ):
	?>
	<div class="header-media-controlfix"></div>
	<?php endif; ?>
</div>

<?php if ( $is_fullscreen ): ?>
</div>
<?php endif; ?>
