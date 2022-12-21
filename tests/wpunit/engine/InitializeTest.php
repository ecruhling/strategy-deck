<?php

namespace Strategy_Deck\Tests\WPUnit;

class InitializeTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp(): void {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		wp_set_current_user(0);
		wp_logout();
		wp_safe_redirect(wp_login_url());

		do_action('plugins_loaded');
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be front
	 */
	public function it_should_be_front() {
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
		$classes[] = 'Strategy_Deck\Frontend\Enqueue';
		$classes[] = 'Strategy_Deck\Frontend\Extras\Body_Class';

		$all_classes = get_declared_classes();
		foreach( $classes as $class ) {
			$this->assertTrue( in_array( $class, $all_classes ) );
		}
	}

}
