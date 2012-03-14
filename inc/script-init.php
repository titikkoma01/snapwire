<?php 
add_action("wp_head", "theme_scripts"); 

function theme_scripts() {
	$options_feaslide = array("scrollUp", "scrollDown", "scrollLeft", "scrollRight", "turnUp", "turnDown", "turnLeft", "turnRight", "fade");
?>

	<script type='text/javascript'>
	(function($) {
		$(document).ready(function() { 
			<?php if(is_home()) { ?>
				$('#featured_posts .sliderwrapper').cycle({ 
					pauseOnPagerHover: 1,
					prev:   '.prev',
					next:   '.next',
					pauseOnPagerHover: 1,
						fx: '<?php echo $options_feaslide[of_get_option('of_sn_sfunc', 8)]; ?>',
						speed: '<?php echo of_get_option('of_sn_feaspeed', 1); if (intval(of_get_option('of_sn_feaspeed')) > 0 ) { echo "000"; } ?>',
						timeout: '<?php echo of_get_option('of_sn_featimeout', 5); if (intval(of_get_option('of_sn_featimeout')) > 0 ) { echo "000"; } ?>',
					pager:  '#nav ul',
					pagerAnchorBuilder: function(idx, slide) { 
						// return selector string for existing anchor 
						return '#nav ul li:eq(' + idx + ') a'; 
					} 
				});

			<?php } elseif(is_single() or (is_page())) {?>
			$('#slides').slides({
				<?php if(of_get_option('of_sn_inner_rotate') == 1) { ?>
				play: <?php if ( of_get_option('of_sn_inner_pause') <> "" ) { echo of_get_option('of_sn_inner_pause').'000'; } else { echo '5000'; } ?>,
				pause: 2500,
				hoverPause: true,
				<?php } ?>
				preload: true,
				autoHeight: true
			});		
			<?php } ?>		
			
			$("a[rel=gab_gallery]").fancybox({
				'transitionIn':'none','transitionOut':'none','titlePosition':'over',
				'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">' + title /* + ' ('+(currentIndex + 1) + ' / ' + currentArray.length + ')' */ +'</span>';
				}
			});	
			$(".show").fancybox({  'titleShow': 'false','transitionIn': 'fade','transitionOut': 'fade'});
			$(".iframe").fancybox({	'width'	: '75%','height' : '75%','autoScale': false,'transitionIn': 'none','transitionOut': 'none','type': 'iframe'});
			$("ul.tabs").tabs("div.panes > div");
			$('a[href=#top]').click(function(){	$('html, body').animate({scrollTop:0}, 'slow');	return false;});

		});
	})(jQuery);
	</script>
<?php } ?>