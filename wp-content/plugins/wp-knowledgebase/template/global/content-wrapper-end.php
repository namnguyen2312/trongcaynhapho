<?php
/**
 * Content wrapper end
 *
 * This template can be overridden by copying it to yourtheme/wp_knowledgebase/global/content-wrapper-end.php
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$template = get_option( 'template' );

switch ( $template ) {
	case 'twentyten':
		echo '</div></div>';
		break;
	case 'twentyeleven':
		echo '</div>';
		get_sidebar( 'kbe_cat_widget' );
		echo '</div>';
		break;
	case 'twentytwelve':
		echo '</div></div>';
		break;
	case 'twentythirteen':
		echo '</div></div>';
		break;
	case 'twentyfourteen':
		echo '</div></div></div>';
		get_sidebar( 'kbe_cat_widget' );
		break;
	case 'twentyfifteen':
		echo '</div></div>';
		break;
	case 'twentysixteen':
		echo '</main></div>';
		break;
	default:
		echo '</main></div>';
		break;
}
