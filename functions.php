<?php

/**
 * DZPLive functions and definitions
 *
 */
/*** Register Events **/
function wpse_setup_theme() {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'custom-post-thumb', 460, 300 );
 }
 
 add_action( 'after_setup_theme', 'wpse_setup_theme' );

/*** REGISTER GOOGLE MAPS API **/
function my_acf_init()
{
	acf_update_setting('google_api_key', 'AIzaSyA_-lfeuExwjZu6NPV4jAHTENS-TFTI_jk');
}
add_action('acf/init', 'my_acf_init');
add_action('init', 'codex_event_init');
function codex_event_init()
{
	$labels = array(
		'name'               => _x('Events', 'Event', 'Event'),
		'singular_name'      => _x('Event', 'Event', 'Event'),
		'menu_name'          => _x('Events', 'admin menu', 'Event'),
		'name_admin_bar'     => _x('Events', 'add new on admin bar', 'Event'),
		'add_new'            => _x('Add New Events', 'Event', 'Event'),
		'add_new_item'       => __('Add Event', 'Event'),
		'new_item'           => __('New Event', 'Event'),
		'edit_item'          => __('Edit Event', 'Event'),
		'view_item'          => __('View Event', 'Event'),
		'all_items'          => __('All Events', 'Event'),
		'search_items'       => __('Search Events', 'Event'),
		'parent_item_colon'  => __('Parent Events:', 'Event'),
		'not_found'          => __('No Events found.', 'Event'),
		'not_found_in_trash' => __('No Events found in Trash.', 'Event')
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __('Description.', 'Events'),
		'public'             => true,
		'publicly_queryable' => true,
		'Show_ui'            => true,
		'taxonomies'  => array('venues', 'organizers', 'category'),
		'Show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'event', 'with_front'    => false),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'revisions', 'author', 'thumbnail', 'excerpt', 'comments')
	);
	register_post_type('event', $args);
}
add_action('init', 'codex_podcast_init');

/*** Register Podcasts **/
function codex_podcast_init()
{
	$labels = array(
		'name'               => _x('Podcasts', 'podcast', 'podcast'),
		'singular_name'      => _x('Podcast', 'podcast', 'podcast'),
		'menu_name'          => _x('Podcasts', 'admin menu', 'podcast'),
		'name_admin_bar'     => _x('Podcasts', 'add new on admin bar', 'podcast'),
		'add_new'            => _x('Add New podcasts', 'podcast', 'podcast'),
		'add_new_item'       => __('Add podcast', 'podcast'),
		'new_item'           => __('New podcast', 'podcast'),
		'edit_item'          => __('Edit podcast', 'podcast'),
		'view_item'          => __('View podcast', 'podcast'),
		'all_items'          => __('All podcasts', 'podcast'),
		'search_items'       => __('Search podcasts', 'podcast'),
		'parent_item_colon'  => __('Parent podcasts:', 'podcast'),
		'not_found'          => __('No podcasts found.', 'podcast'),
		'not_found_in_trash' => __('No podcasts found in Trash.', 'podcast')
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __('Description.', 'podcasts'),
		'public'             => true,
		'publicly_queryable' => true,
		'Show_ui'            => true,
		'taxonomies'  => array('category'),
		'Show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'podcast', 'with_front'    => false),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'revisions', 'author', 'thumbnail', 'excerpt', 'comments')
	);
	register_post_type('podcast', $args);
}

/*** Register venues **/
add_action('init', 'create_venue_taxonomies', 0);
function create_venue_taxonomies()
{
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x('Venue', 'Venue', 'venue'),
		'singular_name'     => _x('Venue', 'Venue', 'venue'),
		'search_items'      => __('Search Venues', 'venue'),
		'all_items'         => __('All Venues', 'venue'),
		'edit_item'         => __('Edit Venue', 'venue'),
		'update_item'       => __('Update Venue', 'venue'),
		'add_new_item'      => __('Add New Venue', 'venue'),
		'new_item_name'     => __('New Venue', 'venue'),
		'menu_name'         => __('Venues', 'venue'),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'Show_ui'           => true,
		'Show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'venues'),
	);
	register_taxonomy('venues', array('venues'), $args);
}


