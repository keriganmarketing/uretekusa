<?php

/* ----------------------------------------------------------------------------------- */
/*  Register and load common JS
  /*----------------------------------------------------------------------------------- */

function factorycommercegurus_register_production_js() {

	if ( !is_admin() ) {
		// don't concat and minify these
		wp_enqueue_script( 'waypoints', factorycommercegurus_JS . '/dist/waypoints.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bootstrap_js', factorycommercegurus_BOOTSTRAP_JS . '/bootstrap.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'magnific-popup', factorycommercegurus_JS . '/src/cond/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'owlcarousel', factorycommercegurus_JS . '/src/cond/owl.carousel.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'factorycommercegurus_modernizr_custom', factorycommercegurus_JS . '/src/cond/modernizr.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'factorycommercegurus_ticker', factorycommercegurus_JS . '/src/cond/inewsticker.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'imagesloaded', factorycommercegurus_JS . '/src/cond/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
		
		wp_enqueue_script( 'factorycommercegurus_quickview', factorycommercegurus_JS . '/src/cond/cg_quickview.js', array( 'jquery' ), '', true );
		wp_localize_script( 'factorycommercegurus_quickview', 'factorycommercegurus_ajax', array( 'factorycommercegurus_ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		// Minified versions of all plugins in /js/src/plugins
		wp_enqueue_script( 'factorycommercegurus_commercegurus_plugins_js', factorycommercegurus_JS . '/dist/plugins.min.js', array( 'jquery' ), '', true );

		if ( factorycommercegurus_is_live_demo() ) {
			wp_enqueue_script( 'cg-dynamicjs', factorycommercegurus_JS . '/src/cond/cgdynamic.php', array(), '', true );
			wp_enqueue_script( 'jqueryui', factorycommercegurus_JS . '/src/cond/jquery-ui.min.js', array(), '', true );
			wp_enqueue_script( 'cg-livepreviewjs', factorycommercegurus_JS . '/src/cond/livepreview.js', array(), '', true );
		}

		// Minified commercegurus.js call from /src/commercegurus.js original - /dist/commercegurus.min.js
		wp_enqueue_script( 'factorycommercegurus_commercegurus_js', factorycommercegurus_JS . '/dist/commercegurus.min.js', array( 'jquery' ), '', true );
	}
}

add_action( 'wp_enqueue_scripts', 'factorycommercegurus_register_production_js' );

function factorycommercegurus_register_debug_js() {

	if ( !is_admin() ) {

		//Loading from unminified source

		wp_enqueue_script( 'waypoints', factorycommercegurus_JS . '/dist/waypoints.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bootstrap_js', factorycommercegurus_BOOTSTRAP_JS . '/bootstrap.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'magnific-popup', factorycommercegurus_JS . '/src/cond/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'factorycommercegurus_modernizr_custom', factorycommercegurus_JS . '/src/cond/modernizr.js', array( 'jquery' ), '', false );		
		wp_enqueue_script( 'factorycommercegurus_ticker', factorycommercegurus_JS . '/src/cond/inewsticker.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'imagesloaded', factorycommercegurus_JS . '/src/cond/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );

		
		wp_enqueue_script( 'factorycommercegurus_quickview', factorycommercegurus_JS . '/src/cond/cg_quickview.js', array( 'jquery' ), '', true );
		wp_localize_script( 'factorycommercegurus_quickview', 'factorycommercegurus_ajax', array( 'factorycommercegurus_ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		wp_enqueue_script( 'classie_js', factorycommercegurus_JS . '/src/plugins/classie.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'uisearch_js', factorycommercegurus_JS . '/src/plugins/uisearch.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bootstrap_select_js', factorycommercegurus_JS . '/src/plugins/bootstrap-select.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'owlcarousel', factorycommercegurus_JS . '/src/cond/owl.carousel.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'jrespond', factorycommercegurus_JS . '/src/plugins/jRespond.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'factorycommercegurus_cookie', factorycommercegurus_JS . '/src/plugins/cookie.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'meanmenu', factorycommercegurus_JS . '/src/plugins/jquery.meanmenu.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'flexslider', factorycommercegurus_JS . '/src/plugins/jquery.flexslider-min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'skrollr', factorycommercegurus_JS . '/src/plugins/skrollr.js', array( 'jquery' ), '', true );



		if ( factorycommercegurus_is_live_demo() ) {
			wp_enqueue_script( 'cg-dynamicjs', factorycommercegurus_JS . '/src/cond/capdynamic.php', array(), '', true );
			wp_enqueue_script( 'jqueryui', factorycommercegurus_JS . '/src/cond/jquery-ui.min.js', array(), '', true );
			wp_enqueue_script( 'cg-livepreviewjs', factorycommercegurus_JS . '/src/cond/livepreview.js', array(), '', true );
		}

		// Full source commerceugurus.js call
		wp_enqueue_script( 'factorycommercegurus_commercegurus_js', factorycommercegurus_JS . '/src/commercegurus.js', array( 'jquery' ), '', true );
	}
}

//add_action( 'wp_enqueue_scripts', 'factorycommercegurus_register_debug_js' );

//uncomment the next line if you wish to enqueue individual js files. If you uncomment the next line you will also need to comment out
//line 35 above-> add_action( 'init', 'factorycommercegurus_register_production_js' );
//add_action( 'wp_enqueue_scripts', 'factorycommercegurus_register_debug_js' );
// load portfolio scripts only on portfolio template
function factorycommercegurus_showcase_js() {
	if ( (is_page_template( 'template-showcase-4col.php' )) || (is_page_template( 'template-showcase-4col-alt.php' )) || (is_page_template( 'template-showcase-3col.php' )) || (is_page_template( 'template-showcase-2col.php' )) ) {
		wp_enqueue_script( 'isotope', factorycommercegurus_JS . '/src/cond/isotope.pkgd.min.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'factorycommercegurus_showcasejs', factorycommercegurus_JS . '/src/cond/jquery.tfshowcase.js', array( 'jquery' ), '1.0', false );
	}
}

add_action( 'wp_enqueue_scripts', 'factorycommercegurus_showcase_js' );

/**
 * Enqueue scripts and styles
 */
function factorycommercegurus_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cg-keyboard-image-navigation', factorycommercegurus_JS . '/src/cond/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}

add_action( 'wp_enqueue_scripts', 'factorycommercegurus_scripts' );
