<?php
/**
 * Template part for displaying the footer
 *
 * @package LocalPresenceEngine
 */
?>

<footer class="site-footer">
  <div class="footer-grid">
    <div class="footer-col">
      <h4><?php bloginfo('name'); ?></h4>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#about">About</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Resources</h4>
      <ul>
        <li><a href="<?php echo blog_url(); ?>/blog">Blog</a></li>
        <li><a href="<?php echo blog_url(); ?>/case-studies">Case Studies</a></li>
        <li><a href="<?php echo blog_url(); ?>/resources">Resources</a></li>
        <li><a href="#faq">FAQ</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Legal</h4>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
        <li><a href="#">Cookie Policy</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Connect</h4>
      <ul>
        <li><a href="https://saiyawnlu.com" target="_blank">Portfolio</a></li>
        <li><a href="https://linkedin.com" target="_blank">LinkedIn</a></li>
        <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
        <li><a href="#contact">Get Started</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Built to help small businesses and nonprofits thrive digitally.</p>
  </div>
</footer>
