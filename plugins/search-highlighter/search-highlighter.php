<?php
/*
Plugin Name: Search Highlighter
Description: Highlight searched words when you
search
Version: 1.0
Author: PACIFIC MALL DEVELOPMENT
Author URI: https://pacificmall.local
*/

class SearchHighlighter {
	public function __construct() {
		add_filter( 'the_title', array( $this, 'highlight_keywords' ) );
		add_filter( 'get_the_excerpt', array( $this,'highlight_keywords' ) );
	}
	public function highlight_keywords( $text ) {
		if ( is_search() ) {
			$keys = explode( ' ', get_search_query() );
			foreach ( $keys as $key ) {
				$text = str_replace( $key, '<span style="background:#ffff00">'.$key.'</span>', $text );
			}
		}
		return $text;
	}
}
$SearchHighlighter = new SearchHighlighter();