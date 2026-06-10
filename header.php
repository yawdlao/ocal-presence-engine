<?php
/**
 * The header for the theme
 *
 * @package LocalPresenceEngine
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div class="layout">
    <aside>
      <?php get_template_part('template-parts/header'); ?>
    </aside>

    <main>
