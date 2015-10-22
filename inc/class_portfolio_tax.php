<?php

class MS_Portfolio_Taxonomies {


	#-----------------------------------------------------------------#
	# Init Portfolio Taxonomies 
	#-----------------------------------------------------------------# 

	public function __construct() {

		add_action( 'init', array( $this, 'portfolio_category_register') );

	}


	#-----------------------------------------------------------------#
	# Register Portfolio Category Taxonomy 
	#-----------------------------------------------------------------# 


	public function portfolio_category_register() {  

		$taxonomy_labels = array(
			'name' 							=> esc_html__( 'Portfolio Categories', 'mstrends' ),
			'singular_name' 				=> esc_html__( 'Portfolio Category', 'mstrends' ),
			'search_items' 					=> esc_html__( 'Search Portfolio Categories', 'mstrends' ),
			'popular_items'					=> esc_html__( 'Popular Portfolio Categories', 'mstrends' ),
			'all_items' 					=> esc_html__( 'All Portfolio Categories', 'mstrends' ),
			'parent_item' 					=> esc_html__( 'Parent Portfolio Category', 'mstrends' ),
			'parent_item_colon' 			=> esc_html__( 'Parent Portfolio Category:', 'mstrends' ),
			'edit_item' 					=> esc_html__( 'Edit Portfolio Category', 'mstrends' ),
			'update_item' 					=> esc_html__( 'Update Portfolio Category', 'mstrends' ),
			'add_new_item' 					=> esc_html__( 'Add New Portfolio Category', 'mstrends' ),
			'new_item_name' 				=> esc_html__( 'New Portfolio Category Name', 'mstrends' ),
			'separate_items_with_commas' 	=> esc_html__( 'Separate portfolio categories with commas', 'mstrends' ),
			'add_or_remove_items' 			=> esc_html__( 'Add or remove portfolio categories', 'mstrends' ),
			'choose_from_most_used' 		=> esc_html__( 'Choose from the most used portfolio categories', 'mstrends' ),
			'menu_name' 					=> esc_html__( 'Categories', 'mstrends' ),
		);

		$args = array( 
			'labels' 						=> $taxonomy_labels,
			'public' 						=> true,
			'show_in_nav_menus' 			=> true,
			'show_ui' 						=> true,
			'show_admin_column' 			=> true,
			'show_tagcloud'					=> false,
			'hierarchical' 					=> true,
			'rewrite' 						=> array( 'slug' => 'portfolio-category' ),
			'query_var' 					=> true
		);

	    register_taxonomy( 'portfolio_category' , 'portfolio', $args );

	}


}