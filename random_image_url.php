<?php

/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Shortcode [random_image_url]
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>Shortcode</strong> To fetch a random image URL based off IDs
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

/**
 *  Matches {{random_image_url:4,67,1,73,2}}
 * 
 * or via shortcode with:
 * 
 * [random_image_url ids="4,67,1,73,2"]
 * 
 * CSV of image IDs.
 */

add_shortcode('random_image_url', 'random_image_url_shortcode_code');

    
function random_image_url_shortcode_code($atts, $content, $shortcode_tag)
{
    $code = '{{random_image_url:'.$atts['ids'].'}}';
    $url = random_image_url($code);
    return $url;
}

function random_image_url($code)
{

    preg_match_all('/{{random_image_url:(.*)}}/', $code, $image_ids);

    if (empty($image_ids[0])){ return $code; }

    $ids = explode(',', $image_ids[1][0]);

    $random_key = array_rand($ids);

    $image_src = wp_get_attachment_image_src($ids[$random_key], 'full');

    if (!is_array($image_src)){ return $code; }

    $code = str_replace($image_ids[0][0], $image_src[0], $code);

    return $code;

}