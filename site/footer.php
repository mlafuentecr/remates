<?php

?>

			</div><!-- .row -->
		</div><!-- .container -->

    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="colophon" class="site-footer " role="contentinfo">
		<div class="container pt-3 pb-3">
            <div class="site-info">
                &copy; <?php echo date('Y'); ?> <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?>
                <span class="sep"> | </span>

            </div><!-- close .site-info -->
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->
</div><!-- #main -->

<?php
if ( is_page( 'lista-de-hoy' ) ) {   

	?>
	<script language='javascript'>

	function openDetalle() {
		alert("Im button");
		
		//this.parentNode.style.display = 'flex';
	   //getElementsByTagName('close').previousSibling; // #foo1
	 }
	</script>
   <?php
	
}


	?>

<?php wp_footer(); ?>
</body>
</html>