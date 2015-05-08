<?php
/**
 * The settings page class
 *
 * @license GPLv2 or later
 * @since   0.2
 */
class CPT_Date_Archive_Settings {

	/**
	 * A singleton instance
	 *
	 * @var    CPT_Date_Archive_Settings
	 * @static
	 * @access private
	 * @since  0.2
	 */
	private static $instance = null;

	/**
	 * The page object
	 *
	 * @var    stdClass
	 * @access private
	 * @since  0.2
	 */
	private $page;

	/**
	 * The class constructor
	 *
	 * @access public
	 * @since  0.2
	 */
	protected function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'update_option_cpt_date_archive_post_types', array( $this, 'update_option' ) );

		$this->page     = new stdClass;
		$this->page->id = 'cpt_date_archives';
	}

	/**
	 * Add the options page, options groups, sections, and fields
	 *
	 * Hooked to WP admin_menu action
	 *
	 * @access public
	 * @since  0.2
	 */
	public function admin_menu() {

		register_setting( $this->page->id, 'cpt_date_archive_post_types', array( $this, 'sanitize_input' ) );

		add_options_page( __( 'CPT Date Archives Settings', 'cpt_date_archives' ), __( 'CPT Date Archives', 'cpt_date_archives' ),  'manage_options', $this->page->id, array( $this, 'render' ) );
		add_settings_section( 'general', __( 'General', 'cpt_date_archives' ), null, $this->page->id );
		add_settings_field( 'post-types', __( 'Post Types', 'cpt_date_archives' ), array( $this, 'render_field_post_types' ), $this->page->id, 'general' );

	}

	/**
	 * Render the settings page
	 *
	 * @access public
	 * @since  0.2
	 */
	public function render() {

		$page = $this->page;

		include dirname( __DIR__ ) . '/templates/settings-page.php';

	}

	/**
	 * Render the post types field
	 *
	 * @access public
	 * @since  0.2
	 */
	public function render_field_post_types() {

		$post_types = get_post_types( array( 'public' => 'true', '_builtin' => false ), 'objects' );
		$selected   = $this->get_post_type_objects();

		esc_html_e( __( 'Inputs are disabled for post types that do not support archives.', 'cpt_date_archive_post_types' ) );

		foreach ( $post_types as $post_type ) {
			if ( $this->has_date_archive( $post_type ) ) {
				$post_type->checked = true;
			}

			include dirname( __DIR__ ) . '/templates/post-types-field.php';
		}

	}

	/**
	 * Sanitize the post types field input
	 *
	 * @param  array $input
	 * @access public
	 * @since  0.2
	 */
	public function sanitize_input( $input ) {

		if ( ! empty( $input ) ) {
			foreach ( $input as $key => $post_type ) {
				$input[ $key ] = sanitize_text_field( $post_type );
			}
		}

		return $input;

	}

	/**
	 * Get the post type objects that are set to support date archives
	 *
	 * @return stdClass[]
	 * @access public
	 * @since  0.2
	 */
	public function get_post_type_objects() {

		$post_types = $this->get_post_types();

		foreach ( $post_types as $key => $post_type ) {
			$post_types[ $key ] = get_post_type_object( $post_type );
		}

		return $post_types;

	}

	/**
	 * Get the post post type names that are set to support date archives
	 *
	 * @return string[]
	 * @access public
	 * @since 0.2
	 */
	public function get_post_types() {

		return get_option( 'cpt_date_archive_post_types', array() );

	}

	/**
	 * Does a particular post type have a date archive?
	 *
	 * @return bool
	 * @access public
	 * @since  0.2
	 */
	public function has_date_archive( $post_type ) {

		$value = false;

		if ( ! is_object( $post_type ) ) {
			$post_type = get_post_type_object( $post_type );
		}

		if ( in_array( $post_type->name, $this->get_post_types() ) ) {
			$value = true;
		}

		return $value;

	}

	/**
	 * Delete the rewrite rules when updating the plugin settings
	 *
	 * Hooked to WP 'updated_option_cpt_date_archive_post_types' action.
	 *
	 * @access public
	 * @since  0.2
	 */
	public function update_option() {

			delete_option( 'rewrite_rules' );

	}

	/**
	 * Prevent cloning of the singleton instance
	 *
	 * @access private
	 * @since  0.2
	 */
	private function __clone() {}

	/**
	 * Prevent unserializing of the singleton instance
	 *
	 * @access private
	 * @since  0.2
	 */
	private function __wakeup () {}

	/**
	 * Singleton model
	 *
	 * @access public
	 * @since  0.2
	 */
	public static function init() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new CPT_Date_Archive_Settings;
		}

		return self::$instance;

	}

}
