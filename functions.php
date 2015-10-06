<?php 

/*
Plugin Name: Core Portfolio
Plugin URI: http://mstrends.com/plugins/portfolio-post-type
Description: Creates a Specific CPT + Taxonomy + Widget for Portfolio.
Version: 1.0
Author: Muhamamd Faisal
Author URI: http://themeforest.net/user/MsTrends
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

    function ms_setup_portfolio() {

        // initiate classes
        new MS_Portfolio_CPT();
        new MS_Portfolio_Taxonomies();

    }

    ms_setup_portfolio();


#-----------------------------------------------------------------#
# Activation / Deactivation Hooks
#-----------------------------------------------------------------# 

    // On Plugin Activation
    function ms_portfolio_activate() { 

        ms_setup_portfolio();
        flush_rewrite_rules();

    }

    register_activation_hook( __FILE__, 'ms_portfolio_activate' );
     

    // On Plugin Deactivation
    function ms_portfolio_deactivate() {

        flush_rewrite_rules();

    }

    register_deactivation_hook( __FILE__, 'ms_portfolio_deactivate' );


#-----------------------------------------------------------------#
# Register and Enqueue JS & CSS for Portfolio Back-End
#-----------------------------------------------------------------# 


    function ms_enqueue_portfolio_scripts() {
        if ( is_admin() ) {

            // Register CSS
            wp_register_style('portfolio-style', plugin_dir_url(__FILE__) . 'css/style.css');

            // Enqueue CSS
            wp_enqueue_style('portfolio-style');

        }
    }

    add_action( 'admin_enqueue_scripts', 'ms_enqueue_portfolio_scripts' );    