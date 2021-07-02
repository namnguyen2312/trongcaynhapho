<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


Class KBE_Submenu_Page_Article_Feedback extends KBE_Submenu_Page {

	/**
	 * Helper init method that runs on parent __construct
	 *
	 */
	protected function init() {

	}


	/**
	 * Callback for the HTML output for the Settings page
	 *
	 */
	public function output() {

		?>

			<div class="wrap kbe-wrap kbe-wrap-promo-article-feedback">

				<div id="kbe-promo-content-wrapper">

					<a href="https://usewpknowledgebase.com/" target="_blank">
						<img src="<?php echo KBE_PLUGIN_DIR_URL; ?>/assets/images/kbe-logo.png" />
					</a>

					<h1>Get feedback on your articles</h1>
					<h2>Add a feedback widget to each article and learn what your users need</h2>

					<div class="kbe-card">

						<div class="kbe-card-inner">

							<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/promo-article-feedback.png" />

							<ul>
								<li><span class="dashicons dashicons-yes"></span>Add rating buttons on your knowledge base articles</li>
								<li><span class="dashicons dashicons-yes"></span>Add a feedback form after users rate your article</li>
								<li><span class="dashicons dashicons-yes"></span>Customize the messages shown to users</li>
							</ul>

						</div>

						<div class="kbe-card-footer">
							<a href="http://usewpknowledgebase.com/?utm_source=page-article-feedback&amp;utm_medium=plugin-admin&amp;utm_campaign=KBEFree" class="kbe-button-primary" target="_blank">Upgrade to WP Knowledgebase PRO Now</a>
						</div>

					</div>

				</div>

		    </div>

		<?php

	}

}