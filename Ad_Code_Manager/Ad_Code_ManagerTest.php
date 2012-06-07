<?php
/**
 * Ad Code Manager Test Case
 *
 * @since 0.2.2
 */
class Ad_Code_ManagerTest extends WP_UnitTestCase {
    public $plugin_slug = 'ad-code-manager';

    public function setUp() {
        parent::setUp();
        $this->acm = $GLOBALS['ad_code_manager'];
		$this->acm->action_load_providers();
		$this->acm->action_init();
    }
	
	public function testDefaultProviderSlug() {
		$this->assertEquals( 'doubleclick_for_publishers',  $this->acm->current_provider_slug );
	}
	
	public function testProviderIsObject() {
		$this->assertInstanceOf( 'ACM_Provider', $this->acm->current_provider );
	}
	
	public function testProvidersAreAvaliable() {
		$this->assertNotEmpty( $this->acm->providers );
	}
	
	public function testCreateProperAdCode() {
		$this->assertInternalType( 'int', $this->_createAdCodeAndReturn() );
	}
	
	public function testGetAdCodesAfterCreate() {
		$this->_createAdCodeAndReturn();
		$this->assertNotEmpty( $this->acm->get_ad_codes() );
	}
	
	public function testEditAdCodeNotAllRequired() {
		$ad_code = $this->_mockAdCode();
		array_shift($ad_code);
		$this->assertInstanceOf('WP_Error', $this->acm->edit_ad_code( 555, $ad_code ) );
	}
	
	public function testEditAdCodeProper() {		
		$this->assertInternalType('int', $this->acm->edit_ad_code( 555,  $this->_mockAdCode() ) );
	}
	
	private function _mockAdCode() {
		$ad_code = array();
		foreach ( $this->acm->current_provider->ad_code_args as $arg ) {
			$ad_code[$arg['key']] = "Column " . $arg['key']. " , with label ". $arg['label'] ;
		}
		$ad_code['priority'] = 10;
		return $ad_code;
	}
	
	private function _createAdCodeAndReturn() {
		return $this->acm->create_ad_code( $this->_mockAdCode() );		
	}
}