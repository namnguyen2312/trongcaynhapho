<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Class KBE_Migration_1_3_0
 *
 * Migration that runs when updating to version 1.3.0
 *
 */
class KBE_Migration_1_3_0 extends KBE_Abstract_Migration {

	/**
	 * Constructor.
	 *
	 */
	public function __construct() {

		// Force notice type to be none, even though we'll still forcely show the admin notice for existing users
		$this->id          = 'kbe-install-1-3-0';
		$this->notice_type = 'none';

		parent::__construct();

		// Force notice to show for existing users, new users should not see this
		if( $this->get_migration_status() == 'migrated' ) {
			add_action( 'admin_notices', array( $this, 'admin_notice' ) );
			add_action( 'admin_init', array( $this, 'check_for_migrate_actions' ), 50 );
		}

	}


	/**
	 * Mark as ran.
	 *
	 * Update the migration to be marked as ran.
	 *
	 */
	public function mark_as_ran() {

		// Mark as "skipped" for new users
		if( $this->is_fresh_install() ) {

			KBE_Migration_Manager::update( $this->id, 'skipped' );

		// Mark as "migrated" if existing user
		} else {

			KBE_Migration_Manager::update( $this->id );

		}

	}


	/**
	 * Checks whether the current instance is a fresh install
	 *
	 * @return bool
	 *
	 */
	public function is_fresh_install() {

		// Make sure the migration notice is shown only for existing users
		$plugin_prev_version = get_option( 'kbe_previous_version', '' );
		$wp_posts_count 	 = wp_count_posts( KBE_POST_TYPE );

		if( empty( $plugin_prev_version ) && empty( $wp_posts_count->publish ) )
			return true;

		return false;

	}


	/**
	 * Return the status of the current migration
	 *
	 * @return false|string
	 *
	 */
	protected function get_migration_status() {

		$migrations = KBE_Migration_Manager::get_ran_migrations();

		if( ! empty( $migrations[$this->id]['status'] ) )
			return $migrations[$this->id]['status'];

		return false;

	}


	/**
	 * Actually run the migration.
	 *
	 */
	public function migrate() {

		if( $this->is_fresh_install() )
			return;

		// Set the template system to the legacy one
		update_option( 'kbe_enable_legacy_templates', 1 );

		// Get sidebar position for home and inner pages, from old template system
		$sidebar_home  = get_option( 'kbe_sidebar_home' );
		$sidebar_inner = get_option( 'kbe_sidebar_inner' );

		// Set templates for the new template system
		update_option( 'kbe_main_page_template', ( empty( $sidebar_home ) ? 'wide' : ( $sidebar_home == 1 ? 'sidebar-left' : 'sidebar-right' ) ) );
		update_option( 'kbe_category_page_template', ( empty( $sidebar_inner ) ? 'wide' : ( $sidebar_inner == 1 ? 'sidebar-left' : 'sidebar-right' ) ) );
		update_option( 'kbe_single_article_template', ( empty( $sidebar_inner ) ? 'wide' : ( $sidebar_inner == 1 ? 'sidebar-left' : 'sidebar-right' ) ) );

		// Migrate taxonomy KB category "knowledgebase_category" slug
		add_option( 'kbe_category_slug', 'knowledgebase_category' );

	}


	/**
	 * Notice.
	 *
	 * The notice that is being displayed to inform the user.
	 *
	 */
	public function get_notice() {

		$href = wp_nonce_url( add_query_arg( array( 'action' => 'kbe-knowledgebase-migrate-dismiss', 'migration' => $this->id ) ), 'migrate_kbe' );

		?>

			<div class="notice notice-warning">
				<p><h3 style="margin-top: 0; margin-bottom: 5px;"><?php echo __( 'WP Knowledgebase Important Notice', 'wp-knowledgebase' ); ?></h3></p>
				<p><?php echo __( 'Starting with version 1.3.0, WP Knowledgebase comes with a new template system, simpler, extendable and easier to adapt to any theme.', 'wp-knowledgebase' ); ?></p>
				<p><?php echo __( 'By default, the old (or legacy) template system will continue to run on your website. However, we recommend switching to the new one as soon as possible.', 'wp-knowledgebase' ); ?> <a href="https://usewpknowledgebase.com/blog/new-template-system/#how-to-switch" target="_blank"><?php echo __( 'Click here to learn how.', 'wp-knowledgebase' ); ?></a></p>
				<p><?php echo __( 'Both template systems will be supported for the time being, however, the legacy system will eventually be discontinued.', 'wp-knowledgebase' ); ?></p>
				<p><?php echo sprintf( __( 'For all the details about the new template system, %splease read this article%s.', 'wp-knowledgebase' ), '<a href="https://usewpknowledgebase.com/blog/new-template-system/" target="_blank">', '</a>' ); ?> <?php echo sprintf( __( 'If you have any questions, %scontact us here%s', 'wp-knowledgebase' ), '<a href="https://usewpknowledgebase.com/contact/" target="_blank">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( $href ); ?>" class="button button-primary"><?php echo __( 'Thank you, I understand', 'wp-knowledgebase' ); ?></a></p>
			</div>

		<?php

	}

}