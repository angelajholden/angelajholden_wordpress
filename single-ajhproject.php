<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  	<section class="wrap">

      <article class="clearfix">

	    <header>
		    <h1><?php the_title(); ?></h1>
		    <p class="completed"><time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_time('F Y'); ?></time></p>
		  </header>

        <figure class="project-img"><?php the_post_thumbnail('full', array('draggable' => 'false')); ?></figure>

        <?php if (get_post_meta(get_the_ID(), 'live_demo', true)) { ?>
		      <p class="demo-button">
		      	
	      		<a href="<?php echo esc_url( get_post_meta(get_the_ID(), 'live_demo', true) ); ?>" target="_blank">View Site</a>

	      	<?php if (get_post_meta(get_the_ID(), 'download', true)) { ?>
	      		<a href="<?php echo esc_url( get_post_meta(get_the_ID(), 'download', true) ); ?>" target="_blank">View Code</a>
	      	<?php } ?>

	      	<?php if (get_post_meta(get_the_ID(), 'purchase', true)) { ?>
	      		<a href="<?php echo esc_url( get_post_meta(get_the_ID(), 'purchase', true) ); ?>" target="_blank">Purchase</a>
	      	<?php } ?>

		      </p>
		    <?php } ?>

        <div class="main"><?php the_content(); ?></div>

      </article>

      <?php if (!get_post_meta(get_the_ID(), 'testimonial', true)) { ?>
      <?php //wordpress_sharing(); ?>
      <hr class="bee" />
      	<figure class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '150' ); ?></figure>
		    <div class="author-bio clearfix">
					<h2 class="author-name"><?php echo get_the_author(); ?></h2>
					<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
				</div>
      <?php } ?>

    </section>

    <?php if (get_post_meta(get_the_ID(), 'testimonial', true)) { ?>
	  	<section class="project-testimonial">
	  		<div class="wrap">
	  			<div class="title"><?php echo esc_html( get_post_meta(get_the_ID(), 'title', true) ); ?></div>
	  			<p><?php echo wp_kses_post( get_post_meta(get_the_ID(), 'testimonial', true) ); ?></p>
	  		</div>
	  	</section>
	    <section class="wrap project-author">
	    	<?php //wordpress_sharing(); ?>
		    <figure class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '150' ); ?></figure>
		    <div class="author-bio clearfix">
					<h2 class="author-name"><?php echo get_the_author(); ?></h2>
					<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
				</div>
	  	</section>
	  <?php } ?>

  	<?php endwhile; else : ?>
	<?php endif; ?>

<?php get_footer(); ?>