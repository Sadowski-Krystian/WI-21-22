<?php get_header(); ?>

<div class="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="entry">
 		<?php the_content(); ?>
 	</div>
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</div>

<?php get_footer(); ?>