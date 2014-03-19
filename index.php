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
	$jobs .= '<script src="http://risq.github.com/jquery-advanced-news-ticker/jquery.newsTicker.js"></script>';
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
add_shortcode('showjobs','get_jobman_jobs');
add_filter('widget_text', 'do_shortcode', 11);
?>