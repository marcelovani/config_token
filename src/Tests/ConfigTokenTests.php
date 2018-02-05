<?php

namespace Drupal\config_token\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Config Token tests.
 *
 * @group config_token
 */
class ConfigTokenTests extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('token', 'node', 'field', 'text', 'config_token');

  /**
   * Admin user.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Create admin user.
    $this->adminUser = $this->drupalCreateUser(array(
      'access administration pages',
    ), 'Config Token Admin', TRUE);
  }

  /**
   * Check that an element exists in HTML markup.
   *
   * @param $xpath
   *   An XPath expression.
   * @param array $arguments
   *   (optional) An associative array of XPath replacement tokens to pass to
   *   DrupalWebTestCase::buildXPathQuery().
   * @param $message
   *   The message to display along with the assertion.
   * @param $group
   *   The type of assertion - examples are "Browser", "PHP".
   *
   * @return
   *   TRUE if the assertion succeeded, FALSE otherwise.
   */
  protected function assertElementByXPath($xpath, array $arguments = array(), $message, $group = 'Other') {
    $elements = $this->xpath($xpath, $arguments);
    return $this->assertTrue(!empty($elements[0]), $message, $group);
  }

  /**
   * Admin UI.
   */
  function testAdminUI() {
    $this->drupalLogin($this->adminUser);
    $this->drupalGet('admin/content');
//
//    $element = $this->xpath('//input[@type="text" and @id="edit-label" and @value="Default"]');
//    $this->assertTrue(count($element) === 1, 'The label is correct.');
  }

  /**
   * Token replacements.
   */
  function testTokens() {
    $value = \Drupal::token()->replace('[config_token:example_email]', [], ['clear' => FALSE]);
    $this->assertEqual($value, 'email@example.com');

    $value = \Drupal::token()->replace('[config_token:example_phone]', [], ['clear' => FALSE]);
    $this->assertEqual($value, '02070000000');
  }

}
