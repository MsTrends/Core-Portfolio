<?php

class MS_Portfolio_CPT {


	#-----------------------------------------------------------------#
	# Init Portfolio CPT 
	#-----------------------------------------------------------------# 

	public function __construct() {

		add_action( 'init', array( $this, 'portfolio_cpt_register') );

	}


	#-----------------------------------------------------------------#
	# Register Admin Portfolio Section
	#-----------------------------------------------------------------# 


	public function portfolio_cpt_register() {  
	    	 
		$portfolio_labels = array(
			'name' 					 => esc_html__( 'Portfolio', 'mstrends' ),
			'singular_name' 		 => esc_html__( 'Portfolio Post', 'mstrends' ),
			'add_new' 				 => esc_html__( 'Add New', 'mstrends' ),
			'add_new_item'			 => esc_html__( 'Add New Portfolio', 'mstrends' ),
			'edit_item' 			 => esc_html__( 'Edit Portfolio', 'mstrends' ),
			'new_item' 				 => esc_html__( 'Add New', 'mstrends' ),
			'view_item' 			 => esc_html__( 'View Portfolio', 'mstrends' ),
			'all_items'       	  	 => esc_html__( 'All Portfolio Items', 'mstrends' ),
			'search_items' 			 => esc_html__( 'Search Portfolio', 'mstrends' ),
			'not_found' 			 => esc_html__( 'No portfolio items found', 'mstrends' ),
			'not_found_in_trash'	 => esc_html__( 'No portfolio items found in trash', 'mstrends' )
		);

		$args = array(
	    	'labels' 				 => $portfolio_labels,
	    	'public' 				 => true,
	    	'publicly_queryable'	 => true,
	    	'query_var' 			 => true,
	    	'exclude_from_search'	 => true,
			'supports' 				 => array( 'title', 'editor', 'thumbnail', 'post-formats'),
			'capability_type' 		 => 'post',
			'rewrite' 				 => array("slug" => "portfolio"),
			'menu_position' 		 => 20,
			'has_archive' 			 => true,
			'menu_icon'		   		 => 'dashicons-portfolio',			
		);  
	  
	    register_post_type( 'portfolio' , $args );
  
	} 


}