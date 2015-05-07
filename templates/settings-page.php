<?php

/**
 * The settings page template
 *
 * @var stdClass $page
 */
?>
<h1>CPT Date Archives Settings</h1>

<form action="options.php" method="post">
	<?php settings_fields( $page->id ); ?>
	<?php do_settings_sections( $page->id ); ?>
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( __( 'Save Changes', 'cpt_date_archives' ) ); ?>" />
</form>
