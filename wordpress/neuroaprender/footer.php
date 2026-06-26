<?php
/**
 * Theme footer.
 *
 * @package NeuroAprender
 */
?>
<?php if ( function_exists( 'neuroaprender_ai_enabled' ) && neuroaprender_ai_enabled() ) : ?>
	<script>
		window.NeuroAprenderChat = <?php echo wp_json_encode(
			array(
				'endpoint'     => esc_url_raw( rest_url( 'neuroaprender/v1/chat' ) ),
				'whatsappUrl'  => neuroaprender_whatsapp_url(),
				'errorMessage' => neuroaprender_ai_public_error_message(),
			)
		); ?>;
	</script>
<?php endif; ?>
<script src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/js/neuroaprender.js' ) ); ?>?v=<?php echo esc_attr( file_exists( neuroaprender_asset_path( 'assets/js/neuroaprender.js' ) ) ? (string) filemtime( neuroaprender_asset_path( 'assets/js/neuroaprender.js' ) ) : '1.0.3' ); ?>"></script>
<?php wp_footer(); ?>
</body>
</html>
