<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <header>
        <div class="header-container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <div class="logo-mark">LPE</div>
                <h1>Local Presence Engine</h1>
            </a>
            
            <button class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <nav id="mainNav">
                <ul>
                    <li><a href="#mission">Services</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#process">Process</a></li>
                    <li><a href="#about">About Sai</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact" class="cta-button">Free Consultation</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
