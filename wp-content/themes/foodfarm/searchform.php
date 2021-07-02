<form role="search" method="get" id="searchform" class="searchform product-search" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" class="search-field" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php echo esc_html__('Search...','foodfarm');?>" name="s" id="s" />
        <button type="submit" id="searchsubmit" class="button btn-search"><i class="fa fa-search"></i></button>
		<?php 
            if (get_post_type()=='post') {
                echo  '<input type="hidden" name="post_type" value="post" />';
            } else if (get_post_type()=='gallery') {
                echo  '<input type="hidden" name="post_type" value="gallery" />';
            } else {
		        if(class_exists( 'WooCommerce' )) {
		            echo  '<input type="hidden" name="post_type" value="product" />';
		        }            	 
            } 
		?>     
	</div>
</form>