<?php
/**
 * Template part for displaying the header
 *
 * @package LocalPresenceEngine
 */
?>

<header class="site-header">
  <div class="brand">
    <div class="mark">
      <?php if (has_custom_logo()) {
        the_custom_logo();
      } else {
        echo 'L';
      } ?>
    </div>
    <div>
      <h1><?php bloginfo('name'); ?></h1>
      <small><?php bloginfo('description'); ?></small>
    </div>
  </div>

  <nav class="primary-navigation">
    <?php
      wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id' => 'primary-menu',
        'fallback_cb' => 'wp_page_menu',
        'depth' => 2,
      ));
    ?>
  </nav>

  <div class="side-note">
    <strong>Ready to grow?</strong><br>
    Get a free consultation today. Let's talk about your digital vision.
  </div>
</header>
