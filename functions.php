<?php 

/* Insert to DB */
require get_template_directory() . '/inc/kcn_DB_Helper.php';

/* Display data in CMS */
require get_template_directory() . '/inc/kcn_backend_Helper.php';


function kcn_login_styles() {
    wp_enqueue_style('login-css', get_stylesheet_directory_uri() . '/login/login.css', false);
}

add_action('login_enqueue_scripts',  'kcn_login_styles');

function kcn_login_url() {
    return home_url();
} 

add_filter('login_headerurl', 'kcn_login_url');


function kcn_login_title() {
    return get_option('blogname');
} 

add_filter('login_headertitle', 'kcn_login_title');



function kcn_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_post_type_support( 'page', 'excerpt' );	
}
add_action( 'after_setup_theme', 'kcn_theme_setup');

//enqueue style and script

 function kcn_theme_load_styles_scripts() {

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');	
 	wp_register_style( 'style', get_template_directory_uri() . '/style.css'  , array(), filemtime( get_template_directory().'/style.css' ));
 	wp_register_style( 'owl', get_template_directory_uri() . '/css/owl.carousel.css');

 	wp_register_style('googlefonts', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=vietnamese', array(), '1.0.0');
 	
 	wp_enqueue_style('bootstrap');
 	wp_enqueue_style('style');
 	wp_enqueue_style('owl');
 	wp_enqueue_style('googlefonts');


    wp_register_style('date_js', get_template_directory_uri() . '/css/bootstrap-datetimepicker.min.css');   
    wp_enqueue_style('date_js');

 	// 	//add js
    wp_enqueue_script('jquery');

 	wp_register_script('bs_scripts',  get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
 	wp_enqueue_script('bs_scripts');

 	wp_register_script( 'owl_scripts',  get_template_directory_uri() . '/js/owl.carousel.js', array(), '1.0.0', true );
 	wp_enqueue_script('owl_scripts');


    wp_register_script( 'date_scripts',  get_template_directory_uri() . '/js/bootstrap-datetimepicker.min.js', array(), '1.0.0', true );
    wp_enqueue_script('date_scripts');


    wp_register_script( 'init_scripts',  get_template_directory_uri() . '/js/init.js', array(), '1.0.0', true );
    wp_enqueue_script('init_scripts');

    wp_localize_script(
        'init_scripts',
        'admin_ajax',
        array('ajaxurl' => admin_url('admin-ajax.php'))        
    );

 	
}


if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}



add_action( 'wp_enqueue_scripts' ,'kcn_theme_load_styles_scripts');

/*
function kcn_admin_scripts() {

    wp_enqueue_script('adminjs', get_template_directory_uri() . '/js/admin_ajax.js', array('jquery'), 1.0, true);

    wp_localize_script(
        'adminjs' ,
        'admin_ajax',
        array('ajaxurl' => admin_url('admin-ajax.php'))
    ); 
} */

//add_action('admin_enqueue_scripts' , 'kcn_admin_scripts') ;

// define menu
/*function kcn_theme_menu() {
	register_nav_menus(array(
       'header-menu' => __('Header menu', 'kcn') ,
       'social-menu' => __('Social menu', 'kcn') 
	));
} */

//add_action( 'init', 'kcn_theme_menu' );
remove_filter('the_content','wpautop');
//add_filter('the_content', 'nl2br');
add_image_size('product_photo', 585, 324, true); // Custom Thumbnail Size call using 
add_image_size('product_thumb_photo', 166, 92, true); // Custom Thumbnail Size call using 

add_image_size('hot_news_thumb', 270, 154, true); // Custom Thumbnail Size call using 

function vtp_function_admin_bar($content) {
    return (current_user_can('administrator')) ? $content : false ;
}

add_filter('show_admin_bar', 'vtp_function_admin_bar');


// remove personal options block
if( is_admin() ){
    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
   // add_action( 'personal_options', 'prefix_hide_personal_options' );
} 

add_action('show_user_profile', 'prefix_hide_personal_options' );


function kcn_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'sharktanks' == $screen->post_type ) {
          $title = 'Nhập mã số cho dự án gọi vốn này';
     } else if ( 'products' == $screen->post_type ) {
         $title = 'Nhập mã sản phẩm';
     }
  
     return $title;
}
  
add_filter( 'enter_title_here', 'kcn_change_title_text' );


function kcn_login_function() {
    add_filter( 'gettext', 'username_change', 20, 3 );
    function username_change( $translated_text, $text, $domain ) 
    {
  
        if ($text === 'Username or Email Address') 
        {
            $translated_text = 'Nhập số điện thoại hoặc email';
        }
        return $translated_text;
    }

}
add_action( 'login_head', 'kcn_login_function' );


add_action( 'login_head', 'hide_login_nav' );

function hide_login_nav()
{
    ?><style>#nav,#backtoblog{display:none}</style><?php
}




