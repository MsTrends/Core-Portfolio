<?php 

/*
Plugin Name: Core Portfolio
Plugin URI: https://github.com/themeshash/core-portfolio
Description: Creates a Specific CPT + Taxonomy + Widget for Portfolio.
Version: 1.2
Author: Muhamamd Faisal
Author URI: http://themeforest.net/user/ThemesHash
*/


#-----------------------------------------------------------------#
# If this file is called directly, abort.
#-----------------------------------------------------------------# 

    if ( ! defined( 'WPINC' ) ) {
        die;
    }


#-----------------------------------------------------------------#
# Loads the Core Plugin Classes
#-----------------------------------------------------------------# 

	require_once( DIRNAME(__FILE__) . '/inc/class_portfolio_cpt.php' );
    require_once( DIRNAME(__FILE__) . '/inc/class_portfolio_tax.php' );
    require_once( DIRNAME(__FILE__) . '/inc/class_portfolio_widget.php' );


#-----------------------------------------------------------------#
# Setup Core Plugin (fires on every page load)
#-----------------------------------------------------------------# 

    function th_setup_portfolio() {

        // initiate classes
        new TH_Portfolio_CPT();
        new TH_Portfolio_Taxonomies();

    }

    th_setup_portfolio();


#-----------------------------------------------------------------#
# Activation / Deactivation Hooks
#-----------------------------------------------------------------# 

    // On Plugin Activation
    function th_portfolio_activate() { 

        th_setup_portfolio();
        th_portfolio_install();
        flush_rewrite_rules();

    }

    register_activation_hook( __FILE__, 'th_portfolio_activate' );
     

    // On Plugin Deactivation
    function th_portfolio_deactivate() {

        flush_rewrite_rules();

    }

    register_deactivation_hook( __FILE__, 'th_portfolio_deactivate' );


#-----------------------------------------------------------------#
# Register and Enqueue JS & CSS for Portfolio Back-End
#-----------------------------------------------------------------# 


    function th_enqueue_portfolio_scripts() {
        if ( is_admin() ) {

            // Register CSS
            wp_register_style('portfolio-style', plugin_dir_url(__FILE__) . 'css/style.css');

            // Enqueue CSS
            wp_enqueue_style('portfolio-style');

        }
    }

    add_action( 'admin_enqueue_scripts', 'th_enqueue_portfolio_scripts' );    

