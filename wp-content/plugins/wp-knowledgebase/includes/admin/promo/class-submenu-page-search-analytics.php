<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


Class KBE_Submenu_Page_Search_Analytics extends KBE_Submenu_Page {

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

			<div class="wrap kbe-wrap kbe-wrap-promo-search-analytics">

				<div id="kbe-promo-content-wrapper">

					<a href="https://usewpknowledgebase.com/" target="_blank">
						<img src="<?php echo KBE_PLUGIN_DIR_URL; ?>/assets/images/kbe-logo.png" />
					</a>

					<h1>Understand what your users search for</h1>
					<h2>Inspect each individual knowledge base live search query and<br /> view your users' most popular searches</h2>

					<div class="kbe-card">

						<div class="kbe-card-inner">

							<img src="<?php echo esc_attr( KBE_PLUGIN_DIR_URL ); ?>assets/images/promo-search-analytics.png" />

							<ul>
								<li><span class="dashicons dashicons-yes"></span>Inspect each individual search query</li>
								<li><span class="dashicons dashicons-yes"></span>View the most popular searches</li>
								<li><span class="dashicons dashicons-yes"></span>Analyze searches that haven't returned any results</li>
							</ul>

						</div>

						<div class="kbe-card-footer">
							<a href="http://usewpknowledgebase.com/?utm_source=page-search-analytics&amp;utm_medium=plugin-admin&amp;utm_campaign=KBEFree" class="kbe-button-primary" target="_blank">Upgrade to WP Knowledgebase PRO Now</a>
						</div>

					</div>

				</div>

		    </div>

		<?php

	}

}