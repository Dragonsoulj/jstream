<?php
/**
 * Jet Stream functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jet_Stream
 */

if ( ! function_exists( 'jstream_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function jstream_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Jet Stream, use a find and replace
		 * to change 'jstream' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'jstream', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu-left' => esc_html__( 'Left Main Menu', 'jstream' ),
			'main-menu-right' => esc_html__( 'Right Main Menu', 'jstream' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'gallery',
			'caption',
		) );

	}
endif;
add_action( 'after_setup_theme', 'jstream_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jstream_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'jstream_content_width', 1110 );
}
add_action( 'after_setup_theme', 'jstream_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function jstream_scripts() {

	wp_enqueue_style( 'bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );

	wp_enqueue_style( 'font-awesome-style', 'https://use.fontawesome.com/releases/v5.1.0/css/all.css' );

	wp_enqueue_style( 'jstream-style', get_stylesheet_uri(), array( 'bootstrap-style' ) );

	wp_deregister_script( 'jquery-core' );

	wp_register_script( 'jquery-core', 'https://code.jquery.com/jquery-3.2.1.min.js', array(), '3.2.1' );

	wp_register_script( 'jquery-pre-migrate', 'https://code.jquery.com/jquery-migrate-1.4.1.min.js', array(), '1.4.1' );

	wp_deregister_script( 'jquery-migrate' );

	wp_register_script( 'jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.0.0.min.js', array( 'jquery-pre-migrate' ), '3.0.0' );

	wp_enqueue_script( 'bootstrap-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array( 'jquery' ), null, true );

	wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery', 'bootstrap-popper' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'jstream_scripts' );

function jstream_body_classes( $classes ) {
	$classes[] = 'site';

	return $classes;
}
add_filter( 'body_class', 'jstream_body_classes' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( !class_exists( 'jstream_nav_walker' ) ) :
  /**
   * Custom Navigation Walker
   *
   * @extends Walker_Nav_Menu
   */
  class jstream_nav_walker extends Walker_Nav_Menu {
		private $dropdown_ID;

		/**
		 * Starts the list before the elements are added.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			// Default class.
			$classes = array( 'dropdown-menu' );

			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @since 4.8.0
			 *
			 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$aria_labelledby = '';

			if ( isset( $this->dropdown_ID ) ) {
				$aria_labelledby = $this->dropdown_ID ? ' aria-labelledby="' . $this->dropdown_ID . '"' : '';
			}

			$output .= "{$n}{$indent}<div$class_names$aria_labelledby>{$n}";
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::end_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			unset( $this->dropdown_ID );
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			$output .= "$indent</div>{$n}";
		}

		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$output .= $indent;

			if ( 0 == $depth ) {

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;
				$classes[] = 'nav-item';

				/**
				 * Filters the arguments for a single nav menu item.
				 *
				 * @since 4.4.0
				 *
				 * @param stdClass $args  An object of wp_nav_menu() arguments.
				 * @param WP_Post  $item  Menu item data object.
				 * @param int      $depth Depth of menu item. Used for padding.
				 */
				$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

				/**
				 * Filters the CSS class(es) applied to a menu item's list item element.
				 *
				 * @since 3.0.0
				 * @since 4.1.0 The `$depth` parameter was added.
				 *
				 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
				 * @param WP_Post  $item    The current menu item.
				 * @param stdClass $args    An object of wp_nav_menu() arguments.
				 * @param int      $depth   Depth of menu item. Used for padding.
				 */
				$classes = apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth );
				if ( in_array( 'menu-item-has-children', $classes ) ) {
	        $classes[] = 'dropdown';
	        $this->dropdown_ID = 'dropdown-' . str_pad( $item->ID, 4, '0', STR_PAD_LEFT );
	      }
				$class_names = join( ' ', $classes);
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

				/**
				 * Filters the ID applied to a menu item's list item element.
				 *
				 * @since 3.0.1
				 * @since 4.1.0 The `$depth` parameter was added.
				 *
				 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
				 * @param WP_Post  $item    The current menu item.
				 * @param stdClass $args    An object of wp_nav_menu() arguments.
				 * @param int      $depth   Depth of menu item. Used for padding.
				 */
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= '<li' . $id . $class_names .'>';
			}

			$atts = array();
			if ( 0 == $depth ) {
				$atts['class'] = 'nav-link';
				if ( in_array( 'menu-item-has-children', $classes ) ) {
					$atts['class'] .= ' dropdown-toggle';
					$atts['id'] = $this->dropdown_ID;
					$atts['data-toggle'] = 'dropdown';
					$atts['aria-haspopup'] = 'true';
					$atts['aria-expanded'] = 'false';
				}
			}
			elseif ( 1 == $depth ) {
				$atts['class'] = 'dropdown-item';
			}
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title The menu item's title.
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . $title . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $item        Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::end_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Page data object. Not used.
		 * @param int      $depth  Depth of page. Not Used.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			if ( 0 == $depth ) {
				$output .= '</li>';
			}

			$output .= "{$n}";
		}

  }
endif;
