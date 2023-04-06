<?php
/**
 * Plugin Name: Divi Menu Button
 * Description: Description will be here
 * Version: 1.0.1
 * Author: Mayank Kumar
 **/

function divi_menu_button() {
  ?>
  <li><a href="#" class="button">Button Text</a></li>
  <?php
}

add_filter( 'wp_nav_menu_items', 'divi_menu_button', 10, 2 );


function divi_menu_button($items, $args) {
  // Set the button text, link and style based on user input
  $button_text = get_option('divi_menu_button_text', 'Button Text');
  $button_link = get_option('divi_menu_button_link', '#');
  $button_style = get_option('divi_menu_button_style', 'button');

  // Add the button HTML to the menu
  $button_html = '<li><a href="' . $button_link . '" class="' . $button_style . '">' . $button_text . '</a></li>';
  $items .= $button_html;

  return $items;
}

// Add a settings page to the WordPress admin panel
function divi_menu_button_settings_page() {
  add_options_page( 'Divi Menu Button Settings', 'Divi Menu Button', 'manage_options', 'divi-menu-button', 'divi_menu_button_settings_callback' );
}
add_action( 'admin_menu', 'divi_menu_button_settings_page' );

// Add the settings fields to the settings page
function divi_menu_button_settings_init() {
  register_setting( 'divi_menu_button_settings', 'divi_menu_button_text' );
  register_setting( 'divi_menu_button_settings', 'divi_menu_button_link' );
  register_setting( 'divi_menu_button_settings', 'divi_menu_button_style' );

  add_settings_section( 'divi_menu_button_settings_section', 'Button Settings', 'divi_menu_button_settings_section_callback', 'divi_menu_button_settings' );

  add_settings_field( 'divi_menu_button_text', 'Button Text', 'divi_menu_button_text_callback', 'divi_menu_button_settings', 'divi_menu_button_settings_section' );
  add_settings_field( 'divi_menu_button_link', 'Button Link', 'divi_menu_button_link_callback', 'divi_menu_button_settings', 'divi_menu_button_settings_section' );
  add_settings_field( 'divi_menu_button_style', 'Button Style', 'divi_menu_button_style_callback', 'divi_menu_button_settings', 'divi_menu_button_settings_section' );
}
add_action( 'admin_init', 'divi_menu_button_settings_init' );

// Callback functions for the settings fields
function divi_menu_button_settings_section_callback() {
  echo 'Customize the button text, link, and style below:';
}

function divi_menu_button_text_callback() {
  $text = get_option('divi_menu_button_text', 'Button Text');
  echo '<input type="text" name="divi_menu_button_text" value="' . esc_attr($text) . '" />';
}

function divi_menu_button_link_callback() {
  $link = get_option('divi_menu_button_link', '#');
  echo '<input type="text" name="divi_menu_button_link" value="' . esc_attr($link) . '" />';
}

function divi_menu_button_style_callback() {
  $style = get_option('divi_menu_button_style', 'button');
  echo '<select name="divi_menu_button_style">
        <option value="button" ' . selected($style, 'button', false) . '>Button</option>
        <option value="button-primary" ' . selected($style, 'button-primary', false) . '>Button Primary</option>
        <option value="button-secondary
