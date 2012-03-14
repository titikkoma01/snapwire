<?php
ob_start();

/* ********************
 * Add theme support for feed links, custom  
 * background, menu and post thumbnails support
 ******************************************************************** */
	add_theme_support('automatic-feed-links');
	add_theme_support( 'menus' );
	add_custom_background();
	add_theme_support('post-thumbnails');

/* ********************
 * Modify dynamic_sidebar widget function slightly to return a
 * variable and display name of widget zone to ste admin if the
 * option 'display widget map' is activated on theme control panel
 ******************************************************************** */
	function gab_dynamic_sidebar($widgetname)
	{
	  dynamic_sidebar($widgetname);  
	  if((of_get_option('of_widget', 0) == 1) and is_user_logged_in() ) { 
		echo '<span class="widgetname">'.$widgetname.'</span>'; 
	  }  
	}

/* ********************
 * Load theme shortcodes css file and include shortcodes.php file
 * only if shortcodes option is activated on theme control panel
 ******************************************************************** */
	if (of_get_option('of_shortcodes') == 1) {
		if (!is_admin()) add_action( 'wp_print_styles', 'gab_shortcodecss' );
			if (!function_exists('gab_shortcodecss')) {
				function gab_shortcodecss() {
					wp_enqueue_style('gabfire_shortcodes', GABFIRE_FUNCTIONS_PATH .'/shortcodes.css');
				}
		}
		require_once (GABFIRE_FUNCTIONS_PATH . '/shortcodes.php'); 	
	}

/* ********************
 * Some navigations displays pages and cats side by side. If there is
 * not any registered category within site, 'No Categories' string shows
 * on navigation together with pages. bm_dont_display_it function is going
 * to hide 'no categories' string incase of this scenario.
 ******************************************************************** */
	function bm_dont_display_it($dont_display) {
	  if (!empty($dont_display)) {
		$dont_display = str_ireplace('<li>' .__( "No categories" ). '</li>', "", $dont_display);
	  }
	  return $dont_display;
	}
	add_filter('wp_list_categories','bm_dont_display_it');

/* ********************
 * The site title that is displayed in header
 * between <title></title> tags
 ******************************************************************** */
	function gab_title() {
		global $page, $paged;
		if ( is_home() ) { bloginfo('name'); echo ' | '; bloginfo('description'); } 
		elseif ( is_search() ) { bloginfo('name'); echo ' | '; _e('Search Results', 'source');  }  
		elseif ( is_author() ) { bloginfo('name'); echo ' | '; _e('Author Archives', 'source');  }
		elseif ( is_page() ) {  bloginfo('name'); echo ' | '; wp_title('');  }
		elseif ( is_single() ) { wp_title(''); echo ' | '; bloginfo('name');  }
		elseif ( is_category() ) { bloginfo('name'); echo ' | '; _e('Archive', 'source'); echo ' | '; single_cat_title();  } 
		elseif ( is_month() ) { bloginfo('name'); echo ' | '; _e('Archive', 'source'); echo ' | '; the_time('F');  }	
		elseif ( is_tag() ) {  bloginfo('name'); echo ' | '; _e('Tag Archive', 'source'); echo ' | ';  single_tag_title("", true); }     
		else { wp_title(''); echo ' | '; bloginfo('name');  }	

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __('%s'), max( $paged, $page ) );	
	}

/* ********************
 * Source framework has support to display category based ads.
 * Using current_catID; we check whether a file exist with
 * current_catID.php name or not.
 ******************************************************************** */
	function current_catID() {
		global $wp_query,  $cat_obj, $currentcat;

		if (is_category()) {	
			$cat_obj = $wp_query->get_queried_object();
			$currentcat = $cat_obj->term_id;
		} 
		elseif (is_single()) {
			$category = get_the_category();
			$currentcat = $category[0]->cat_ID;
		}
		
		return $currentcat;
	}

/* ********************
 * Category based ad function.
 * Using current_catID function, we check if an ad file per cat
 * is available or not.
 ******************************************************************** */
 	function gab_categoryad($path) {
		if((is_single() or is_category()) and (file_exists(TEMPLATEPATH . '/ads/'.$path.'/'. current_catID() .'.php'))) {
			include(TEMPLATEPATH . '/ads/'.$path.'/'. current_catID() .'.php');
		} else {
			include(TEMPLATEPATH . '/ads/'.$path.'.php');
		}
	}

