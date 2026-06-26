<?php
/**
 * Theme footer.
 *
 * @package NeuroAprender
 */
?>
<script src="<?php echo esc_url( neuroaprender_asset_uri( 'assets/js/neuroaprender.js' ) ); ?>?v=<?php echo esc_attr( file_exists( neuroaprender_asset_path( 'assets/js/neuroaprender.js' ) ) ? (string) filemtime( neuroaprender_asset_path( 'assets/js/neuroaprender.js' ) ) : '1.0.3' ); ?>"></script>
<?php wp_footer(); ?>
</body>
</html>
