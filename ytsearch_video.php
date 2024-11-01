<?php
/*
Plugin Name: YTSEARCH VIDEO
Description: Search Youtube Video
Author: YTSearch
Version: 0.10
 */

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

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

if (is_admin())
	require_once dirname( __FILE__ ) . '/admin.php';

function ytsv_sc_handler($atts){
	$apikey = get_option('ytsvapikey');
	if ($apikey && isset($atts['term'])) {
		return "<div id='relvideos'></div><script>jQuery.ajax({url: 'https://www.googleapis.com/youtube/v3/search',
			jsonp: 'callback',
			dataType: 'jsonp',
			data: { q: '".$atts['term']."', part: 'snippet', key: '$apikey' },
			success: function( response ) {
				xx = response;
				jQuery.each(response.items, function(index, item) {
					jQuery('#relvideos').append('<a href=\"http://www.youtube.com/watch?v=' + item.id.videoId + '\"><img src=\"' + item.snippet.thumbnails.default.url + '\" /></a>');
				});
			}
		});</script>";
	} else {
		return "";
	}
}
add_shortcode('relatedvideo', 'ytsv_sc_handler');
