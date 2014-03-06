<?php

/**
 * Library
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://kit2.phpmanufaktur.de
 * @copyright 2014 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */


/**
 * Bootstrap Helper to create Navbar links - show_menu2() replacement
 *
 * @param integer $menu 0 (default) show all menus
 * @param integer $level default is 0
 * @param string $visibility i.e. 'public' by default
 * @param boolean $echo if true ECHO the links, otherwise RETURN
 * @return string
 */
function navbarlinks($menu = 0, $level = 0, $visibility = 'public', $echo=true)
{
  $Navbar = new bsNavbarLinks();
  $links = $Navbar->getNavbarLinks($menu, $level, $visibility);
  if ($echo) {
    echo $links;
  }
  else {
    return $links;
  }
}

class bsNavbarLinks {

  protected static $start_level = null;

  /**
   * Get the Page ID's for the given menu, level and visibility
   *
   * @param integer $menu
   * @param integer $level
   * @param string $visibility
   * @throws \Exception
   * @return Ambigous <boolean, array>
   */
  protected function getPageIDsForLevel($menu = 0, $level = 0, $visibility = 'public')
  {
    global $database;

    $menu_sql = ($menu > 0) ? "AND `menu` = $menu " : '';

    $SQL = "SELECT `page_id` FROM `" . TABLE_PREFIX . "pages` WHERE `level`= $level $menu_sql" .
            "AND `visibility`='$visibility' ORDER BY `position` ASC";

    $page_ids = array();
    if (null === ($query = $database->query($SQL))) {
      throw new Exception($database->get_error());
    }

    while (false !== ($page = $query->fetchRow(MYSQL_ASSOC))) {
      $page_ids[] = $page['page_id'];
    }

    return (!empty($page_ids)) ? $page_ids : false;
  }

  /**
   * Check if the given PAGE ID has a child
   *
   * @param integer $page_id
   * @throws \Exception
   * @return boolean
   */
  protected function PageHasChild($page_id)
  {
    global $database;

    $SQL = "SELECT `page_id` FROM `" . TABLE_PREFIX . "pages` WHERE `parent` = $page_id LIMIT 1";
    $page_id = $database->get_one($SQL);
    return ($page_id > 0);
  }

  /**
   * Get the URL of the submitted PAGE_ID
   *
   * @param integer $page_id
   * @return boolean|string
   */
  public static function getURLbyPageID($page_id)
  {
    global $database;

    $SQL = "SELECT `link` FROM `" . TABLE_PREFIX . "pages` WHERE `page_id`='$page_id'";
    $link = $database->get_one($SQL, MYSQL_ASSOC);
    if ($database->is_error()) {
      trigger_error(sprintf('[%s - %s] %s', __FUNCTION__, __LINE__, $database->get_error()), E_USER_ERROR);
      return false;
    }
    return WB_URL . PAGES_DIRECTORY . $link . PAGE_EXTENSION;
  }

  /**
   * Get the page title for the given page ID
   *
   * @global object $database
   * @param integer $page_id
   * @return string
   */
  protected function getPageTitle($page_id)
  {
    global $database;

    $SQL = "SELECT `page_title` FROM `" . TABLE_PREFIX . "pages` WHERE `page_id`='$page_id'";
    return $database->get_one($SQL);
  }

  /**
   * Get the menu title for the given Page ID
   *
   * @global object $database
   * @param integer $page_id
   * @return string
   */
  protected function getMenuTitle($page_id)
  {
    global $database;

    $SQL = "SELECT `menu_title` FROM `" . TABLE_PREFIX . "pages` WHERE `page_id`='$page_id'";
    return $database->get_one($SQL);
  }

  /**
   * Build the navar items recursivly
   *
   * @param integer $menu
   * @param integer $level
   * @param string $visibility
   * @param string reference $navbar
   */
  protected function buildNavbar($menu, $level, $visibility, &$navbar = '')
  {
    $page_ids = $this->getPageIDsForLevel($menu, $level, $visibility);
    if (is_array($page_ids)) {
        foreach ($page_ids as $page_id) {
          if ($this->PageHasChild($page_id)) {
            if ($level == self::$start_level) {
              $navbar .= '<li class="menu-item dropdown">';
              $navbar .= sprintf('<a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s <b class="caret"></b></a>', $this->getURLbyPageID($page_id), $this->getMenuTitle($page_id));
            } else {
              $navbar .= '<li class="menu-item dropdown dropdown-submenu">';
              $navbar .= sprintf('<a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s</a>', $this->getURLbyPageID($page_id), $this->getMenuTitle($page_id));
            }
            $navbar .= '<ul class="dropdown-menu">';
            $this->buildNavbar($menu, $level + 1, $visibility, $navbar);
            $navbar .= '</ul></li>';
          } else {
            $navbar .= sprintf('<li class="%s"><a href="%s" title="%s">%s</a></li>', ($page_id == PAGE_ID) ? 'menu-item active' : 'menu-item', $this->getURLbyPageID($page_id), $this->getPageTitle($page_id), $this->getMenuTitle($page_id)
            );
          }
        }
    }
  }

  /**
   * Controller to create the Navbar links
   *
   * @param integer $menu
   * @param integer $level
   * @param string $visibility
   * @return string
   */
  public function getNavbarLinks($menu = 0, $level = 0, $visibility = 'public')
  {
    self::$start_level = $level;

    $navbar = '';
    $this->buildNavbar($menu, $level, $visibility, $navbar);

    if (!empty($navbar)) {
      $navbar = sprintf('<ul class="nav navbar-nav">%s</ul>', $navbar);
    }

    return $navbar;
  }

}
