<?php

/**
 * @file
 * Contains \Drupal\menu_example\Tests\MenuExampleTest.
 */

namespace Drupal\menu_example\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Minimal test case for this module.
 *
 * @group menu_example
 */
class MenuExampleTest extends WebTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = array('menu_example');

  /**
   * The installation profile to use with this test.
   *
   * @var string
   */
  protected $profile = 'minimal';

  /**
   * Test whether the module was installed.
   */
  public function testInstalled() {
    $this->assertTrue(\Drupal::moduleHandler()->moduleExists('menu_example'));
  }

  /**
   * Test the various menus.
   */
  public function testMenuExample() {
    $this->drupalGet('');
    $this->clickLink(t('Menu Example'));
    $this->assertText(t('This is the base page of the Menu Example'));

    $this->clickLink(t('Custom Access Example'));
    $this->assertText(t('Custom Access Example'));

    $this->clickLink(t('examples/menu_example/custom_access/page'));
    $this->assertResponse(403);

    $this->drupalGet('examples/menu_example/permissioned');
    $this->assertText(t('Permissioned Example'));

    $this->clickLink('examples/menu_example/permissioned/controlled');
    $this->assertResponse(403);

    $this->drupalGet('examples/menu_example');

    $this->clickLink(t('MENU_CALLBACK example'));

    $this->drupalGet('examples/menu_example/path_only/callback');
    $this->assertText(t('The menu entry for this page is of type MENU_CALLBACK'));

    $this->clickLink(t('Tabs'));
    $this->assertText(t('This is the "tabs" menu entry'));

    $this->drupalGet('examples/menu_example/tabs/second');
    $this->assertText(t('This is the tab "second" in the "basic tabs" example'));

    $this->clickLink(t('third'));
    $this->assertText(t('This is the tab "third" in the "basic tabs" example'));

    $this->clickLink(t('Extra Arguments'));

    $this->drupalGet('examples/menu_example/use_url_arguments/one/two');
    $this->assertText(t('Argument 1=one'));

    $this->clickLink(t('Placeholder Arguments'));

    $this->clickLink(t('examples/menu_example/placeholder_argument/3343/display'));
    $this->assertRaw('<div>3343</div>');

    $this->clickLink(t('Processed Placeholder Arguments'));
    $this->assertText(t('Loaded value was jackpot! default'));

    // Create a user with permissions to access protected menu entry.
    $web_user = $this->drupalCreateUser(array('access protected menu example'));

    // Use custom overridden drupalLogin function to verify the user is logged
    // in.
    $this->drupalLogin($web_user);

    // Check that our title callback changing /user dynamically is working.
    // Using &#039; because of the format_username function.
    $this->assertRaw(t("@name&#039;s account", array('@name' => $web_user->getUsername())), format_string('Title successfully changed to account name: %name.', array('%name' => $web_user->getUsername())));

    // Now start testing other menu entries.
    $this->drupalGet('examples/menu_example');

    $this->clickLink(t('Custom Access Example'));
    $this->assertText(t('Custom Access Example'));

    $this->drupalGet('examples/menu_example/custom_access/page');
    $this->assertResponse(200);

    $this->drupalGet('examples/menu_example/permissioned');
    $this->assertText('Permissioned Example');
    $this->clickLink('examples/menu_example/permissioned/controlled');
    $this->assertText('This menu entry will not show');

    $this->drupalGet('examples/menu_example/menu_altered_path');
    $this->assertText('This menu item was created strictly to allow the hook_menu_alter()');
  }
}