/* ********************
 * Limit post excerpts. Within theme files used as 
 * print string_limit_words(get_the_excerpt(), 16);
 ******************************************************************** */
	function string_limit_words($string, $word_limit) {
		$words = explode(' ', $string, ($word_limit + 1));
		if(count($words) > $word_limit)
		array_pop($words);
		return implode(' ', $words);
	}

/* ********************
 * The post meta display below post excerpts on front page
 * default usage gab_postmeta(date, comment, permalink, edit-post)
 ******************************************************************** */
	function gab_permalink() { /* We first create a function to get the post permalink with read more anchor */
		echo '<span class="meta_permalink">';
		echo '<a href="'; the_permalink(); echo '" title="'; printf( esc_attr__( 'Permalink to %s', 'source' ), the_title_attribute( 'echo=0' ) ); echo'" rel="bookmark">'; esc_attr_e('Read More', 'source'); echo '</a>';
		echo '</span>';
	}
	function gab_postcomment() { /* We first create a function to get the post permalink with read more anchor */
		echo '<span class="meta_comment">';
		comments_popup_link(__('No Comment','source'), __('1 Comment','source'), __('% Comments','source'));
		echo '</span>';
	}	
	
	function gab_postmeta($date = true,$comment = true,$permalink = true,$edit = true) {
		echo '<p class="postmeta">';
			echo (true === $date) ? '<span class="meta_date">' . get_the_date() . '</span>' : "";
			echo (true === $comment) ? gab_postcomment() : "";
			echo (true === $permalink) ?  gab_permalink() : "";
			(true === $edit) ? edit_post_link(__('#','source'),'<span class="meta_edit">','</span>') : "";
		echo '</p>';
	}

/* ********************
 * Truncate post title. 
 * default usage gab_posttitle(title length,string after title)
 ******************************************************************** */
	function gab_posttitle($t_length,$t_end) {
		global $post;
		$thetitle = $post->post_title;
		$getlength = strlen($thetitle);
		$thelength = $t_length;
		echo substr($thetitle, 0, $thelength);
		if ($getlength > $thelength) echo $t_end;
	}
	
/* ********************
 * Add Twitter and Facebook fields
 * into WordPress admin -> user field.
 ******************************************************************** */
	function add_contactmethod( $user_contactmethods ) {
	   return array_merge( $user_contactmethods, array( 'twitter' => 'Twitter Username', 'facebook' => 'Facebook URL' ) );
	}
	add_filter( 'user_contactmethods', 'add_contactmethod' );

/* ********************
 * Category pagination function. The original function can be found on Kriesi's site at
 * http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 ******************************************************************** */
	function pagination($pages = "", $range = 2)
	{
		 $showitems = ($range * 2)+1; 
		 global $paged;
		 if(empty($paged)) $paged = 1;
	 
		 if($pages == "")
		 {
			 global $wp_query;
			 $pages = $wp_query->max_num_pages;
			 if(!$pages)
			 {
				 $pages = 1;
			 }
		 }  
	 
		 if(1 != $pages)
		 {
			 echo '<div class="numbered-pagination"><span>'; _e('Page','source'); echo ' ' . $paged . ' '; _e('of','source'); echo ' ' . $pages.'</span>';
			 if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
				echo '<a class="pagi-first" href="'.get_pagenum_link(1).'">&laquo; '; _e('First', 'source'); echo '</a>';
			}
			 if($paged > 1 && $showitems < $pages) {
				echo '<a class="pagi-prev" href="'.get_pagenum_link($paged - 1).'">&lsaquo; '; _e('Previous', 'source'); echo '</a>';
			}
	 
			 for ($i=1; $i <= $pages; $i++)
			 {
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				 {
					 echo ($paged == $i)? '<span class=\'current\'>'.$i.'</span>':'<a href="'.get_pagenum_link($i).'" class=\'inactive\'>'.$i.'</a>';
				 }
			 }
	 
			 if ($paged < $pages && $showitems < $pages) { 
				echo '<a class="pagi-next" href=\''.get_pagenum_link($paged + 1).'\'>'; _e('Next', 'source'); echo ' &rsaquo;</a>'; 
			}
			 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
				echo '<a class="pagi-last" href="'.get_pagenum_link($pages).'">'; _e('Last', 'source'); echo ' &raquo;</a>'; 
			}
			 echo '<div class="clear"></div></div>';
		 }
	}