/*** Register the Theme Navigation Menus ***/
function register_menus()
{
	register_nav_menu('main-menu', 'Primary Menu');
	register_nav_menu('user-menu', 'User Bar');
}
add_action('init', 'register_menus');
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_author()) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif (is_tax()) { //for custom post types
		$title = sprintf(__('%1$s'), single_term_title('', false));
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});
/*** Load More Posts ***/
function more_post_ajax()
{
	$ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;
	$page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	$offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
	$today = current_time('Y-m-d H:i:s');
	header("Content-Type: text/html");
	$args = array(
		'suppress_filters' => true,
		'posts_per_page' => $ppp,
		'paged'    => $page,
		'post_type'  => 'event',
		'post_status' => 'publish',
		'offset' => $offset,
		'meta_query' => array(
			array(
				'key'       => 'event_date_start_date',
				'value'     => $today,
				'compare'   => '>=',
				'type'      => 'DATE',
			),
		),
		'orderby'                => 'meta_value',
		'order'                  => 'ASC',
	);
	$loop = new WP_Query($args);
	$out = '';
	if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
			$out .= get_template_part('partials/event', 'grid-nolazy');
		endwhile;
	endif;
	wp_reset_postdata();
	die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');



//Custom Pagination
function custom_pagination($numpages = '', $pagerange = '', $paged = '')
{
	if (empty($pagerange)) {
		$pagerange = 1;
	}
	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}
	if ($numpages == '') {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if (!$numpages) {
			$numpages = 1;
		}
	}
	$pagination_args = array(
		'base'            => add_query_arg('paged', '%#%'),
		'format'          => '/page/%#%',
		'total'           => $numpages,
		'current'         => $paged,
		'Show_all'        => False,
		'end_size'        => 1,
		'mid_size'        => $pagerange,
		'prev_next'       => True,
		'prev_text'       => __('<<'),
		'next_text'       => __('>>'),
		'type'            => 'plain',
		'add_args'        => false,
		'add_fragment'    => ''
	);
	$paginate_links = paginate_links($pagination_args);
	if ($paginate_links) {
		echo "<nav class='custom-pagination'>";
		echo $paginate_links;
		echo "</nav>";
	}
}
/** Woocommerce functions */
add_filter('woocommerce_add_to_cart_fragments', 'add_to_cart_fragment');

function add_to_cart_fragment($fragments)
{
	global $woocommerce;
	$fragments['.misha-cart'] = '(' . $woocommerce->cart->cart_contents_count . ')';
	return $fragments;
}
/**
 * Change number of related products output
 */
function woo_related_products_limit()
{
	global $product;

	$args['posts_per_page'] = 6;
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'jk_related_products_args', 20);
function jk_related_products_args($args)
{
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 1; // arranged in 2 columns
	return $args;
}
/* Creating the widget */
class simplecast_widget extends WP_Widget
{

	function __construct()
	{
		parent::__construct(

			// Base ID of your widget
			'simplecast_widget',

			// Widget name will appear in UI
			__('Simplecast Widget', 'simplecast_widget_domain'),

			// Widget description
			array('description' => __('Simplecast Widget', 'simplecast_widget_domain'),)
		);
	}

	// Creating widget front-end

	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if (!empty($title))
			echo '<iframe src="' . $title . '" width="100%" height="200px" frameborder="no" scrolling="no" seamless=""></iframe>';
		// This is where you run the code and display the output
		echo $args['after_widget'];
	}

	// Widget Backend 
	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('Simplecast Link', 'simplecast_widget_domain');
		}
		// Widget admin form
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
	<?php
	}

	// Updating widget replacing old instances with new
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}

	// Class simplecast_widget ends here
}


// Register and load the widget
function load_simplecast_widget()
{
	register_widget('simplecast_widget');
}
add_action('widgets_init', 'load_simplecast_widget');

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more)
{
	global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function wc_refresh_mini_cart_count($fragments)
{
	ob_start();
	?>
	<div id="mini-cart-count">
		<?php
		$count = WC()->cart->get_cart_contents_count();
		if ($count == 0) {
			'0 Items';
		} elseif ($count == 1) {
			echo WC()->cart->get_cart_contents_count() . ' item';
		} else {
			echo WC()->cart->get_cart_contents_count() . ' items';
		}; ?>
	</div>
<?php
	$fragments['#mini-cart-count'] = ob_get_clean();
	return $fragments;
};
add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');

wp_register_script('aa_js_googlemaps_script',  'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA_-lfeuExwjZu6NPV4jAHTENS-TFTI_jk'); // with Google Maps API fix
function theme_enqueue_styles()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('aa_js_googlemaps_script');
	wp_enqueue_script('vendor-js', get_template_directory_uri() . '/dist/main.js', array(), '1.0.0', false);
	wp_localize_script('vendor-js', 'ajax_posts', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
	));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
