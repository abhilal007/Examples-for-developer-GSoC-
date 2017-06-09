<<?php


namespace Drupal\menu_example\Controller;

use Drupal\Core\Controller\ControllerBase;

class MenuExampleControlller extends ControllerBase {

  function basicInstructions() {
    $content = array(t('This page is displayed by the simplest (and base) menu
    example. Note that the title of the page is the same as the link title. You
    can also <a href="!link">visit a similar page with no menu link</a>. Also,
    note that there is a hook_menu_alter() example that has changed the path
    of one of the menu items.',
    array('!link' => url('examples/menu_example/path_only'))));

   $base_content = t(
  'This is the base page of the Menu Example. There are a number of examples
   here, from the most basic (like this one) to extravagant mappings of loaded
   placeholder arguments. Enjoy!');
  return '<div>' . $base_content . '</div><br /><div>' . $content . '</div>';
}

function alternateMenu(){
  return array(
     '#markup' => t('This will be in the Main menu instead of the default Tools menu'),
   );
}
public function permissioned() {
    return array(
      '#markup' => t('A menu item that requires the "access protected menu example" permission is at <a href="!link">examples/menu_example/permissioned/controlled</a>',
      array('!link' => url('examples/menu_example/permissioned/controlled'))),
    );
  }

  public function permissionedControlled() {
      return array(
        '#markup' => t('This menu entry will not show and the page will not be
        accessible without the "access protected menu example" permission.'),
      );
    }

    public function customAccess() {
       return array(
         '#markup' => t('A menu item that requires the user to posess a role of "authenticated" is at <a href="!link">examples/menu_example/custom_access/page</a>', array('!link' => url('examples/menu_example/custom_access/page'))),
       );
     }

     public function customAccessPage() {
       return array(
         '#markup' => t('This menu entry will not be visible and access will result in a 403 error unless the user has the "authenticated" role. This is accomplished with a custom access callback.'),
       );
     }

     public function routeOnly() {
       return array(
         '#markup' => t('A route with no menu link is at <a href="!link">!link</a>', array('!link' => url('examples/menu_example/route_only/route'))),
       );
     }

     public function routeOnlyRoute() {
       return array(
         '#markup' => t('The route entry has no corresponding menu_link entry, so it provides a route without a menu link, but it is the same in every other way to the simplest example.'),
       );
      }
     public function tabs() {
       return array(
         '#markup' => t('This is the "tabs" menu entry.'),
       );

     }
    public function tabNameSecond() {
      return array(
        '#markup' => t('This is the tab second in the "basic tabs" example', array(second))),
      );

    }
    public function tabNameThrid() {
      return array(
        '#markup' => t('This is the thrid in the "basic tabs" example', array(thrid))),
      );

    }
    public function tabNameForth() {
      return array(
        '#markup' => t('This is the tab forth in the "basic tabs" example', array(forth))),
      );

    }

  public function defaultSecond(){

    return array(t('This is the secondary tab second in the "basic tabs" example "default" tab', array(second)));
  }

  public function defaultThird(){

    return array(t('This is the secondary tab third in the "basic tabs" example "default" tab', array(third)));
  }

    public function urlArgument(){
      return array(
        '#markup' => t('This page demonstrates using arguments in the path (portions of the
        path after "menu_example/url_arguments". For example, access it with
        <a href="!link1">!link1</a> or <a href="!link2">!link2</a>).',
        array('!link1' => url('examples/menu_example/use_url_arguments/one/two'),
        '!link2' => url('examples/menu_example/use_url_arguments/firstarg/secondarg')));
      )
     }

    public function titleCallbacks() {
       return array(
         '#markup' => t('The title of this page is dynamically changed by the
         title callback for this route. Also, the title of the menu link is dynamically
         changed by implementing hook_menu_link_presave() and hook_translated_menu_link_alter().'),
       );
     }

     public function customTitle($title = '') {
       global $user;
       $title .= $user->name;
       return $title;
     }

     public function argument() {
         return array(
           '#markup' => t('Demonstrate placeholders by visiting
           <a href="!link">examples/menu_example/placeholder_argument/3343/display</a>',
           array('!link' => url('examples/menu_example/placeholder_argument/3343/display'))),
         );
       }
       public function display($node = '') {
           return array(
             '#markup' => $node,
           );
       }
       public function upcastExample($upcast = '') {
        return array(
          '#markup' => t('This is a placeholder for now, because it is not  working: '. $upcast),
        );
      }

       public function orginalPath() {
           return array(
             '#markup' => t('This menu item was created strictly to allow the
             hook_menu_alter() function to have something to operate on.
             hook_menu defined the path as examples/menu_example/menu_original_path.
             The hook_menu_alter() changes it to examples/menu_example/menu_altered_path.
             You can try navigating to both paths and see what happens!')
           );
         }

}
