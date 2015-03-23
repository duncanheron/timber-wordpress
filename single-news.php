<?php
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

// check if post has header media
if($context['post']->news_image) {
    $header_media_image = responsive_img(
        $context['post']->news_image,
        'page_header_media',
        '',
        'section_media_thumb'
    );
    $context['header_media_image'] = $header_media_image;
}

$related_args = array(
    'post_type'         => 'fb_wp_news',
    'post_status'       => 'publish',
    'order'             => 'DESC',
    'orderby'           => 'date',
    'post__not_in'      => array($post->id),
    'posts_per_page'    => 5
);
$context['relateds'] = Timber::get_posts($related_args);

Timber::render('news-view.twig', $context);
