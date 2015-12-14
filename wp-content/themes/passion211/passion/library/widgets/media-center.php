<?php

class KopaMediaCenter extends KopaWidgetPosts {

	public function __construct() {
		$id_base = 'kopa_media_center';
		$name = __( 'Kopa Media Center', kopa_get_domain() );
		$widget_options = array( 'classname' => 'kopa_media_center kp-gallery-widget', 'description' => __( 'Display lists post with small thumbnail', kopa_get_domain() ) );
		$control_options = array( 'width' => '750', 'height' => 'auto' );
		parent::__construct( $id_base, $name, $widget_options, $control_options );

		$col3 = array(
			'size' => 2,
			'fields' => array()
		);
		$col3['fields']['post_per_row'] = array(
			'type' => 'select-number',
			'id' => 'post_per_row',
			'name' => 'post_per_row',
			'label' => __( 'Post per row', kopa_get_domain() ),
			'default' => 6,
			'min' => 1,
			'max' => 6,
			'step' => 1,
			'suffix' => __( ' column', kopa_get_domain() ),
		);

		$sizes = KopaInit::get_image_sizes();
		$col3['fields']['image_size'] = array(
			'type' => 'select',
			'id' => 'image_size',
			'name' => 'image_size',
			'label' => __( 'Thumbnail size', kopa_get_domain() ),
			'default' => 'size_02',
			'options' => array(
				'size_02' => $sizes['size_02']['name'],
				'size_03' => $sizes['size_03']['name'],
				'size_05' => $sizes['size_05']['name'],
				'size_06' => $sizes['size_06']['name'],
				'size_07' => $sizes['size_07']['name']
			)
		);

		$this->groups['col-3'] = $col3;
		$this->groups['col-1']['size'] = 4;
		$this->groups['col-2']['size'] = 6;
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
		if ( $posts->have_posts() ) {
			global $post;

			$post_per_row = (int) $instance['post_per_row'];
			$row_classes = array( 'row', 'clearfix' );
			$row_classes[] = empty( $title ) ? 'widget-hide-title' : '';
			$col_classes = array();
			$image_size = isset( $instance['image_size'] ) ? $instance['image_size'] : 'size_02';

			switch ( $post_per_row ) {
				case 2:
					$col_classes[] = "col-sm-6";
					break;
				case 3:
					$col_classes[] = "col-sm-4";
					break;
				case 4:
					$col_classes[] = "col-sm-3";
					break;
				case 5:
					$col_classes[] = "col20perc";
					break;
				case 6:
					$col_classes[] = "col-sm-2";
					break;
				default:
					$col_classes[] = "col-sm-12";
			}
			?>

			<div class="kopa-media-row-outer">

				<?php
				printf( '<div class="%s">', implode( ' ', $row_classes ) );
				$index = 1;
				while ( $posts->have_posts() ):
					$posts->the_post();
					$post_id = get_the_ID();
					$post_title = get_the_title();
					$post_url = get_permalink();
					$post_format = get_post_format();

					$classes = $col_classes;
					$classes[] = 'kopa-media-item';
					?>
					<div class="<?php echo implode( ' ', $classes ); ?>">
						<article class="entry-item clearfix">
							<?php
							if ( has_post_thumbnail() ) {
								$light_box_url = $post_url;
								$lightbox_classes = array();
								$light_box_classes = array();
								$light_box_thumb_classes = array();
								$light_box_inline = NULL;
								$light_box_onclick = NULL;

								$image_croped = KopaImage::get_post_image_src( $post_id, $image_size );
								?>
								<?php
								$icon = NULL;
								switch ( $post_format ) {
									case 'audio':
										$light_box_classes[] = 'audio-icon';
										$audios = KopaUtil::get_shortcode( $post->post_content, true, array( 'audio', 'soundcloud' ) );
										if ( !empty( $audios ) ) {
											foreach ( $audios as $audio ) {
												$light_box_url = sprintf( '%s&action=%s&post_id=%s&post_format=%s', wp_nonce_url( admin_url( 'admin-ajax.php' ), 'kopa_load_post', 'ajax_nonce' ), 'kopa_load_post', $post_id, $post_format );
												$lightbox_classes[] = 'magnific_ajax';
											}
										}
										break;
									case 'video':
										$light_box_classes[] = 'video-icon';
										$videos = KopaUtil::get_shortcode( $post->post_content, true, array( 'youtube', 'vimeo', 'video' ) );
										if ( !empty( $videos ) ) {
											foreach ( $videos as $video ) {
												if ( in_array( $video['type'], array( 'youtube', 'vimeo' ) ) ) {
													if ( isset( $video['atts']['url'] ) && !empty( $video['atts']['url'] ) ) {
														$light_box_url = $video['atts']['url'];
														$lightbox_classes[] = 'magnific_youtube_or_vimeo';
													}
												} else if ( 'video' == $video['type'] ) {
													$light_box_url = sprintf( '%s&action=%s&post_id=%s&post_format=%s', wp_nonce_url( admin_url( 'admin-ajax.php' ), 'kopa_load_post', 'ajax_nonce' ), 'kopa_load_post', $post_id, $post_format );
													$lightbox_classes[] = 'magnific_ajax';
												}
											}
										}
										break;
									case 'gallery':
										$light_box_classes[] = 'gallery-icon';
										$galleries = KopaUtil::get_shortcode( $post->post_content, true, array( 'gallery' ) );
										if ( !empty( $galleries ) ) {
											$lightbox_classes[] = 'magnific_gallery';
											?>
											<div class="magnific_gallery_wrap">
												<?php
												foreach ( $galleries as $gallery ) {
													if ( isset( $gallery['atts']['ids'] ) ) {
														$ids = explode( ',', $gallery['atts']['ids'] );
														if ( is_array( $ids ) && !empty( $ids ) ) {
															foreach ( $ids as $id ) {
																$image = wp_get_attachment_image_src( $id, 'full' );
																if ( isset( $image[0] ) ) {
																	$image_info = get_post( $id );
																	?>
																	<a class="magnific_image_hide" href="<?php echo esc_url( $image[0] ); ?>" title="<?php echo esc_attr( $image_info->post_excerpt ); ?>"><?php echo wp_kses_post( $image_info->post_excerpt ); ?></a>
																	<?php
																	wp_reset_query();
																}
															}
														}
													}
												}
												?>
											</div>
											<?php
										}
										break;
								}
								$light_box_classes[] = 'hover-icon';
								?>

								<div class="entry-thumb hover-effect">
									<a class="<?php echo implode( ' ', $lightbox_classes ); ?>" href="<?php echo esc_url( $light_box_url ); ?>" <?php echo esc_html( $light_box_onclick ); ?>><img src="<?php echo esc_url( $image_croped ); ?>" alt="<?php echo esc_attr( $post_title ); ?>"/></a>                                                                        
									<span class="<?php echo implode( ' ', $light_box_classes ); ?>"></span>                                
								</div>                            
								<?php
							}
							?>                            
							<div class="entry-content">
								<header>
									<?php if ( 'true' != $instance['is_hide_title'] ): ?>
										<h6 class="entry-title"><a href="<?php echo esc_url( $post_url ); ?>"><?php echo wp_kses_post( $post_title ); ?></a></h6>
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
						</article>                        
					</div>
					<?php
					if ( $index % $post_per_row == 0 ) {
						echo '</div>';
						?>
					</div><div class="kopa-media-row-outer">
						<?php
						printf( '<div class="%s">', implode( ' ', $row_classes ) );
					}
					$index++;
				endwhile;
				echo '</div>';
				?>
			</div>
			<?php
		} else {
			_e( 'Posts not found. Pleae config this widget again!', kopa_get_domain() );
		}
		wp_reset_postdata();

		echo $after_widget;
	}

}
