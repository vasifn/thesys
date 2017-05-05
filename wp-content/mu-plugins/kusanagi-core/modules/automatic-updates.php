<?php
/**
 * WordPress 自動アップデートモジュール
 */
class KUSANAGI_Automatic_Updates {

	private $option_key = 'kusanagi-auto-updates-settings';
	private $errors = array();
	private $some_enable = '';
	private $defaults  = array();
	private $keys = array();
	public  $settings = array();

	public function __construct() {

		$this->defaults = array(
			'translation' => 'enable',
			'plugin' => 'disable',
			'theme'  => 'disable',
			'core'   => 'minor',
		);
		$this->keys = array_keys( $this->defaults );

		$this->settings = wp_parse_args( get_option( $this->option_key, array() ), $this->defaults );

		$this->some_enable = false;

		foreach ( $this->settings as $type => $status ) {
			$this->add_autoupdate_filter( $type, $status );
			if ( !$this->some_enable && 'disable' != $status ) {
				$this->some_enable = true;
			}
		}

		add_action( 'admin_init'               , array( $this, 'add_tab' ) );
	}

	private function add_autoupdate_filter( $type, $status ) {

		if ( ! in_array( $status, $this->defaults ) ) {
			return;
		}

		if ( ! in_array( $type, $this->keys ) ) {
			return;
		}

		if ( 'disable' == $status ) {
			add_filter( 'auto_update_'.$type, '__return_false' );
		} elseif ( 'enable' == $status ) {
			if ( 'core' == $type ) {
				add_filter( 'allow_dev_auto_core_updates', '__return_false' );
				add_filter( 'allow_minor_auto_core_updates', '__return_true' );
				add_filter( 'allow_major_auto_core_updates', '__return_true' );
			} else {
				add_filter( 'auto_update_'.$type, '__return_true' );
			}
		} elseif ( 'minor' == $status ) {
			add_filter( 'allow_dev_auto_core_updates', '__return_false' );
			add_filter( 'allow_minor_auto_core_updates', '__return_true' );
			add_filter( 'allow_major_auto_core_updates', '__return_false' );
		}
	}

	public function add_tab() {
		global $WP_KUSANAGI;
		$WP_KUSANAGI->add_tab( 'automatic-updates', __( 'Automatic Updates', 'wp-kusanagi' ) );
	}

	public function save_options() {
		global $WP_KUSANAGI;

		$post_data = wp_unslash( $_POST );

		$this->some_enable = false;
		foreach ( $this->defaults as $key => $status ) {
			if ( isset($post_data[$key]) && in_array( $post_data[$key], $this->defaults ) ) {
				$status = $post_data[$key];
			}
			if ( !$this->some_enable && 'disable' != $status ) {
				$this->some_enable = true;
			}
			$this->settings[$key] = $status;
		}

		$ret = update_option( $this->option_key, $this->settings );
		if ( $ret ) {
			$WP_KUSANAGI->messages[] = __( 'Update settings successfully.', 'wp-kusanagi' );
		}
	}

	public function check_disabled_auto_update() {

		remove_all_filters( 'automatic_updater_disabled' );
		add_filter( 'automatic_updater_disabled', '__return_false', 999 );

		if ( !class_exists( 'WP_Automatic_Updater' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		}

		$upgrader = new WP_Automatic_Updater();
		if ( $upgrader->is_disabled() ) {
			if ( defined( 'DISALLOW_FILE_MODS' ) && DISALLOW_FILE_MODS ) {
				$this->errors[] = __( "Background updates are disabled. Change to define <code>('DISALLOW_FILE_MODS', false);</code> or comment out the definition.", 'wp-kusanagi');
			}

			if ( wp_installing() ) {
				$this->errors[] = __( "WP is installing", 'wp-kusanagi');
			}
		}
	}

	public function check_ftp_connection() {


		$method = 'ftpsockets';
		if ( !defined( 'FS_METHOD' ) ) {
			$this->errors[] = sprintf( __( "Add <code>define('FS_METHOD', '%1s');</code> to the wp-config.php file.", 'wp-kusanagi') , $method );
		}

		if ( !defined( 'FTP_HOST' ) ) {
			$this->errors[] = __( "Add <code>define('FTP_HOST', 'Localhost');</code> to the wp-config.php file.", 'wp-kusanagi');
		}

		if ( !defined( 'FTP_USER' ) ) {
			$this->errors[] = __( "Add <code>define('FTP_USER', 'kusanagi');</code> to the wp-config.php file.", 'wp-kusanagi');
		}

		if ( !defined( 'FTP_PASS' ) ) {
			$this->errors[] = __( "Add <code>define('FTP_PASS', '*****');</code> to the wp-config.php file and change <code>*****</code> part to login password.", 'wp-kusanagi');
		}
	}

	/**
	 * Check File System
	 */
	public function check_filesystem() {

		if ( $this->some_enable ) {

			$this->check_disabled_auto_update();
			$this->check_ftp_connection();

			if ( !$this->errors ) {
				ob_start();
				$credentials = request_filesystem_credentials( site_url('wp-admin'), '', false, false, array() );
				ob_clean();

				if ( $credentials && ! WP_Filesystem( $credentials, ABSPATH, false )) {
					$this->errors[] = sprintf(  __( 'Failed to connect to FTP Server %s. If you do not remember your credentials, you should contact your web host.', 'wp-kusanagi' ), $credentials['hostname'] );
				}
			}
		}
	}

	/**
	 * Getter the error messages
	 *
	 * @return array() This error messages.
	 */
	public function get_errors() {
		return $this->errors;
	}
}
$this->modules['automatic-updates'] = new KUSANAGI_Automatic_Updates;
