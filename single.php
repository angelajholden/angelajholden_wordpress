<?php get_header(); ?>

  <section class="wrap">

  	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    	<aside class="single-top clearfix">

      	<div class="single-author clearfix">
      		<figure class="gravatar"><?php echo get_avatar( get_the_author_meta( 'email' ), 75 ); ?></figure>
      		<p><?php the_author(); ?><br>
      		<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_time('F j, Y'); ?></time></p>
      	</div>

        <div class="single-meta">
        	
        <p>Category <span class="bullet">&bull;</span> <?php the_category(','); ?></p>

        <?php if (has_tag()) : ?>
		      <div class="theTags"><?php the_tags( 'Tagged <span class="bullet">&bull;</span> ', ' <span class="bullet">&bull;</span> ', '' ); ?></div>
		    <?php endif; ?>

        </div>

      </aside>
        
      <article <?php post_class('clearfix'); ?>>

		    <header>
			    <h1><?php the_title(); ?></h1>
			  </header>

		    <?php $video = get_post_meta( get_the_ID(), 'video_url', true );
		      if( ! empty( $video ) ) { ?>
		        <figure class="fitvids">
		          <?php echo parse_youtube_url($video,'embed'); ?>
		        </figure>
		    <?php } elseif (has_post_thumbnail()) { ?>
		    	<figure class="project-img"><?php the_post_thumbnail('full', array('draggable' => 'false')); echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figure>
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

		      <?php if (get_post_meta(get_the_ID(), 'post_intro', true)) { ?>
		      	<aside class="post-intro">
		      		<p><?php echo wp_kses_post( get_post_meta(get_the_ID(), 'post_intro', true) ); ?></p>
		      	</aside>
		      <?php } ?>

	      	<?php the_content(); ?>

	      </div>

	    </article>

		    <?php wordpress_sharing(); ?>

		    <?php the_post_navigation(); ?>

	    <hr class="bee" />

			<figure class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '150' ); ?></figure>
	    <div class="author-bio clearfix">
				<h2 class="author-name"><?php echo get_the_author(); ?></h2>
				<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
			</div>

	    <?php
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

    <?php endwhile; else : ?>
		<?php endif; ?>

  </section><?php //Blog Wrap ?>

<?php get_footer(); ?>