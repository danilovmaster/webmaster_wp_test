<?php
//подключаем bootstrap
add_action( 'wp_enqueue_scripts', 'webmastertest_scripts' );
// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний
function webmastertest_scripts() {
	wp_enqueue_style( 'Bootstrap', get_theme_file_uri( 'bootstrap.min.css' ), array(), '4.1.0' );
	wp_enqueue_script( 'Bootstrap', get_theme_file_uri( 'js/bootstrap.min.js' ), array(), '4.1.0', true );
}

/*добавим 2 виджета для вывода телефона в хедере и вывода лого в футере
тип виджетов меняется в админке с помощью встроенных функций  (текст и картинка */
add_theme_support( 'customize-selective-refresh-widgets' );
function webmastertest_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Header 1', 'webmastertest' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Телефон для шапки', 'webmastertest' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div>',
		'after_title'   => '</div>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Header 2', 'webmastertest' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Поиск в топ-меню', 'webmastertest' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div>',
		'after_title'   => '</div>',
	) );

}
add_action( 'widgets_init', 'webmastertest_widgets_init' );
// Новостной шорткод
function news_block_main_page_block( $post ) {
			global $post;
			ob_start();
			echo '
				<div id="news_main_page" class="pl-lg-4">
					<h2>Новости</h2>';		
								
								$args = array( 'posts_per_page' => 0 , 'category' => 4 , 'orderby'  => 'date', 'order'  => 'DESC' );
								$newsposts = get_posts( $args );
								foreach( $newsposts as $post ){ setup_postdata($post);										
										echo '<div class="row">';
											echo '<div class="col-12 col-sm-4 col-md-3"><a href="'. get_permalink().'" class="image">'. get_the_post_thumbnail($page->ID, array(119,68) ). '</a></div>';
											echo '<div class="col-12 col-sm-8 col-md-9 pl-sm-4 pl-md-5 pl-lg-0"><span class="d-inline-block grey">'. get_the_date() .'</span>';
											echo '<p>'. get_the_content(). '</p></div>';
										echo '</div>';									
								}
								wp_reset_postdata();
																
			echo '</div>';
			$output_string=ob_get_contents();
			ob_end_clean();  
			return $output_string;
}

//Регистрируем шорткод
add_shortcode( 'news_block_main_page', 'news_block_main_page_block' );

//шорткод hello world
function hello_world_block( $post ) {
			global $post;
			ob_start();
			echo '<div class="test-shortcode">Hello Wordl!</div>';
			$output_string=ob_get_contents();
			ob_end_clean();  
			return $output_string;
}
//Регистрируем шорткод
add_shortcode( 'hello_world', 'hello_world_block' );

/*подключаем woocomerce*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
}

/**Добавляем поддержку галереи Woocommerce**/
add_action( 'after_setup_theme', 'yourtheme_setup' );
function yourtheme_setup() {
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}

//удаляем сортировку
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//удаляем количество товара 
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );

/*end woocommerce*/

//публикуем запланированные записи
function publish_future_posts_immediately($post_id, $post) {
global $wpdb;
if ( $post->post_status == 'future' ) {
$wpdb->update($wpdb->posts, array( 'post_status' => 'publish' ), array( 'ID' => $post_id ));
wp_clear_scheduled_hook('publish_future_post', $post_id);
}
}
add_action('save_post', 'publish_future_posts_immediately', 10, 2);
 
 //уберем теги br,p добавляемые WP автоматом
remove_filter( 'the_content', 'wpautop' );// для контента
remove_filter( 'the_excerpt', 'wpautop' );// для анонсов
remove_filter( 'comment_text', 'wpautop' );// для комментарий

?>