function prefix_hide_personal_options() {
  ?>
	
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ){
		
            jQuery("h2:contains('Tuỳ chọn cá nhân')").next('.form-table').remove();
            jQuery("h2:contains('Tuỳ chọn cá nhân')").remove();
            jQuery("h2:contains('Tự bạch')").next('.form-table').remove();
            jQuery("h2:contains('Tự bạch')").remove();

			jQuery("h2:contains('Quản lý tài khoản')").next('.form-table').remove();
            jQuery("h2:contains('Quản lý tài khoản')").remove();

			jQuery("h3:contains('User Login History')").next('.form-table').remove();
            jQuery("h3:contains('User Login History')").remove();


			jQuery("h3:contains('Activate User')").next('.form-table').remove();
            jQuery("h3:contains('Activate User')").remove();
			jQuery("h2:contains('Tên')").remove();
			jQuery('.faulh-form-table').remove();
			jQuery('.user-url-wrap').remove();
			jQuery("h2:contains('Thông tin liên hệ')").remove();
			
			
       
       

        } );
    </script>

  <?php
}

function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
		$current_page = max(1, get_query_var('paged'));
	

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
			'current' => $current_page,
			'type' => 'list', 
            'total' => $total_pages,
            'prev_text'          => __(''),
			'next_text'          => __(''),
			'after_page_number' => '<li>|</li>',
        ));
    }
}



function kcn_sanitize_image( $input ){
 
    /* default output */
    $output = '';
 
    /* check file type */
    $filetype = wp_check_filetype( $input );
    $mime_type = $filetype['type'];
 
    /* only mime type "image" allowed */
    if ( strpos( $mime_type, 'image' ) !== false ){
        $output = $input;
    }
 
    return $output;
}


/**
 * Redirect non-admins to the homepage after logging into the site.
 *
 * @since   1.0
 */
function kcn_login_redirect( $redirect_to, $request, $user  ) {
  return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? admin_url() : site_url();
}
add_filter( 'login_redirect', 'kcn_login_redirect', 10, 3 );

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'theme-slug' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
    ) );
}



function pippin_change_password_form() {
	global $post;	
 
   	if (is_singular()) :
   		$current_url = get_permalink($post->ID);
   	else :
   		$pageURL = 'http';
   		if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
   		$pageURL .= "://";
   		if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   		else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
   		$current_url = $pageURL;
   	endif;		
	$redirect = $current_url;
 
	ob_start();
 
		// show any error messages after form submission
		pippin_show_error_messages(); ?>
 
		<?php if(isset($_GET['password-reset']) && $_GET['password-reset'] == 'true') { ?>
			<div class="pippin_message success">
				<span><?php _e('Mật khẩu thay đổi thành công', 'rcp'); ?></span>
			</div>
		<?php } ?>
		<form id="pippin_password_form" method="POST" action="<?php echo $current_url; ?>">
			<fieldset>
				<p>
					<label for="pippin_user_pass"><?php _e('Mật khẩu mới', 'rcp'); ?></label>
					<input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
				</p>
				<p>
					<label for="pippin_user_pass_confirm"><?php _e('Xác nhận lại', 'rcp'); ?></label>
					<input name="pippin_user_pass_confirm" id="pippin_user_pass_confirm" class="required" type="password"/>
				</p>
				<p>
					<input type="hidden" name="pippin_action" value="reset-password"/>
					<input type="hidden" name="pippin_redirect" value="<?php echo $redirect; ?>"/>
					<input type="hidden" name="pippin_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>"/>
					<input id="pippin_password_submit" type="submit" value="<?php _e('Xác nhận', 'pippin'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();	
}
 
// password reset form
function pippin_reset_password_form() {
	if(is_user_logged_in()) {
		return pippin_change_password_form();
	}
}
add_shortcode('password_form', 'pippin_reset_password_form');
 
 
function pippin_reset_password() {
	// reset a users password
	if(isset($_POST['pippin_action']) && $_POST['pippin_action'] == 'reset-password') {
 
		global $user_ID;
 
		if(!is_user_logged_in())
			return;
 
		if(wp_verify_nonce($_POST['pippin_password_nonce'], 'rcp-password-nonce')) {
 
			if($_POST['pippin_user_pass'] == '' || $_POST['pippin_user_pass_confirm'] == '') {
				// password(s) field empty
				pippin_errors()->add('password_empty', __('Vui lòng nhập mật khẩu và xác nhận', 'pippin'));
			}
			if($_POST['pippin_user_pass'] != $_POST['pippin_user_pass_confirm']) {
				// passwords do not match
				pippin_errors()->add('password_mismatch', __('Mật khẩu không khớp', 'pippin'));
			}
 
			// retrieve all error messages, if any
			$errors = pippin_errors()->get_error_messages();
 
			if(empty($errors)) {
				// change the password here
				$user_data = array(
					'ID' => $user_ID,
					'user_pass' => $_POST['pippin_user_pass']
				);
				wp_update_user($user_data);
				// send password change email here (if WP doesn't)
				wp_redirect(add_query_arg('password-reset', 'true', $_POST['pippin_redirect']));
				exit;
			}
		}
	}	
}
add_action('init', 'pippin_reset_password');
 
if(!function_exists('pippin_show_error_messages')) {
	// displays error messages from form submissions
	function pippin_show_error_messages() {
		if($codes = pippin_errors()->get_error_codes()) {
			echo '<div class="pippin_message error">';
			    // Loop error codes and display errors
			   foreach($codes as $code){
			        $message = pippin_errors()->get_error_message($code);
			        echo '<span class="pippin_error"><strong>' . __('Lỗi', 'rcp') . '</strong>: ' . $message . '</span><br/>';
			    }
			echo '</div>';
		}	
	}
}
 
if(!function_exists('pippin_errors')) { 
	// used for tracking error messages
	function pippin_errors(){
	    static $wp_error; // Will hold global variable safely
	    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
	}
}

?>