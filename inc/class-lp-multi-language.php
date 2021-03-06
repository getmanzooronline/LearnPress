<?php

// Prevent loading directly
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'LP_Multi_Language' ) ) {
	/**
	 * Class LP_Multi_Language
	 *
	 * @author  ThimPress
	 * @package LearnPress/Clases
	 * @version 1.0
	 */
	class LP_Multi_Language {
		public static function init() {
			self::load_textdomain();

			$plugin = 'learnpress/learnpress.php';
			add_filter( "plugin_action_links_$plugin", array( __CLASS__, 'plugin_links' ) );
		}

		/**
		 * Load plugin translation
		 *
		 * @return void
		 */
		public static function load_textdomain() {
			$plugin_folder = basename( LP_PLUGIN_PATH );
			$text_domain   = 'learnpress';
			$locale        = apply_filters( 'plugin_locale', get_locale(), $text_domain );

			if ( is_admin() ) {
				load_textdomain( $text_domain, WP_LANG_DIR . '/' . $plugin_folder . "/{$text_domain}-admin-{$locale}.mo" );
				load_textdomain( $text_domain, WP_LANG_DIR . '/' . $plugin_folder . "/learnpress-admin-{$locale}.mo" );
			}
			load_textdomain( $text_domain, WP_LANG_DIR . '/' . $plugin_folder . "/learnpress-{$locale}.mo" );
			load_plugin_textdomain( $text_domain, false, plugin_basename( LP_PLUGIN_PATH ) . "/languages" );
		}

		/**
		 * Add links to Documentation and Extensions in plugin's list of action links
		 *
		 * @since 4.3.11
		 *
		 * @param array $links Array of action links
		 *
		 * @return array
		 */
		public static function plugin_links( $links ) {
			$links[] = '<a href="https://github.com/LearnPress/LearnPress/wiki">' . __( 'Documentation', 'learnpress' ) . '</a>';
			$links[] = '<a href="' . get_admin_url() . '/admin.php?page=learn_press_add_ons' . '">' . __( 'Add-ons', 'learnpress' ) . '</a>';

			return $links;
		}
	}
}
LP_Multi_Language::init();
