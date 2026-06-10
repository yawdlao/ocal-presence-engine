<?php
/**
 * Main template file
 *
 * @package LocalPresenceEngine
 */

get_header();
?>

<main id="main" class="site-main">
  <?php
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>
          <div class="entry-content">
            <?php
              the_content();
              wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'local-presence-engine'),
                'after' => '</div>',
              ));
            ?>
          </div>
        </article>
        <?php
      }
    } else {
      ?>
      <p><?php esc_html_e('Sorry, no posts found.', 'local-presence-engine'); ?></p>
      <?php
    }
  ?>
</main>

<?php
get_footer();
