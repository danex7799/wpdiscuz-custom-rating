<?php 
/** 
 * @package wpdiscuz-custom-rating
 */
/**
 * Plugin Name: wpDiscuz Custom Rating
 * Description: Modified wpDiscuz rating system 
 * Plugin URI: https://jillnystul.co/
 * Author: Daniar Ayzetulov
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: wpdiscuz-custom-rating
 */

/*
    Copyright (C) 2019  Daniar  danex7779@gmail.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
defined('ABSPATH') or die('Error');

function modify_wpdiscuz_rating($output, $tag)
{
	if ( 'wpdrating' !== $tag ) {
		return $output;
	}
	/*
	 * disassenble shortcode to rating and № of votes
	 * form a replace string
	 * assemble with needed text and added link to the comments section
	 * return wrapped in div
	 */
	preg_match('/\((\d) \/ (\d)\)/', $output, $matches);
	$rating = $matches[1];
	$votes = $matches[2];
	$replaceString = "$rating/5 stars · $votes votes"; // Change this to modify the text above the stars
	$result = preg_replace('/Rate This Post: \(\d \/ \d\)/', $replaceString, $output);
	$result = str_replace('<div class="wpdiscuz-stars-wrapper">', '<a href="#wc-comment-header"><div class="wpdiscuz-stars-wrapper">', $result);
	$result = str_replace('</div></div></div>', '</div></div></div></a>', $result);
	return '<div class="wpd_custom_rating">' . $result . '</div>';
}

add_filter( 'do_shortcode_tag', 'modify_wpdiscuz_rating', 10, 2);
