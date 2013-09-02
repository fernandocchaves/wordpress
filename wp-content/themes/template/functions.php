<?php
/*
 *  Author: Fernando Cezar Chaves | fernandocchaves@gmail.com
 *  URL: http://fernandocchaves.com.br
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/


  function alter_admin_bar( $admin_bar ) {

    $admin_bar->remove_menu( 'wp-logo' );// Remove wp-logo
    $admin_bar->remove_node( 'new-content' );// Remove menu suspend
    $admin_bar->remove_menu( 'edit' );// Remove edit link
    $admin_bar->remove_menu( 'updates' );// Remove update notify
    $admin_bar->remove_menu( 'search' );// Remove search menu
    $admin_bar->remove_menu( 'comments' );// Remove comments menu
    //$admin_bar->remove_node( 'site-name' );// Remove site name
    //$admin_bar->remove_node( 'my-account' );// Remove my account menu

    return $admin_bar;
  }

  function my_remove_menu_pages() {
    //remove_menu_page( 'edit.php' );               //posts
    remove_menu_page( 'edit-comments.php' );      //comments
    remove_menu_page('upload.php');               //midia
    remove_menu_page('link-manager.php');         //links
    //remove_menu_page('edit.php?post_type=page');  //pages
    //remove_menu_page('themes.php');               //apearence
    remove_menu_page('plugins.php');              //plugins
    remove_menu_page('tools.php');                //tools
    #remove_menu_page('options-general.php');      //configs

    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); //remove taxonomy category
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); //remove taxonomy tags
  }

  //remove menu screen options
  function remove_screen_options(){
    return false;
  }

  //text footer admin
  function remove_footer_admin () {
    echo 'Implementado por <a href="http://gobek.com.br/" target="_blank">Gobek</a>';
  }

  //alter logo login admin
  function my_logo_login()
  {
      echo '<style  type="text/css"> h1 a {  background-image:url('.get_bloginfo('template_directory').'/webroot/images/admin/logo-login.png)  !important; } </style>';
  }

  //config dashboard
  function so_screen_layout_columns( $columns ) {
      $columns['dashboard'] = 1;
      return $columns;
  }

  function so_screen_layout_dashboard() {
      return 1;
  }

  function del_secoes_painel(){
    global$wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
  }

if (!isset($content_width))
{
    $content_width = 900;
}


if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('image-thumbnail', 274, 160, true);


    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('fc', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function fc_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function fc_header_scripts()
{
    if (!is_admin()) {

    	wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
    }
}

// Load HTML5 Blank scripts (footer.php)
function fc_footer_scripts()
{
    if (!is_admin()) {

        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array(), '1.9.1'); // Google CDN jQuery
        wp_enqueue_script('jquery'); // Enqueue it!

        wp_register_script('conditionizr', 'http://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('chosen', get_template_directory_uri() . '/webroot/js/chosen.jquery.min.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('chosen'); // Enqueue it!

        wp_register_script('fancybox', get_template_directory_uri() . '/webroot/plugins/fancybox/jquery.fancybox.min.js', array(), '2.1.5'); // Custom scripts
        wp_enqueue_script('fancybox'); // Enqueue it!

        wp_register_script('icheck', get_template_directory_uri() . '/webroot/plugins/icheck/jquery.icheck.min.js', array(), '0.9.1'); // Custom scripts
        wp_enqueue_script('icheck'); // Enqueue it!

        wp_register_script('plugins', get_template_directory_uri() . '/webroot/js/plugins.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('plugins'); // Enqueue it!

        wp_register_script('fcscripts', get_template_directory_uri() . '/webroot/js/scripts.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('fcscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function fc_conditional_scripts()
{
    if (is_page('fale-conosco')) {
        wp_register_script('maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '3.exp'); // Conditional script(s)
        wp_enqueue_script('maps'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function fc_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/webroot/css/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!


    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('style'); // Enqueue it!


    wp_register_style('chosen', get_template_directory_uri() . '/webroot/css/chosen.css', array(), '1.0', 'all');
    wp_enqueue_style('chosen'); // Enqueue it!

    wp_register_style('fancybox', get_template_directory_uri() . '/webroot/plugins/fancybox/jquery.fancybox.css', array(), '2.1.5', 'all');
    wp_enqueue_style('fancybox'); // Enqueue it!

    wp_register_style('icheck', get_template_directory_uri() . '/webroot/plugins/icheck/skins/all.css', array(), '0.9.1', 'all');
    wp_enqueue_style('icheck'); // Enqueue it!
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'fc'),
        'description' => __('Description for this widget-area...', 'fc'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'fc'),
        'description' => __('Description for this widget-area...', 'fc'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'fc') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function fcgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function fccomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'fc_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_footer', 'fc_footer_scripts');
add_action('wp_print_scripts', 'fc_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'fc_styles'); // Add Theme Stylesheet
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action( 'admin_menu', 'my_remove_menu_pages' );
add_action( 'admin_bar_menu', 'alter_admin_bar', 99 );
add_action('login_head',  'my_logo_login');
add_action('wp_dashboard_setup', 'del_secoes_painel');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'fcgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('screen_options_show_screen', 'remove_screen_options');
add_filter('admin_footer_text', 'remove_footer_admin');
add_filter( 'get_user_option_screen_layout_dashboard', 'so_screen_layout_dashboard' );
add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

//remove alerta de atualizações
if ( !current_user_can( 'edit_users' ) ) {
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}
/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_post_type( 'cliente', //nome do post type (sempre minusculo)
        array(
            'labels' => array(
                'name' => __( 'Cliente' ), //nome que ira aparecer na tela
                'singular_name' => __( 'Clientes' ), //esse eu nao sei pra que serve ... :)
                'all_items' => __('Listar Todos'), // listar todos menu
            ),
            'public' => true, //nao altera
            'supports' => array('title','editor','thumbnail') //oque ira aparecer nos posts mais usados sao estes
        )
    );

    register_taxonomy( 'categoria-cliente', //Nome da categoria
        array( 'cliente' ), //post type de referencia
        array(
          'hierarchical' => true, //padrao
          'label' => __( 'Categoria' ), //Nome que aparecera no menu 
          'show_ui' => true, //padrao
          'show_in_tag_cloud' => true, //padrao
          'query_var' => true, //padrao
          'rewrite' => array(
             'slug' => 'categoria-cliente' //slug (nome de referencia) da categoria
            ),
        )
    );
}

  //Adicionando Campos Personalizados
  add_action( 'add_meta_boxes', 'adicionais_add_meta_box' );

  function adicionais_add_meta_box() {
    add_meta_box(
        'video_metaboxid', //ID para insercao da caixa com os campos
        'Youtube', //titulo que aparecera para a caixa
        'video_inner_meta_box', //funcao a ser executada (onde estara o formulario com os campos)
        'cliente' //post type de referencia
    );
    add_meta_box(
        'video_metaboxid', //ID para insercao da caixa com os campos
        'Youtube', //titulo que aparecera para a caixa
        'video_inner_meta_box', //funcao a ser executada (onde estara o formulario com os campos)
        'page' //post type de referencia
    );
  }

  //funcao com os campos personalizados
  function video_inner_meta_box($post){
  ?>
    <p>
      <label for="video">Link Youtube</label> 
      <input style="width: 100%;"  type="text" name="video" value="<?php echo get_post_meta( $post->ID, '_video', true ); ?>" />
    </p>

  <?php
  }

  //salva os dados personalizados
  add_action( 'save_post', 'meus_campos_save_post', 10, 2 );
  function meus_campos_save_post( $post_id, $post ) {
    if(isset($_POST['video'])){
      update_post_meta( $post_id, '_video', strip_tags( $_POST['video'] ) );
    }
  }

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/


/*------------------------------------*\
    Custom Functions
\*------------------------------------*/

function getYoutubeId($href){
    $url = parse_url($href);
    $query = array();
    parse_str($url['query'], $query);
    return $query['v'];
}

function getYoutubeThumbnail($href){
    $url = parse_url($href);
    $query = array();
    parse_str($url['query'], $query);
    return 'https://i1.ytimg.com/vi/'.$query['v'].'/sddefault.jpg';
}

function attachmentUrl($attachment_id, $size){
    $image = wp_get_attachment_image_src( $attachment_id, $size);
    return $image[0];
}

?>
