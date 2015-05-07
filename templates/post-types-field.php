<?php
/**
 * The post types field template
 *
 * @var object $post_type
 */
//print_r($post_type);
?>
<p>
	<input type="checkbox" name="cpt_date_archive_post_types[]" value="<?php esc_attr_e( $post_type->name ); ?>" <?php checked( $post_type->checked, true ); ?>><?php esc_html_e( $post_type->labels->name ); ?>
</p>
