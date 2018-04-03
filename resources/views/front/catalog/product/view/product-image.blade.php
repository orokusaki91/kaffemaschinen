<?php
$image = $product->image;
$imageType = (isset($imageType)) ? $imageType : "smallUrl";
$filter = !is_null($product->main_image) ? $product->main_image->filters : "";
?>
@if(NULL !== $image)
    <img alt="{{ $product->title }}" class="{{ $filter }}"
         src="{{ $image->$imageType }}"/>
@endif