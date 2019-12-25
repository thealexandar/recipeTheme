<?php if( have_posts() ): while( have_posts() ): the_post();?>



<div class="card mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">

        <?php if(has_post_thumbnail()):?>
            <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class="img-fluid mb-3 img-thumbnail">
        <?php else: ?>
          <img src="<?php bloginfo('template_directory'); ?>/images/default.jpg" alt="<?php the_title(); ?>" />
        <?php endif; ?>


    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php the_title();?></h5>
        <p class="card-text"><?php the_excerpt();?></p>
        <a href="<?php the_permalink();?>" class="btn btn-primary">Read More</a>
      </div>
    </div>
  </div>
</div>

<?php endwhile; else: endif;?>