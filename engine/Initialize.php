<?php

/**
 * Strategy_Deck
 *
 * @package   Strategy_Deck
 * @author    Erik Rühling <ecruhling@gmail.com>
 * @copyright Resource Branding
 * @license   GPL 2.0+
 * @link      https://resourceatlanta.com
 */

namespace Strategy_Deck\Engine;

use Composer\Autoload\ClassLoader;
use Exception;
use Strategy_Deck\Engine;
use Throwable;
use function apply_filters;
use function array_diff;
use function array_keys;
use function do_action;
use function esc_html__;
use function is_array;
use function is_dir;
use function is_file;
use function method_exists;
use function scandir;
use function strncmp;
use function strtolower;
use function substr;
use function substr_count;
use function wp_die;

/**
 * Strategy_Deck Initializer
 */
class Initialize {

	/**
	 * List of class to initialize.
	 *
	 * @var array
	 */
	public array $classes = array();

	/**
	 * Instance of this Context.
	 *
	 * @var object
	 */
	protected $content = null;

	/**
	 * Composer autoload file list.
	 *
	 * @var ClassLoader
	 */
	private ClassLoader $composer;

	/**
	 * The Constructor that load the entry classes
	 *
	 * @param ClassLoader $composer Composer autoload output.
	 *
	 * @throws Exception
	 * @since 1.0.0
	 */
	public function __construct( ClassLoader $composer ) {
		$this->content  = new Engine\Context;
		$this->composer = $composer;

		$this->get_classes( 'Internals' );
		$this->get_classes( 'Integrations' );

		if ( $this->content->request( 'rest' ) ) {
			$this->get_classes( 'Rest' );
		}

		if ( $this->content->request( 'cli' ) ) {
			$this->get_classes( 'Cli' );
		}

		if ( $this->content->request( 'ajax' ) ) {
			$this->get_classes( 'Ajax' );
		}

		if ( $this->content->request( 'backend' ) ) {
			$this->get_classes( 'Backend' );
		}

		if ( $this->content->request( 'frontend' ) ) {
			$this->get_classes( 'Frontend' );
		}

		$this->load_classes();
	}

	/**
	 * Initialize all the classes.
	 *
	 * @return void
	 * @throws Exception
	 * @since 1.0.0
	 * @SuppressWarnings("MissingImport")
	 */
	private function load_classes() {
		$this->classes = apply_filters( 'strategydeck_classes_to_execute', $this->classes );

		foreach ( $this->classes as $class ) {
			try {
				$temp = new $class;

				if ( method_exists( $temp, 'initialize' ) ) {
					$temp->initialize();
				}
			} catch ( Throwable $err ) {
				do_action( 'strategydeck_initialize_failed', $err );

				if ( WP_DEBUG ) {
					throw new Exception( $err->getMessage() );
				}
			}
		}
	}

	/**
	 * Based on the folder loads the classes automatically using the Composer autoload to detect the classes of a Namespace.
	 *
	 * @param string $namespace Class name to find.
	 *
	 * @return void Return the classes.
	 * @since 1.0.0
	 */
	private function get_classes( string $namespace ): void {
		$prefix    = $this->composer->getPrefixesPsr4();
		$classmap  = $this->composer->getClassMap();
		$namespace = 'Strategy_Deck\\' . $namespace;

		// In case composer has autoload optimized
		if ( isset( $classmap[ 'Strategy_Deck\\Engine\\Initialize' ] ) ) {
			$classes = array_keys( $classmap );

			foreach ( $classes as $class ) {
				if ( 0 !== strncmp( (string) $class, $namespace, \strlen( $namespace ) ) ) {
					continue;
				}

				$this->classes[] = $class;
			}

			return;
		}

		$namespace .= '\\';

		// In case composer is not optimized
		if ( isset( $prefix[ $namespace ] ) ) {
			$folder    = $prefix[ $namespace ][0];
			$php_files = $this->scandir( $folder );
			$this->find_classes( $php_files, $folder, $namespace );

			if ( !WP_DEBUG ) {
				wp_die( esc_html__( 'Strategy Deck is on production environment with missing `composer dumpautoload -o` that will improve the performance on autoloading itself.', SD_TEXTDOMAIN ) );
			}
		}

	}

	/**
	 * Get php files inside the folder/subfolder that will be loaded.
	 * This class is used only when Composer is not optimized.
	 *
	 * @param string $folder Path.
	 * @since 1.0.0
	 * @return array List of files.
	 */
	private function scandir( string $folder ): array {
		$temp_files = scandir( $folder );
			$files  = array();

		if ( is_array( $temp_files ) ) {
			$files = $temp_files;
		}

		return array_diff( $files, array( '..', '.', 'index.php' ) );
	}

	/**
	 * Load namespace classes by files.
	 *
	 * @param array  $php_files List of files with the Class.
	 * @param string $folder Path of the folder.
	 * @param string $base Namespace base.
	 * @since 1.0.0
	 * @return void
	 */
	private function find_classes( array $php_files, string $folder, string $base ) {
		foreach ( $php_files as $php_file ) {
			$class_name = substr( $php_file, 0, -4 );
			$path       = $folder . '/' . $php_file;

			if ( is_file( $path ) ) {
				$this->classes[] = $base . $class_name;

				continue;
			}

			// Verify the Namespace level
			if ( substr_count( $base . $class_name, '\\' ) < 2 ) {
				continue;
			}

			if ( ! is_dir( $path ) || strtolower( $php_file ) === $php_file ) {
				continue;
			}

			$sub_php_files = $this->scandir( $folder . '/' . $php_file );
			$this->find_classes( $sub_php_files, $folder . '/' . $php_file, $base . $php_file . '\\' );
		}
	}

}
