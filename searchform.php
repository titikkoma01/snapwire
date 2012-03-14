<form class="gab_search_style1" action="<?php bloginfo('url'); ?>">
	<fieldset>
		<input type="text" class="text" name="s" value="<?php _e('Search in Site...', 'snapwire'); ?>" onfocus="if (this.value == '<?php _e('Search in Site...', 'snapwire'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search in Site...', 'snapwire'); ?>';}" />
		<input type="image" class="submit" src="<?php bloginfo('template_url'); ?>/images/framework/search.png" alt="<?php _e('Search in Site...', 'snapwire'); ?>" />
		<div class="clearfix"></div>
	</fieldset>
</form>	