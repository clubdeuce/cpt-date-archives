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

		add_action( 'init', array( $this, 'custom_rewrite_rules' ) );
		add_action( 'init', array( $this, 'settings_page' ) );

	}

	/**
	 * Add rewrite rules for supported custom post types to create day, month, and year archives
	 */
	public function custom_rewrite_rules() {

		$settings_page = CPT_Date_Archive_Settings::init();
		$post_types    = $settings_page->get_post_type_objects();

		foreach( $post_types as $post_type ) {
			//Day archive
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/([0-9]{2})/feed/(feed|rdf|rss|rss2|atom)/?$", 'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]$matches[3]&feed=$matches[4]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/([0-9]{2})/(feed|rdf|rss|rss2|atom)/?$",      'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]$matches[3]&feed=$matches[4]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/([0-9]{2})/page/?([0-9]{1,})/?$",             'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]$matches[3]&paged=$matches[4]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/([0-9]{1,2})/?$",                             'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]$matches[3]', 'top' );
			//Monthly archive
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/feed/(feed|rdf|rss|rss2|atom)/?$", 'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]&feed=$matches[3]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/(feed|rdf|rss|rss2|atom)/?$",      'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]&feed=$matches[3]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/page/?([0-9]{1,})/?$",             'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]&paged=$matches[3]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/([0-9]{2})/?$",                               'index.php?post_type=' . $post_type->name . '&m=$matches[1]$matches[2]', 'top' );
			//Yearly archive
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$", 'index.php?post_type=' . $post_type->name . '&m=$matches[1]&feed=$matches[2]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$",      'index.php?post_type=' . $post_type->name . '&m=$matches[1]&feed=$matches[2]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/page/?([0-9]{1,})/?$",             'index.php?post_type=' . $post_type->name . '&m=$matches[1]&paged=$matches[2]','top');
			add_rewrite_rule( "{$post_type->rewrite['slug']}/([0-9]{4})/?$",                               'index.php?post_type=' . $post_type->name . '&m=$matches[1]', 'top' );
		}

	}

	public function settings_page() {

		if ( is_admin() ) {
			$settings_page = CPT_Date_Archive_Settings::init();
		}

	}

}
