<?php
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class CPT_Date_Archives {

	public function __construct() {

		add_action( 'init', array( $this, 'custom_rewrite_rules' ), 999 );
		add_action( 'init', array( $this, 'settings_page' ) );

	}

	/**
	 * Add rewrite rules for public custom post types to create day, month, and year archives
	 */
	public function custom_rewrite_rules() {

		$post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
		$settings_page = CPT_Date_Archive_Settings::init();
		$post_types    = $settings_page->get_post_type_objects();

		foreach( $post_types as $post_type ) {
			if ( $post_type->has_archive ) {
				//Day archive
				add_rewrite_rule( "^{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{1,2}/[0-9]{1,2})", 'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]$matches[3]', 'top' );
				//Monthly archive
				add_rewrite_rule( "^{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{1,2})",            'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]', 'top' );
				//Yearly archive
				add_rewrite_rule( "^{$post_type->rewrite['slug']}/([0-9]{4})",                         'index.php?post_type=' . $post_type->name . '&m=$matches[1]', 'top' );
			}
		}

	}

	public function settings_page() {

		if ( is_admin() ) {
			$settings_page = CPT_Date_Archive_Settings::init();
		}

	}

}
