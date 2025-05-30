<?php
/**
 * WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */

/* Verificar se a classe já existe para evitar duplicidades */
if (!class_exists('WP_Bootstrap_Navwalker')) {
  /**
   * WP_Bootstrap_Navwalker class.
   */
  class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
  {

    /**
     * Starts the list before the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent = str_repeat($t, $depth);
      // Default class.
      $classes = array('dropdown-menu');

      $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

      $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    /**
     * Starts the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent = ($depth) ? str_repeat($t, $depth) : '';

      $classes = empty($item->classes) ? array() : (array) $item->classes;
      $classes[] = 'nav-item';
      $classes[] = 'menu-item-' . $item->ID;

      if ($args->walker->has_children) {
        $classes[] = 'dropdown';
      }

      if (in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true)) {
        $classes[] = 'active';
      }

      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

      $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
      $id = $id ? ' id="' . esc_attr($id) . '"' : '';

      $output .= $indent . '<li' . $id . $class_names . '>';

      $atts = array();
      $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
      $atts['target'] = !empty($item->target) ? $item->target : '';
      $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
      $atts['href'] = !empty($item->url) ? $item->url : '';
      $atts['class'] = 'nav-link';

      if ($args->walker->has_children) {
        $atts['class'] .= ' dropdown-toggle';
        $atts['data-bs-toggle'] = 'dropdown';
        $atts['aria-expanded'] = 'false';
      }

      $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

      $attributes = '';
      foreach ($atts as $attr => $value) {
        if (!empty($value)) {
          $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }

      $title = apply_filters('the_title', $item->title, $item->ID);
      $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

      $item_output = $args->before;
      $item_output .= '<a' . $attributes . '>';
      $item_output .= $args->link_before . $title . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Menu Fallback
     * 
     * @param array $args passed from the wp_nav_menu function.
     */
    public static function fallback($args)
    {
      if (current_user_can('edit_theme_options')) {
        echo '<li class="nav-item"><a class="nav-link" href="' .
          esc_url(admin_url('nav-menus.php')) . '">' .
          esc_html__('Adicione um menu', 'regiane-corretora') . '</a></li>';
      }
    }
  }
}