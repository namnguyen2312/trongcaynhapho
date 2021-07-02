<?php
/**
 * Article title
 *
 * This template can be overridden by copying it to yourtheme/wp_knowledgebase/article/title.php
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<header class="entry-header post-header">
	<h1 class="entry-title">
		<?php the_title(); ?>
	</h1>
</header>