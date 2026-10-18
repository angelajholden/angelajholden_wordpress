<section class="skills">
  <div class="wrap">
  	<article>
  		<h2>Skills & Services</h2>
  	</article>
  	
    <div class="ajh-skills clearfix">

	  	<?php
				$args = array(
					'post_type' => 'ajhskill',
					'post_status' => 'publish',
					'order' => 'asc',
					'showposts' => -1
				);
				$skill_loop = new WP_Query( $args );
					while ( $skill_loop->have_posts() ) : $skill_loop->the_post(); ?>

		      <aside>
		      	<a href="<?php the_permalink(); ?>">
		        	<span class="fa <?php echo esc_attr( get_post_meta(get_the_ID(), 'font-awesome', true) ); ?>"></span>
		        	<h3><?php the_title(); ?></h3>
		        	<?php the_excerpt(); ?>
		        </a>
		      </aside>

	      <?php	endwhile; ?>
			<?php wp_reset_postdata(); ?>

    </div>
  </div><?php // End .wrap ?>
</section>