<?php
function theme_init(){
	load_theme_textdomain('snapwire', GABFIRE_INC_PATH . '/lang');
	load_theme_textdomain('source', GABFIRE_INC_PATH . '/lang');
	load_theme_textdomain('default', GABFIRE_INC_PATH . '/lang');
}
add_action ('init', 'theme_init');