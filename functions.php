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


#-----------------------------------------------------------------#
#  Create New Page on Plugin Activation
#-----------------------------------------------------------------# 

    // if ( !function_exists('portfolio_is_bad_hierarchical_slug') ) {

    //     function portfolio_is_bad_hierarchical_slug( $is_bad_hierarchical_slug, $slug, $post_type, $post_parent ) {
    //         if ( !$post_parent && $slug == 'portfolio' )
    //             return true;
    //         return $is_bad_hierarchical_slug;
    //     }

    // }

    // add_filter( 'wp_unique_post_slug_is_bad_hierarchical_slug', 'portfolio_is_bad_hierarchical_slug', 10, 4 );


    // if ( !function_exists('portfolio_is_bad_flat_slug') ) {

    //     function portfolio_is_bad_flat_slug( $is_bad_flat_slug, $slug, $post_type ) {
    //         if ( $slug == 'portfolio' )
    //             return true;
    //         return $is_bad_flat_slug;
    //     }

    // }

    // add_filter( 'wp_unique_post_slug_is_bad_flat_slug', 'portfolio_is_bad_flat_slug', 10, 3 );


    function th_portfolio_install() {
        global $wp_version;

        if( version_compare( $wp_version, '3.5', '<' ) ) {
            wp_die( 'Detta tilläget kräver att du har WordPress version 3.5 eller högre.' );
        } else {
            if(!get_page_by_slug('portfolio')) {
                $product_page = array(
                    'post_type' => 'page',
                    'post_name' => 'portfolio',
                    'post_title' => 'Portfolio',
                    'post_status' => 'publish',
                );

                wp_insert_post($product_page);
            }
        }   
    }


    function get_page_by_slug($slug) {
        if ($pages = get_pages())
            foreach ($pages as $page)
                if ($slug === $page->post_name) return $page;
        return false;
    } // function get_page_by_slug
