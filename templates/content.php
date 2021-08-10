<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><?php if(in_category('videos')): ?><i class="fa fa-file-video-o"></i><?php endif; ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
