<?php get_header(); ?>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      
      <?php the_content(); ?>
      
    <?php endwhile; ?>
  <?php else : ?>
    <p><?php echo esc_html__( 'Sorry, no posts matched your criteria.', 'text-domain' ); ?></p>
  <?php endif; ?>

<?php get_footer(); ?>