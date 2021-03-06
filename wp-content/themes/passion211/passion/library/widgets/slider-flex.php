<?php

class KopaPostsListFlexSlider extends KopaWidgetPosts {

	public function __construct() {
		$id_base = 'kopa_posts_list_flex_slider';
		$name = __( 'Kopa Flex Slider', kopa_get_domain() );
		$widget_options = array( 'classname' => 'kp-featured-widget', 'description' => __( 'Display posts as flex slider', kopa_get_domain() ) );
		$control_options = array( 'width' => '600', 'height' => 'auto' );
		parent::__construct( $id_base, $name, $widget_options, $control_options );

		$sizes = KopaInit::get_image_sizes();

		$this->groups['col-2']['fields']['image-size'] = array(
			'type' => 'select',
			'id' => 'image-size',
			'name' => 'image-size',
			'label' => __( 'Size of Image slide', kopa_get_domain() ),
			'default' => 'size_03',
			'options' => array(
				'size_03' => $sizes['size_03']['name'],
				'size_05' => $sizes['size_05']['name'],
				'size_07' => $sizes['size_07']['name'],
			)
		);

		$this->groups['col-2']['fields']['is_disable_slideshow'] = array(
			'type' => 'checkbox',
			'id' => 'is_disable_slideshow',
			'name' => 'is_disable_slideshow',
			'default' => 'false',
			'classes' => array(),
			'label' => __( 'Disable slide autoplay', kopa_get_domain() ),
			'help' => NULL,
			'is_append_label_before_control' => false
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( !empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$query = $this->build_query( $instance );

		$posts = new WP_Query( $query );
		if ( $posts->have_posts() ):
			global $post;
			$video_class = 'magnific_youtube_or_vimeo';

			$image_size = isset( $instance['image-size'] ) ? $instance['image-size'] : 'size_03';
			?>            
			<input type="hidden" class="is_disable_slideshow" value="<?php echo esc_attr( $instance['is_disable_slideshow'] ); ?>">

			<div class="flexslider kp-featured-news-slider kp-featured-mobile-slider loading" style="display: none;">
				<ul class="slides">
					<?php
					while ( $posts->have_posts() ):
						$posts->the_post();
						$post_id = get_the_ID();
						$post_title = get_the_title();
						$post_url = get_permalink();
						$post_format = get_post_format();
						if ( has_post_thumbnail() ):
							$image_croped = KopaImage::get_post_image_src( $post_id, $image_size );
							?>
							<li>
								<?php if ( 'video' != $post_format ) { ?>
									<img src="<?php echo esc_url( $image_croped ); ?>" alt="<?php echo esc_attr( $post_title ); ?>"/>
									<?php
								} else {
									$video_url = '';

									$video = KopaUtil::get_video( $post->post_content, array( 'youtube', 'vimeo' ) );
									if ( empty( $video ) ) {
										$video_url = $post_url;
										$video_class = '';
									} else {
										if ( in_array( $video['type'], array( 'youtube', 'vimeo' ) ) ) {
											$video_url = $video['url'];
										}
									}
									?>
									<div class="entry-thumb hover-effect">
										<img src="<?php echo esc_url( $image_croped ); ?>" alt="" />                                        
										<?php
										if ( $video_class ) {
											?>
											<a href="<?php echo esc_url( $video_url ); ?>" onclick="KopaLightbox.openSliderVideo(event, jQuery(this));" rel="" class="hover-icon video-icon"></a>
											<a href="<?php echo esc_url( $video_url ); ?>" class="<?php echo esc_attr( $video_class ); ?>"></a>
											<?php
										} else {
											?>
											<a href="<?php echo esc_url( $video_url ); ?>" rel="" class="hover-icon video-icon"></a>
											<?php
										}
										?>
									</div>
								<?php } ?>

								<div class="entry-content">
									<header>
										<?php if ( 'true' != $instance['is_hide_title'] ): ?>
											<h4 class="entry-title"><a href="<?php echo esc_url( $post_url ); ?>"><?php echo wp_kses_post( $post_title ); ?></a></h4>
										<?php endif; ?>

										<?php if ( 'true' != $instance['is_hide_created_date'] ): ?>
											<span class="entry-date clearfix"><?php echo KopaIcon::getIcon( 'fa fa-calendar-o entry-icon', 'span' ); ?><span class="date updated"><?php echo get_the_date(); ?></span></span>
										<?php endif; ?>

										<?php if ( 'true' != $instance['is_hide_comments'] ): ?>
											<span class="entry-comments clearfix"><?php echo KopaIcon::getIcon( 'fa fa-comment-o entry-icon', 'span' ); ?><?php comments_popup_link( __( 'No Comment', kopa_get_domain() ), __( '1 Comment', kopa_get_domain() ), __( '% Comments', kopa_get_domain() ), '', __( 'Comment Off', kopa_get_domain() ) ); ?></span>                                    
										<?php endif; ?>

										<?php if ( 'true' != $instance['is_hide_views'] ): ?>
											<span class="entry-views clearfix"><?php echo KopaIcon::getIcon( 'fa fa-eye entry-icon', 'span' ); ?><a href="<?php echo esc_url( $post_url ); ?>"><?php echo KopaUtil::get_views( $post_id ); ?></a></span>                                
										<?php endif; ?>
									</header>

									<?php
									if ( 'true' != $instance['is_hide_excerpt'] ) {
										if ( (int) $instance['excerpt_character_limit'] > 0 ) {
											$excerpt = KopaUtil::substr( $post->post_content, (int) $instance['excerpt_character_limit'] );
											echo ($excerpt) ? sprintf( '<p>%s</p>', $excerpt ) : '';
										} else {
											the_excerpt();
										}
									}
									?>

									<?php if ( 'true' != $instance['is_hide_readmore'] ): ?>
										<a class="more-link clearfix" href="<?php echo esc_url( $post_url ); ?>"><?php echo KopaIcon::getIcon( 'fa fa-link entry-icon', 'span' ); ?><span><?php _e( 'Read more ...', kopa_get_domain() ); ?></span></a>
									<?php endif; ?>                                        
								</div>

							</li>                                        
							<?php
						endif;
					endwhile;
					?>
				</ul>
			</div>


			<div class="kp-slider-wrapper">
				<div class="kp-slider-featured-img">
					<div class="flexslider kp-featured-news-slider kp-featured-desktop-slider loading">
						<ul class="slides">
							<?php
							while ( $posts->have_posts() ):
								$posts->the_post();
								$post_id = get_the_ID();
								$post_title = get_the_title();
								$post_url = get_permalink();
								$post_format = get_post_format();
								if ( has_post_thumbnail() ):
									$image_croped = KopaImage::get_post_image_src( $post_id, $image_size );
									?>
									<li>
										<?php if ( 'video' != $post_format ) { ?>
											<img src="<?php echo esc_url( $image_croped ); ?>" alt="<?php echo esc_attr( $post_title ); ?>"/>
											<?php
										} else {
											$video_url = '';

											$video = KopaUtil::get_video( $post->post_content, array( 'youtube', 'vimeo' ) );
											if ( empty( $video ) ) {
												$video_url = $post_url;
												$video_class = '';
											} else {
												if ( in_array( $video['type'], array( 'youtube', 'vimeo' ) ) ) {
													$video_url = $video['url'];
												}
											}
											?>
											<div class="entry-thumb hover-effect">
												<img src="<?php echo esc_url( $image_croped ); ?>" alt="" />
												<?php
												if ( $video_class ) {
													?>
													<a href="<?php echo esc_url( $video_url ); ?>" onclick="KopaLightbox.openSliderVideo(event, jQuery(this));" rel="" class="hover-icon video-icon"></a>
													<a href="<?php echo esc_url( $video_url ); ?>" class="<?php echo esc_attr( $video_class ); ?>"></a>
													<?php
												} else {
													?>
													<a href="<?php echo esc_url( $video_url ); ?>" rel="" class="hover-icon video-icon"></a>
													<?php
												}
												?>
											</div>
										<?php } ?>


									</li>                                        
									<?php
								endif;
							endwhile;
							?>
						</ul>
					</div>

					<div class="flexslider flex-carousel">
						<ul class="slides">
							<?php
							$index = 1;
							while ( $posts->have_posts() ):
								$posts->the_post();
								$post_id = get_the_ID();
								$post_title = get_the_title();
								$post_url = get_permalink();
								$post_format = get_post_format();
								if ( has_post_thumbnail() ):
									$image_croped = KopaImage::get_post_image_src( $post_id, 'size_02' );
									?>
									<li data-index="<?php echo esc_attr( $index ); ?>">
										<img src="<?php echo esc_url( $image_croped ); ?>" alt="<?php echo esc_attr( $post_title ); ?>"/>
									</li>                                        
									<?php
									$index++;
								endif;
							endwhile;
							?>
						</ul>
					</div>
				</div>

				<div class="flexslider kp-featured-text-slider">
					<ul class="slides">
						<?php
						while ( $posts->have_posts() ):
							$posts->the_post();
							$post_id = get_the_ID();
							$post_title = get_the_title();
							$post_url = get_permalink();
							$post_format = get_post_format();
							if ( has_post_thumbnail() ):
								?>
								<li>
									<div class="entry-content">
										<header>
											<?php if ( 'true' != $instance['is_hide_title'] ): ?>
												<h4 class="entry-title"><a href="<?php echo esc_url( $post_url ); ?>"><?php echo wp_kses_post( $post_title ); ?></a></h4>
											<?php endif; ?>

											<?php if ( 'true' != $instance['is_hide_created_date'] ): ?>
												<span class="entry-date clearfix"><?php echo KopaIcon::getIcon( 'fa fa-calendar-o entry-icon', 'span' ); ?><span class="date updated"><?php echo get_the_date(); ?></span></span>
											<?php endif; ?>

											<?php if ( 'true' != $instance['is_hide_comments'] ): ?>
												<span class="entry-comments clearfix"><?php echo KopaIcon::getIcon( 'fa fa-comment-o entry-icon', 'span' ); ?><?php comments_popup_link( __( 'No Comment', kopa_get_domain() ), __( '1 Comment', kopa_get_domain() ), __( '% Comments', kopa_get_domain() ), '', __( 'Comment Off', kopa_get_domain() ) ); ?></span>                                    
											<?php endif; ?>

											<?php if ( 'true' != $instance['is_hide_views'] ): ?>
												<span class="entry-views clearfix"><?php echo KopaIcon::getIcon( 'fa fa-eye entry-icon', 'span' ); ?><a href="<?php echo esc_url( $post_url ); ?>"><?php echo KopaUtil::get_views( $post_id ); ?></a></span>                                
											<?php endif; ?>
										</header>

										<?php
										if ( 'true' != $instance['is_hide_excerpt'] ) {
											if ( (int) $instance['excerpt_character_limit'] > 0 ) {
												$excerpt = KopaUtil::substr( $post->post_content, (int) $instance['excerpt_character_limit'] );
												echo ($excerpt) ? sprintf( '<p>%s</p>', $excerpt ) : '';
											} else {
												the_excerpt();
											}
										}
										?>

										<?php if ( 'true' != $instance['is_hide_readmore'] ): ?>
											<a class="more-link clearfix" href="<?php echo esc_url( $post_url ); ?>"><?php echo KopaIcon::getIcon( 'fa fa-link entry-icon', 'span' ); ?><span><?php _e( 'Read more ...', kopa_get_domain() ); ?></span></a>
												<?php endif; ?>                                        
									</div>
								</li>                                        
								<?php
							endif;
						endwhile;
						?>
					</ul>
				</div>
			</div>
			<?php
		else:
			_e( 'Posts not found. Pleae config this widget again!', kopa_get_domain() );
		endif;
		wp_reset_postdata();

		echo $after_widget;
	}

}
