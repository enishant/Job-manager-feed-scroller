<?php
/**
Plugin Name: Job manager feed scroller
Plugin URI: https://profiles.wordpress.org/enishant/
Description: Get Jobs added by plugin Job Manager and display them as scrolling text.
Tags: job-manager,job-feeds
Version: 1.0
Author: Nishant Vaity
Author URI: http://www.gravatar.com/enishant
License: GPL2
Git Reference : https://github.com/risq/jquery-advanced-news-ticker
*/

function get_jobman_jobs()
{
	$jobs_uid = uniqid('jobs_uid_');
	global $post;
	$posts = get_posts( 'post_type=jobman_job&numberposts=-1&post_status=publish' );
	$jobs .= '<div class="scroll-text">';
	$jobs .= '<ul id="' . $jobs_uid . '">';
	foreach ($posts as $post)
	{
		$jobs .= '<li><a href="' . $post->guid . '">' .$post->post_title . '</a></li>';
	}
	$jobs .= '</ul>';
	$jobs .= '</div>';
	$jobs .= '<script>';
	$jobs .= 'jQuery("#' . $jobs_uid . '").newsTicker({row_height: 150, max_rows: 1, speed: 600,direction: "up",duration: 4000,autostart: 1, pauseOnHover: 1});';
	$jobs .= '</script>';
	return $jobs;
}

function jobman_jobs_scripts() 
{
	wp_enqueue_script( 'jobman-jobs-newsTicker', plugins_url( 'jquery.newsTicker.js' , __FILE__ ));
}

add_shortcode('showjobs','get_jobman_jobs');
add_filter('widget_text', 'do_shortcode', 11);
add_action( 'wp_enqueue_scripts', 'jobman_jobs_scripts' );
?>
