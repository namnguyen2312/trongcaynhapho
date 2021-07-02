<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$finished_lessons = get_option( 'kbe_getting_started_finished_lessons', array() );

?>

<div class="wrap kbe-wrap kbe-wrap-getting-started">

	<div id="kbe-getting-started-wrapper">

		<a href="https://usewpknowledgebase.com/" target="_blank">
			<img src="<?php echo KBE_PLUGIN_DIR_URL; ?>/assets/images/kbe-logo.png" />
		</a>

		<h1>Welcome to WP Knowledgebase</h1>
		<h2>Thank you for choosing WP Knowledgebase. This 5 short lessons course is here to help you set up everything as you want it.</h2>

		<!-- Lesson 1 -->
		<div class="kbe-card kbe-card-getting-started <?php echo ( in_array( 'main_page', $finished_lessons ) ? 'kbe-finished' : '' ); ?>" data-lesson="main_page">

			<div class="kbe-card-header">

				<div class="kbe-card-getting-started-number">
					<span>1</span>
					<span class="dashicons dashicons-yes"></span>
				</div>

				<div class="kbe-card-getting-started-title">
					<span>Lesson 1</span>
					<h3>Creating your knowledge base’s main page <span class="dashicons dashicons-arrow-right-alt2"></span></h3>
				</div>

			</div>

			<div class="kbe-card-inner">
				<h4>Automatically creating the knowledge base's main page</h4>
				<p>After you activate the plugin for the very first time, you’ll be welcomed with a notification asking if you’d like the plugin to create the knowledge base’s main page. To do it:</p>
				<ol class="kbe-step-by-step">
					<li>Navigate to your WordPress admin dashboard. <a href="<?php echo esc_url( admin_url( 'index.php' ) ); ?>" target="_blank">Click here to go there</a>.</li>
					<li>At the top of the page look for the following admin notice: <img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/doc-kb-main-page-admin-notice.png" alt="WP Knowledgebase admin notification once you activate plugin"></li>
					<li>Click the <strong>Create page</strong> button. This will create a new page for you, named <strong>Knowledgebase</strong>.</li>
				</ol>
				<h4>Manually creating the knowledge base's main page</h4>
				<p>If you wish to have full control over the creation of this page and choose to manually add it, please follow these steps:</p>
				<ol class="kbe-step-by-step">
					<li>Navigate to <strong>Pages &gt; Add New</strong>.</li>
					<li>Here, set the page’s title and slug.
						<div class="kbe-helper-notice">
							<p>We suggest going with something simple, for example:</p>
							<ul>
								<li><strong>Knowledgebase</strong> for the title and <strong>knowledgebase</strong> for the slug, or</li>
								<li><strong>Knowledge base</strong> for the title and <strong>knowledge-base</strong> for the slug, or</li>
								<li><strong>Documentation</strong> for the title and <strong>documentation</strong> for the slug, or</li>
								<li><strong>KB</strong> for the title and <strong>kb</strong> for the slug, or</li>
								<li><strong>Docs</strong> for the title and <strong>docs</strong> for the slug</li>
							</ul>
						</div>
					</li>
					<li>Add the <strong>[kbe_knowledgebase]</strong> as the content of the page, either writing it directly (in the Classic Editor) or adding a shortcode block for it (in the Gutenberg Editor).<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/doc-kb-main-page.png" alt="Knowledge base main page setup in WordPress admin area"></li>
					<li>Navigate to <strong>Knowledgebase &gt; Settings &gt; General Settings (section)</strong> and select this newly created page in the <strong>Knowledgebase Main Page</strong> field.<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/doc-setting-main-page.png" alt="Selecting the main knowledge base page in WP Knowledgebase settings"></li>
				</ol>
				<p><strong>Please note:</strong> to have the plugin working properly, this page is mandatory.</p>
			</div>

			<div class="kbe-card-footer">
				<p>If you finished reading and implementing this lesson, click the button below.</p>
				<a href="#" class="kbe-button-primary <?php echo ( in_array( 'main_page', $finished_lessons ) ? 'kbe-disabled' : '' ); ?>"><?php echo ( in_array( 'main_page', $finished_lessons ) ? 'Completed' : 'Mark lesson as complete' ); ?></a>
				<div class="spinner"></div>
			</div>

		</div>
		<!-- / Lesson 1 -->

		<!-- Lesson 2 -->
		<div class="kbe-card kbe-card-getting-started <?php echo ( in_array( 'slugs', $finished_lessons ) ? 'kbe-finished' : '' ); ?>" data-lesson="slugs">

			<div class="kbe-card-header">

				<div class="kbe-card-getting-started-number">
					<span>2</span>
					<span class="dashicons dashicons-yes"></span>
				</div>

				<div class="kbe-card-getting-started-title">
					<span>Lesson 2</span>
					<h3>Setting your knowledge base’s slugs <span class="dashicons dashicons-arrow-right-alt2"></span></h3>
				</div>

			</div>

			<div class="kbe-card-inner">
				<p>WP Knowldgebase uses WordPress’ <strong>custom post types</strong> and <strong>taxonomies</strong> to manage content.</p>
				<p>If you’re not familiar with these terms, the important thing to know is that the plugin uses the same mechanisms WordPress uses for posts and pages.</p>
				<p>These slugs determine the way your knowledge base links are going to work and look. To customize these:</p>
				<ol class="kbe-step-by-step">
					<li>Navigate to <strong>Knowledgebase &gt; Settings &gt; General Settings (tab)</strong>.</li>
					<li>Set the <strong>Knowledgebase Slug</strong> option to something like <strong>knowledgebase</strong> or <strong>documentation</strong>.
						<div class="kbe-helper-notice">
							<p>We recommend you to have the main page’s slug (the one set in Lesson 1) match the value set here.</p>
							<p>For example, if your knowledge base’s main page title is <strong>Documentation</strong>, with the slug <strong>documentation</strong>, the value for the <strong>Knowldegase Slug</strong> is recommended to be <strong>documentation</strong>.</p>
						</div>
						<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/doc-setting-slug.png" alt="Setting the custom post type slug in WP Knowledgebase admin area" />
					</li>
					<li>Set the <strong>Knowledgebase Category Slug</strong> to something like <strong><strong>knowledgebase</strong>-category</strong> or <strong>documentation-category</strong>.
						<div class="kbe-helper-notice">
							<p>This will turn your knowledge base’s category URL into something like this: <span class="kbe-code">https://yourwebsite.com/<strong><strong>knowledgebase</strong>-category</strong>/slug-of-category</span></p>
							<p>However, if you’d like your URL to be more sectioned, you can set the category slug to something similar to <strong>documentation/category</strong>, matching the string before the slash to the knowledge base’s slug (the one set above).</p>
							<p>This will turn you category URL into something like this: <span class="kbe-code">htts://yourwebsite.com/<strong>documentation/category</strong>/slug-of-category</span></p>
						</div>
						<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/doc-setting-category-slug.png" alt="Setting the category taxonomy slug in WP Knowledgebase admin area">
					</li>
				</ol>
			</div>

			<div class="kbe-card-footer">
				<p>If you finished reading and implementing this lesson, click the button below.</p>
				<a href="#" class="kbe-button-primary <?php echo ( in_array( 'slugs', $finished_lessons ) ? 'kbe-disabled' : '' ); ?>"><?php echo ( in_array( 'slugs', $finished_lessons ) ? 'Completed' : 'Mark lesson as complete' ); ?></a>
				<div class="spinner"></div>
			</div>

		</div>
		<!-- / Lesson 2 -->

		<!-- Lesson 3 -->
		<div class="kbe-card kbe-card-getting-started <?php echo ( in_array( 'new_category', $finished_lessons ) ? 'kbe-finished' : '' ); ?>" data-lesson="new_category">

			<div class="kbe-card-header">

				<div class="kbe-card-getting-started-number">
					<span>3</span>
					<span class="dashicons dashicons-yes"></span>
				</div>

				<div class="kbe-card-getting-started-title">
					<span>Lesson 3</span>
					<h3>Adding a new category <span class="dashicons dashicons-arrow-right-alt2"></span></h3>
				</div>

			</div>

			<div class="kbe-card-inner">
				<p>Now that you have an overview of how categories and article are structured, let’s add a new category.</p>
				<ol class="kbe-step-by-step">
					<li>Firstly, navigate to <strong>Knowledgebase &gt; Categories</strong>.</li>
					<li>Here, from the side form, type in a name, a slug and a description for your new category. Optionally, if this is a child category, select the parent category.<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/doc-add-new-category.png" alt="Adding a new category from WordPress admin area in WP Knowledgebase"></li>
					<li>Click the <strong>Add New Knowledgebase Category</strong> button to create the new category.</li>
				</ol>
			</div>

			<div class="kbe-card-footer">
				<p>If you finished reading and implementing this lesson, click the button below.</p>
				<a href="#" class="kbe-button-primary <?php echo ( in_array( 'new_category', $finished_lessons ) ? 'kbe-disabled' : '' ); ?>"><?php echo ( in_array( 'new_category', $finished_lessons ) ? 'Completed' : 'Mark lesson as complete' ); ?></a>
				<div class="spinner"></div>
			</div>

		</div>
		<!-- / Lesson 3 -->

		<!-- Lesson 4 -->
		<div class="kbe-card kbe-card-getting-started <?php echo ( in_array( 'new_article', $finished_lessons ) ? 'kbe-finished' : '' ); ?>" data-lesson="new_article">

			<div class="kbe-card-header">

				<div class="kbe-card-getting-started-number">
					<span>4</span>
					<span class="dashicons dashicons-yes"></span>
				</div>

				<div class="kbe-card-getting-started-title">
					<span>Lesson 4</span>
					<h3>Adding a new article <span class="dashicons dashicons-arrow-right-alt2"></span></h3>
				</div>

			</div>

			<div class="kbe-card-inner">
				<p>With at least one category added, you can go ahead and create a knowledge base article. Here’s how you can do it:</p>
				<ol class="kbe-step-by-step">
					<li>Navigate to <strong>Knowledgebase &gt; Articles &gt; New Article</strong>.</li>
					<li>Here, set a title and add the article’s content.</li>
					<li>Before saving the article, make sure to add the article to at least one category. <strong>Please note</strong> that articles without a category will not show up on the user’s end.</li>
				</ol>
			</div>

			<div class="kbe-card-footer">
				<p>If you finished reading and implementing this lesson, click the button below.</p>
				<a href="#" class="kbe-button-primary <?php echo ( in_array( 'new_article', $finished_lessons ) ? 'kbe-disabled' : '' ); ?>"><?php echo ( in_array( 'new_article', $finished_lessons ) ? 'Completed' : 'Mark lesson as complete' ); ?></a>
				<div class="spinner"></div>
			</div>

		</div>
		<!-- / Lesson 4 -->

		<!-- Lesson 5 -->
		<div class="kbe-card kbe-card-getting-started <?php echo ( in_array( 'troubleshoot', $finished_lessons ) ? 'kbe-finished' : '' ); ?>" data-lesson="troubleshoot">

			<div class="kbe-card-header">

				<div class="kbe-card-getting-started-number">
					<span>5</span>
					<span class="dashicons dashicons-yes"></span>
				</div>

				<div class="kbe-card-getting-started-title">
					<span>Lesson 5</span>
					<h3>Fixing the 404 error for categories and articles <span class="dashicons dashicons-arrow-right-alt2"></span></h3>
				</div>

			</div>

			<div class="kbe-card-inner">
				<p>With your first category and article published, let’s navigate to your main page and check if everything is working.</p>
				<p>On this page you should have the main category and the first article. Click on the article. In certain instances, instead of the article, a 404 page will load.</p>
				<p>To make sure this doesn't happen and the article is loaded properly, please try the following:</p>
				<ol class="kbe-step-by-step">
					<li>Navigate to <strong>Settings &gt; Permalinks</strong>.<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/doc-permalinks-sidebar-menu.png" alt="Permalink settings menu in WordPress admin dashboard"></li>
					<li>Here, <strong>without modifying anything</strong>, save the changes. This will rebuild the permalink information, leading to the knowledge base articles loading properly.</li>
				</ol>
				<p>If you’re still having any issues with the knowledge base articles or pages, <a href="https://usewpknowledgebase.com/contact/" data-type="page" data-id="13">please contact us here</a> and describe the issue as detailed as possible.</p>
			</div>

			<div class="kbe-card-footer">
				<p>If you finished reading and implementing this lesson, click the button below.</p>
				<a href="#" class="kbe-button-primary <?php echo ( in_array( 'troubleshoot', $finished_lessons ) ? 'kbe-disabled' : '' ); ?>"><?php echo ( in_array( 'troubleshoot', $finished_lessons ) ? 'Completed' : 'Mark lesson as complete' ); ?></a>
				<div class="spinner"></div>
			</div>

		</div>
		<!-- / Lesson 5 -->

		<br /><hr /><br /><br />

		<a href="<?php echo wp_nonce_url( add_query_arg( array( 'post_type' => KBE_POST_TYPE, 'kbe_action' => 'hide_page_getting_started' ), admin_url( 'edit.php' ) ), 'kbe_hide_page_getting_started', 'kbe_token' ); ?>">Hide the <strong>Getting Started</strong> page</a>

		<!-- Hidden fields -->
		<?php wp_nonce_field( 'kbe_getting_started', 'kbe_token', false ); ?>

	</div>

</div>