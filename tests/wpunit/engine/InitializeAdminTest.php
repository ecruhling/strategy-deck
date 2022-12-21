<?php

namespace Strategy_Deck\Tests\WPUnit;

class InitializeAdminTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp(): void {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		$user_id = $this->factory->user->create( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user_id );
		set_current_screen( 'edit.php' );
		add_filter( 'wp_doing_ajax', '__return_false' );
		do_action('plugins_loaded');
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be admin
	 */
	public function it_should_be_admin() {
		$classes   = array();
		$classes[] = 'Strategy_Deck\Internals\PostTypes';
		$classes[] = 'Strategy_Deck\Internals\Shortcode';
		$classes[] = 'Strategy_Deck\Internals\Transient';
		$classes[] = 'Strategy_Deck\Integrations\CMB';
		$classes[] = 'Strategy_Deck\Integrations\Cron';
		$classes[] = 'Strategy_Deck\Integrations\Template';
		$classes[] = 'Strategy_Deck\Integrations\Widgets\My_Recent_Posts_Widget';
		$classes[] = 'Strategy_Deck\Ajax\Ajax';
		$classes[] = 'Strategy_Deck\Ajax\Ajax_Admin';
		$classes[] = 'Strategy_Deck\Backend\ActDeact';
		$classes[] = 'Strategy_Deck\Backend\Enqueue';
		$classes[] = 'Strategy_Deck\Backend\ImpExp';
		$classes[] = 'Strategy_Deck\Backend\Notices';
		$classes[] = 'Strategy_Deck\Backend\Pointers';
		$classes[] = 'Strategy_Deck\Backend\Settings_Page';

		$all_classes = get_declared_classes();
		foreach( $classes as $class ) {
			$this->assertTrue( in_array( $class, $all_classes ) );
		}
	}

}
