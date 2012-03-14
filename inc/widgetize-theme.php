<?php
function gabfire_register_sidebar($args) {
	$common = array(
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widgetinner">',
		'after_widget'  => "</div></div>\n",
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => "</h3>\n"
	);

	$args = wp_parse_args($args, $common);

	return register_sidebar($args);
}

gabfire_register_sidebar(array('name' => 'Featured','description' => 'Below featured slider','id' => 'Featured'));
gabfire_register_sidebar(array( 'name' => 'Se_Top_Left1','description' => 'Secodary top secction - above 120x600 ad','id' => 'Se_Top_Left1'));
gabfire_register_sidebar(array( 'name' => 'Se_Top_Left2','description' => 'Secodary top secction - below 120x600 ad','id' => 'Se_Top_Left2'));
gabfire_register_sidebar(array( 'name' => 'Se_Top_Mid1','description' => 'Secodary top secction - mid block - top','id' => 'Se_Top_Mid1'));
gabfire_register_sidebar(array( 'name' => 'Se_Top_Mid2','description' => 'Secodary top secction - mid block - bottom','id' => 'Se_Top_Mid2'));
gabfire_register_sidebar(array( 'name' => 'Se_Top_Right1','description' => 'Secodary top secction - right block - top','id' => 'Se_Top_Right1'));
gabfire_register_sidebar(array( 'name' => 'Se_Top_Right2','description' => 'Secodary top secction - right block - bottom','id' => 'Se_Top_Right2'));
gabfire_register_sidebar(array( 'name' => 'Secondary1','description' => 'Between secondary top and bottom - full block','id' => 'Secondary1'));
gabfire_register_sidebar(array( 'name' => 'Se_Bot_Left1','description' => 'Secondary bottom section left block - top','id' => 'Se_Bot_Left1'));
gabfire_register_sidebar(array( 'name' => 'Se_Bot_Left2','description' => 'Secondary bottom section left block - bottom','id' => 'Se_Bot_Left2'));
gabfire_register_sidebar(array( 'name' => 'Se_Bot_Right1','description' => 'Secondary bottom section - right block - top','id' => 'Se_Bot_Right1'));
gabfire_register_sidebar(array( 'name' => 'Se_Bot_Right2','description' => 'Secondary bottom section - right block - bottom','id' => 'Se_Bot_Right2'));
gabfire_register_sidebar(array( 'name' => 'Secondary2','description' => 'Below secondary block bottom - full block','id' => 'Secondary2'));
gabfire_register_sidebar(array( 'name' => 'Below_Mediabar','description' => 'Below media slider on front page - full block','id' => 'Below_Mediabar'));
gabfire_register_sidebar(array( 'name' => 'SubnewsLeft1','description' => 'Subnews left block - top','id' => 'SubnewsLeft1'));
gabfire_register_sidebar(array( 'name' => 'SubnewsLeft2','description' => 'Subnews left block - bottom','id' => 'SubnewsLeft2'));
gabfire_register_sidebar(array( 'name' => 'SubnewsMid1','description' => 'Subnews mid block - top','id' => 'SubnewsMid1'));
gabfire_register_sidebar(array( 'name' => 'SubnewsMid2','description' => 'Subnews mid block - bottom','id' => 'SubnewsMid2'));
gabfire_register_sidebar(array( 'name' => 'SubnewsRight1','description' => 'Subnews right block - top','id' => 'SubnewsRight1'));
gabfire_register_sidebar(array( 'name' => 'SubnewsRight2','description' => 'Subnews right block - bottom','id' => 'SubnewsRight2'));
gabfire_register_sidebar(array( 'name' => 'MainBottom','description' => 'Below subnews - full block','id' => 'MainBottom'));
gabfire_register_sidebar(array( 'name' => 'Footer1','description' => 'Footer Left Block','id' => 'Footer1'));
gabfire_register_sidebar(array( 'name' => 'Footer2','description' => 'Footer Mid Block','id' => 'Footer2'));
gabfire_register_sidebar(array( 'name' => 'Footer3','description' => 'Footer Right Block','id' => 'Footer3'));
gabfire_register_sidebar(array( 'name' => 'Sidebar1-Home','description' => 'Sidebar first - Only for homepage','id' => 'Sidebar1-Home'));
gabfire_register_sidebar(array( 'name' => 'Sidebar2-Home','description' => 'Sidebar second - Only for homepage','id' => 'Sidebar2-Home'));
gabfire_register_sidebar(array( 'name' => 'Sidebar3-Home','description' => 'Sidebar third - Only for homepage','id' => 'Sidebar3-Home'));
gabfire_register_sidebar(array( 'name' => 'Sidebar1-Innerpage','description' => 'Sidebar first - Only for innerpages','id' => 'Sidebar1-Innerpage'));
gabfire_register_sidebar(array( 'name' => 'Sidebar2-Innerpage','description' => 'Sidebar second - Only for innerpages','id' => 'Sidebar2-Innerpage'));
gabfire_register_sidebar(array( 'name' => 'Sidebar3-Innerpage','description' => 'Sidebar third - Only for innerpages','id' => 'Sidebar3-Innerpage'));
gabfire_register_sidebar(array( 'name' => 'PageWidget','description' => 'Widgetized page template - widget zone','id' => 'PageWidget'));
gabfire_register_sidebar(array( 'name' => 'PostWidget','description' => 'Single Post Widget - Anything added in this zone will appear below post on single post page','id' => 'PostWidget'));