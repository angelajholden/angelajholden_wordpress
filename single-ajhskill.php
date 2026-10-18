<?php get_header(); ?>

  <section class="wrap">

  	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
      <article class="clearfix">

		    <header>
			    <h1><?php the_title(); ?></h1>
			  </header>

				<nav class="skills-nav">
			    <ul>

				    <?php
						//$currentID = get_the_ID(); //, 'post__not_in' => array($currentID)
						$service_query = new WP_Query( array('post_type' => 'ajhskill', 'post_status' => 'publish', 'order' => 'asc', 'showposts' => '-1'));
						while ( $service_query->have_posts() ) : $service_query->the_post(); ?>

							<li><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></li>

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>

			    </ul>
			  </nav>

		    <?php $video = get_post_meta( get_the_ID(), 'video_url', true );
		      if( ! empty( $video ) ) { ?>
		        <figure class="fitvids">
		          <?php echo parse_youtube_url($video,'embed'); ?>
		        </figure>
		    <?php } elseif (has_post_thumbnail()) { ?>
		    	<figure class="project-img"><?php the_post_thumbnail('services', array('draggable' => 'false')); echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figure>
		    <?php } ?>

		    <?php if (get_post_meta(get_the_ID(), 'live_demo', true)) { ?>
		      <p class="demo-button">

	      		<a href="<?php echo esc_url( get_post_meta(get_the_ID(), 'live_demo', true) ); ?>" target="_blank">Live Demo</a>

	      	<?php if (get_post_meta(get_the_ID(), 'download', true)) { ?>
	      		<a href="<?php echo esc_url( get_post_meta(get_the_ID(), 'download', true) ); ?>" target="_blank">Download</a>
	      	<?php } ?>

	      	<?php if (get_post_meta(get_the_ID(), 'purchase', true)) { ?>
	      		<a href="<?php echo esc_url( get_post_meta(get_the_ID(), 'purchase', true) ); ?>" target="_blank">Purchase</a>
	      	<?php } ?>

		      </p>
		    <?php } ?>

	      <div class="main">

	      	<?php the_content(); ?>

	      </div>

	    </article>

	    <?php //wordpress_sharing(); ?>

	    <hr class="bee" />

	    <figure class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '150' ); ?></figure>
	    <div class="author-bio clearfix">
				<h2 class="author-name"><?php echo get_the_author(); ?></h2>
				<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
			</div>

    <?php endwhile; else : ?>
		<?php endif; ?>

  </section><?php //Blog Wrap ?>

<?php get_footer(); ?>