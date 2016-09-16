<?php
/**
 * Download button Biddys
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
?>
<p id="monitor-button"><a class="aligncenter" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
		<span>Download </span><?php printf( __( '&ldquo;%s&rdquo;', 'download-monitor' ), $dlm_download->get_the_title() ); ?>
		<small> &ndash; <?php $dlm_download->the_filesize(); ?></small>
	</a></p>