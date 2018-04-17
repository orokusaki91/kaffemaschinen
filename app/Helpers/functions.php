<?php

function getOrderBy() {
	return [
		'name_asc' => __('front.name_asc'),
		'name_desc' => __('front.name_desc'),
		'price_asc' => __('front.price_asc'),
		'price_desc' => __('front.price_desc'),
		'created_at_desc' => __('front.created_at_desc'),
		'created_at_asc' => __('front.created_at_asc'),
	];
}

function getOrderByParameter($str) {
    if (strpos($str, 'asc') !== false) {
        return 'asc';
    }

    return 'desc';
}

function getAfterLastChar($str, $char) {
    return substr($str, strrpos($str, $char) + 1);
}

function getBeforeLastChar($str, $char) {
    return substr($str, 0, strrpos( $str, $char));
}

function getshowNumbers() {
    return ['12', '24', '48'];
}

function getForegroundColor($backgroundColor)
{
    list($r, $g, $b) = sscanf($backgroundColor, "#%02x%02x%02x");
    $coefficient = ($r * 0.299) + ($g * 0.587) + ($b * 0.114);
    return $coefficient > 176 ? "#000000" : "#ffffff";
}

function getStripePublishableKey() {
    if (app()->environment('local')) {
        return config('development.stripe.publishable_key');
    } else if (app()->environment('production')) {
        return config('stripe.publishable_key');
    }
}

?>