<?php
$wp_query = new WP_Query(
  array(
          'posts_per_page'        => $islemag_section_max_posts,
          'order'                 => 'ASC',
          'post_status'           => 'publish',
          'ignore_sticky_posts'   => true,
          'no_found_rows'       => true,
          'category_name'         =>  (!empty($islemag_section_category) && $islemag_section_category != 'all' ? $islemag_section_category : '')
      )
);

if ( $wp_query->have_posts() ) : ?>
  <div class="post-section islemag-template1">
  
    <div class="owl-carousel islemag-template1-posts smaller-nav no-radius">
      <?php

        while ( $wp_query->have_posts() ) : $wp_query->the_post();

          $choosed_color = array_rand($colors, 1);
          $category = get_the_category();
      ?>

          <article class="entry entry-overlay entry-block <?php echo $colors[$choosed_color];?>">
              <a href="<?php echo get_category_link($category[0]->cat_ID);?>" class="category-block" title="Category <?php echo $category[0]->cat_name;?>"><?php echo $category[0]->cat_name;?></a>
              <div class="entry-media">
                  <figure>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                           <?php
                              if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($wp_query->ID), 'main-slider' );
                      					$url = $thumb['0'];
                      					echo '<img class="owl-lazy" data-src="'.$url.'" />';
                              } else {
                                  echo '<img class="owl-lazy" data-src="'.get_template_directory_uri().'/img/placeholder-image.png" />';
                              }
                          ?>
                      </a>
                  </figure> <!-- End figure -->
                  <div class="entry-overlay-meta">
                      <span class="entry-overlay-date"><i class="fa fa-calendar"></i><?php echo get_the_date( 'j M' ); ?></span>
                      <span class="entry-separator">/</span>
                      <a href="<?php the_permalink(); ?>" class="entry-comments"><i class="fa fa-comments"></i><?php comments_number( '0', '1', '%' ); ?></a>
                      <span class="entry-separator">/</span>
                      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="entry-author"><i class="fa fa-user"></i><?php the_author(); ?></a>
                  </div> <!-- End .entry-overlay-meta -->
              </div> <!-- End .entry-media -->

              <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
          </article> <!-- End .entry-overlay -->
        <?php
          endwhile;
          wp_reset_postdata(); ?>
    </div> <!-- End .islemag-template1-posts -->
  </div> <!-- End .islemag-template1 -->
<?php
  endif;
?>