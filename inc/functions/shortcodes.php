<?php
function related_posts_shortcode( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<div class="widget"><ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>' . __('No related posts found', 'source') .  '</li>';
		}
		$retval .= '</ul></div>';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'related_posts_shortcode');


// [quote]Some text[/quote] 
function quote($atts, $content = null) {
	extract(shortcode_atts(array(
		'align' => '',
		'by' => ''
	), $atts));
	$content = '<blockquote class="quote" style="float: '.$align.'"><p>'.$content;
	if($by!='') $content .= '</p><cite>&#126; '.$by.'</cite>';
	$content .= '</blockquote>';
	return $content;
}
add_shortcode( 'quote', 'quote' );


// [hr] 
function hr($atts, $content = null) {
	extract(shortcode_atts(array(
		'width' => ''
	), $atts));
	return '<div class="hr" style="width:'.$width.'"><hr /></div>';
}
add_shortcode( 'hr', 'hr' );


// access capability
function access_check( $attr, $content = null ) {
    extract( shortcode_atts( array( 'capability' => 'read' ), $attr ) );
    if ( current_user_can( $capability ) && !is_null( $content ) && !is_feed() )
        return $content;

    return;
}

add_shortcode( 'access', 'access_check' );

// latest image [postimage]
function postimage($atts, $content = null) {
	extract(shortcode_atts(array(
		"size" => 'thumbnail',
		"align" => 'none'
	), $atts));
	$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() );
	foreach( $images as $imageID => $imagePost )
	$fullimage = wp_get_attachment_image($imageID, $size, false);
	$imagedata = wp_get_attachment_image_src($imageID, $size, false);
	$width = ($imagedata[1]+2);
	$height = ($imagedata[2]+2);
	return '<div class="postimage" style="margin: 0 5px; width: '.$width.'px; height: '.$height.'px; float: '.$align.';">'.$fullimage.'</div>';
}
add_shortcode("postimage", "postimage");

// successbox  [success] text [/success]
function successbox($atts, $content=null, $code="") {
	$return = '<div class="success">';
	$return .= $content;
	$return .= '</div>';
	return $return;
}
add_shortcode('success' , 'successbox' );

//Notice [notice] text [/notice]
function noticebox( $atts, $content = null ) {
   return '<div class="notice">' . do_shortcode($content) . '</div>';
}
add_shortcode('notice', 'noticebox');

//Warning [error] text [/error],
function errorbox( $atts, $content = null ) {
   return '<div class="error">' . do_shortcode($content) . '</div>';
}
add_shortcode('error', 'errorbox');

//Info [info] text [/info],
function infobox( $atts, $content = null ) {
   return '<div class="info">' . do_shortcode($content) . '</div>';
}
add_shortcode('info', 'infobox');

//Alert [alert] text [/alert],
function alertbox( $atts, $content = null ) {
   return '<div class="alert">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert', 'alertbox');

//Green [green] text [/green]
function greenbox( $atts, $content = null ) {
   return '<div class="green">' . do_shortcode($content) . '</div>';
}
add_shortcode('green', 'greenbox');

//Blue [blue] text [/blue]
function bluebox( $atts, $content = null ) {
   return '<div class="blue">' . do_shortcode($content) . '</div>';
}
add_shortcode('blue', 'bluebox');

//Highlight [highlight] text [/highlight]
function highlightbox( $atts, $content = null ) {
   return '<span class="highlight">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight', 'highlightbox');

// events
function event($atts, $content=null, $code="") {
	extract(shortcode_atts(array(
		"value" => '',
		"tag" => 'none',
		"img" => 'none'
	), $atts));
	$return = '<div class="event">';
	if($value!='none') $return .= '<h4>'.$value.'</h4>';
	if($tag!='none') $return .= '<strong>'.$tag.'</strong>';
	if($img!='none') $return .= '<img src="'.$img.'" />';
	$return .= '</div>';
	return $return;
}
add_shortcode('event' , 'event' );

// Callouts
function dn_callout( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'width' => '',
		'align' => ''
    ), $atts));
	$style;
	if ($width || $align) {
	 $style .= 'style="';
	 if ($width) $style .= 'width:'.$width.'px;';
	 if ($align == 'left' || 'right') $style .= 'float:'.$align.';';
	 if ($align == 'center') $style .= 'margin:0px auto;';
	 $style .= '"';
	}
   return '<div class="cta" '.$style.'>' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('callout', 'dn_callout');

// Buttons
function dn_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'size' => 'medium',
		'color' => '',
		'target' => '_self',
		'caption' => '',
		'align' => 'right'
    ), $atts));	
	$button;
	$button .= '<div class="button '.$size.' '. $align.'">';
	$button .= '<a target="'.$target.'" class="button '.$color.'" href="'.$link.'">';
	$button .= $content;
	if ($caption != '') {
	$button .= '<br /><span class="btn_caption">'.$caption.'</span>';
	};
	$button .= '</a></div>';
	return $button;
}
add_shortcode('button', 'dn_button');

// Tabs
add_shortcode( 'tabgroup', 'st_tabgroup' );
function st_tabgroup( $atts, $content ){
	$GLOBALS['tab_count'] = 0;
	do_shortcode( $content );
	if( is_array( $GLOBALS['tabs'] ) ){
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
			$panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
		}
		$return = "\n".'<!-- the tabs --><ul class="sc_tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "sc_panes" --><ul class="sc_tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
	}
	return $return;
}

add_shortcode( 'tab', 'st_tab' );
function st_tab( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => "%d",
		'id' => "%d"
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array(
		'title' => sprintf( $title, $GLOBALS['tab_count'] ),
		'content' =>  $content,
		'id' =>  $id );

	$GLOBALS['tab_count']++;
}

// Toggle
function st_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		 'title' => '',
		 'style' => 'list'
    ), $atts));
	output;
	$output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
	$output .= '<div class="toggle_container"><div class="block">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div>';

	return $output;
	}
add_shortcode('toggle', 'st_toggle');

// cols
function dnomia_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'dnomia_one_third');

function dnomia_one_third_last( $atts, $content = null ) {
   return '<div class="one_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'dnomia_one_third_last');

function dnomia_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'dnomia_two_third');

function dnomia_two_third_last( $atts, $content = null ) {
   return '<div class="two_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'dnomia_two_third_last');

function dnomia_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'dnomia_one_half');

function dnomia_one_half_last( $atts, $content = null ) {
   return '<div class="one_half column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'dnomia_one_half_last');

function dnomia_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'dnomia_one_fourth');

function dnomia_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'dnomia_one_fourth_last');

function dnomia_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'dnomia_three_fourth');

function dnomia_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'dnomia_three_fourth_last');

function dnomia_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'dnomia_one_fifth');

function dnomia_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'dnomia_one_fifth_last');

function dnomia_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'dnomia_two_fifth');

function dnomia_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'dnomia_two_fifth_last');

function dnomia_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'dnomia_three_fifth');

function dnomia_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'dnomia_three_fifth_last');

function dnomia_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'dnomia_four_fifth');

function dnomia_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'dnomia_four_fifth_last');

function dnomia_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'dnomia_one_sixth');

function dnomia_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'dnomia_one_sixth_last');

function dnomia_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'dnomia_five_sixth');

function dnomia_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'dnomia_five_sixth_last');