/* ********************
 * Create a user login form and set a function to display that login/signup
 * box using a lightbox plugin within GabfireThemes
 ******************************************************************** */
	function register_loginform() { ?>
		<div class="hide">
			<div id="register-login">
				<div class="col left">
					<div class="title">
						<h3><?php _e('Register an Account','source'); ?><span><?php _e('Sign Up and Contribute!','source'); ?></span></h3>
					</div>
					
					<!-- Register Form -->
					<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" id="registerform" name="registerform">
						<p>
							<label><?php _e('Username','source'); ?><br />
							<input type="text" tabindex="10" size="20" value="" class="input" id="user_login_left" name="user_login" />
							</label>
						</p>
						<p>
							<label><?php _e('E-mail','source'); ?><br />
							<input type="text" tabindex="20" size="25" value="" class="input" id="user_email" name="user_email" />
							</label>
						</p>
						
						<p id="reg_passmail"><?php _e('A password will be e-mailed to you.','source'); ?></p>

						<p class="submit">
							<?php do_action('login_form', 'register'); ?>
							<input type="submit" tabindex="100" value="Register" class="button-primary" id="wp-submit_form" name="wp-submit" />
							<input type="hidden" name="redirect_to" value="<?php bloginfo('url'); ?>/wp-admin/profile.php" />
							<input type="hidden" name="cookie" value="1" />
						</p>
					</form>
				</div>
				
				<div class="col right">
					<div class="title">
						<h3><?php _e('Have an Account?','source'); ?><span><?php _e('Login Using This Form','source'); ?></span></h3>
					</div>

					<?php 
					$args = array(
					'redirect' => get_bloginfo('url').'/wp-admin/profile.php', 
					'value_username' => NULL,
					'value_remember' => false 
					); 				
					
					wp_login_form($args);
					?>
				</div>  
			</div>	
		</div>
	<?php }

	function gab_userlogin() {
		if (is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();
				_e('Welcome','source');
				if($current_user->user_firstname) {
					echo ' ' . $current_user->user_firstname . '!' . "\n";
				} else {
				echo ' ' . $current_user->user_login . '! - ' . "\n";
				}
			wp_loginout(); 
		} else { 
			echo '<a class="show register-button" href="#register-login">';
			_e('Contribute', 'source');
			echo '</a>';
			
			register_loginform();
		}
	}

/* ********************
 * Adding the Open Graph in the Language Attributes
 * box using a lightbox plugin within GabfireThemes
 ******************************************************************** */
if (of_get_option('of_fbonhead', 0) == 1) {
	function add_opengraph_dtype( $output ) {
			return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
		}
	add_filter('language_attributes', 'add_opengraph_dtype');

	//Lets add Open Graph Meta Info
	function facebookmeta_head() {
		global $post;
		if ( !is_singular()) //if it is not a post or a page
			return;
			echo '<meta property="og:description" content="' . get_the_excerpt() . '"/>';
			echo '<meta property="og:title" content="' . get_the_title() . '"/>';
			echo '<meta property="og:type" content="article"/>';
			echo '<meta property="og:url" content="' . get_permalink() . '"/>';
			echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>';
			
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
			echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		echo "\n";
	}
	add_action( 'wp_head', 'facebookmeta_head', 5 );
}

/* ********************
 * Innerpage Slider
 * single postpage slider that auto grabs all attached pictures
 * and displays them with a nice slider
 ******************************************************************** */
 function gab_innerslider() {
	global $post, $page;
	if (of_get_option('of_inslider') == 2) {
		require_once (GABFIRE_INC_PATH . '/theme-gallery.php');
	} 
	elseif (
			( of_get_option('of_inslider') == 1) and (has_tag(of_get_option('of_inslider_tag')) ) 
		or 
			(  has_term( of_get_option('of_inslider_tag') , 'gallery-tag', '' )) ) 
	{
		require_once (GABFIRE_INC_PATH . '/theme-gallery.php');
	}
} 