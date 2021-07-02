<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Class KBE_Plugins_Screen_Updates
 *
 */
class KBE_Plugins_Screen_Updates {

	/**
	 * The upgrade notice shown inline
	 *
	 * @access protected
	 * @var    string
	 *
	 */
	protected $upgrade_notice = '';


	/**
	 * Constructor
	 *
	 */
	public function __construct() {

		add_action( 'in_plugin_update_message-wp-knowledgebase/wp-knowledgebase.php', array( $this, 'in_plugin_update_message' ), 10, 2 );

	}


	/**
	 * Show plugin changes on the plugins screen. Code adapted from W3 Total Cache.
	 *
	 * @param array    $args Unused parameter.
	 * @param stdClass $response Plugin update response.
	 *
	 */
	public function in_plugin_update_message( $args, $response ) {

		$this->new_version    = $response->new_version;
		$this->upgrade_notice = $this->get_upgrade_notice( $response->new_version );

		$current_version_parts = explode( '.', KBE_PLUGIN_VERSION );
		$new_version_parts     = explode( '.', $this->new_version );

		// If user has already moved to the minor version, we don't need to flag up anything.
		if ( version_compare( $current_version_parts[0] . '.' . $current_version_parts[1], $new_version_parts[0] . '.' . $new_version_parts[1], '=' ) ) {
			return;
		}

		echo apply_filters( 'kbe_in_plugin_update_message', $this->upgrade_notice ? '</p>' . wp_kses_post( $this->upgrade_notice ) . '<p class="dummy">' : '' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

		echo '<style>';
			echo "
				#wp-knowledgebase-update .updating-message .kbe_plugin_upgrade_notice { display: none; }
				#wp-knowledgebase-update .dummy { display: none; }
				#wp-knowledgebase-update .kbe_plugin_upgrade_notice { font-weight: normal; background: #FFF8E5 !important; border-left: 4px solid #FFB900; border-top: 1px solid #FFB900; padding: 9px 0 9px 12px !important; margin: 0 -12px 0 -16px !important; }
				#wp-knowledgebase-update .kbe_plugin_upgrade_notice:before { content: '\\f348'; display: inline-block; font: 400 18px/1 dashicons; speak: none; margin: 0 8px 0 -2px; vertical-align: top; }
			";
		echo '</style>';

	}


	/**
	 * Get the upgrade notice from WordPress.org
	 *
	 * @param  string $version WP Knowledgebase new version.
	 *
	 * @return string
	 *
	 */
	protected function get_upgrade_notice( $version ) {

		$transient_name = 'kbe_upgrade_notice_' . $version;
		$upgrade_notice = get_transient( $transient_name );

		if ( false === $upgrade_notice ) {

			$response = wp_safe_remote_get( 'https://plugins.svn.wordpress.org/wp-knowledgebase/trunk/readme.txt' );

			if ( ! is_wp_error( $response ) && ! empty( $response['body'] ) ) {
				$upgrade_notice = $this->parse_update_notice( $response['body'], $version );
				set_transient( $transient_name, $upgrade_notice, DAY_IN_SECONDS );
			}

		}

		return $upgrade_notice;

	}


	/**
	 * Parse update notice from readme file
	 *
	 * @param  string $content WP Knowledgebase readme file content.
	 * @param  string $new_version WP Knowledgebase new version.
	 *
	 * @return string
	 *
	 */
	private function parse_update_notice( $content, $new_version ) {

		$version_parts     = explode( '.', $new_version );
		$check_for_notices = array(
			$version_parts[0] . '.0', // Major.
			$version_parts[0] . '.0.0', // Major.
			$version_parts[0] . '.' . $version_parts[1] . '.0', // Major.
			$version_parts[0] . '.' . $version_parts[1], // Minor.
			$version_parts[0] . '.' . $version_parts[1] . '.' . $version_parts[2], // Patch.
		);
		$notice_regexp     = '~==\s*Upgrade Notice\s*==\s*=\s*(.*)\s*=(.*)(=\s*' . preg_quote( $new_version ) . '\s*=|$)~Uis';
		$upgrade_notice    = '';

		foreach ( $check_for_notices as $check_version ) {

			if ( version_compare( KBE_PLUGIN_VERSION, $check_version, '>' ) ) {
				continue;
			}

			$matches = null;
			if ( preg_match( $notice_regexp, $content, $matches ) ) {
				$notices = (array) preg_split( '~[\r\n]+~', trim( $matches[2] ) );

				if ( version_compare( trim( $matches[1] ), $check_version, '=' ) ) {
					$upgrade_notice .= '<p class="kbe_plugin_upgrade_notice">';

					foreach ( $notices as $index => $line ) {
						$upgrade_notice .= preg_replace( '~\[([^\]]*)\]\(([^\)]*)\)~', '<a href="${2}">${1}</a>', $line );
					}

					$upgrade_notice .= '</p>';
				}
				break;
			}
		}
		return wp_kses_post( $upgrade_notice );
	}

}

new KBE_Plugins_Screen_Updates();