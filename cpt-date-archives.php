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

/*
Plugin Name: Custom Post Type Date Archives
Plugin URI: http://github.com/clubduece/cpt-date-archives
Description: Generates day, month, and year based archives for custom post types
Version: 0.1
Author: clubDuece
Author URI: http://github.com/clubduece
License: GPLv2 or later
*/
if ( ! defined( 'CPT_DATE_ARCHIVES' ) ) {
	define( 'CPT_DATE_ARCHIVES', true );
}

if ( CPT_DATE_ARCHIVES ) {
	require_once 'includes/class-cpt-date-archives.php';

	$CPT_Date_Archives = new CPT_Date_Archives;
}
