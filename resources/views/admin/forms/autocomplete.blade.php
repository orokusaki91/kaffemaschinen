<?php

$value = "";
if(old($name)) {
    $value = old($name);
}  elseif(isset($model) && $model->$name) {
    $value = $model->$name;
}

if(isset($attributes)) {
    $attributes['name'] = $name;
    $attributes['type'] = "text";
    if(!isset($attributes['id'])) {
        $attributes['id'] = $name;
    }
    $attributes['value'] = $value;

} else {
    $attributes['type'] = "text";
    $attributes['class'] = 'form-control autocomplete-input';
    $attributes['id'] = $name;
    $attributes['name'] = $name;
    $attributes['value'] = $value;

}
$attrString = "";

foreach($attributes as $attrKey => $attrValue) {
    $attrString .= "{$attrKey}=\"{$attrValue}\"";
}

?>

<div class="form-group">
    @if(isset($label))
        <label for="{{ $name }}" >{{ $label }}</label>
    @endif
    <script>
        function addProductToPackage(self) {
            var token = jQuery(self).attr('data-token');
            var id = jQuery(self).attr('data-id');
            var data = {_token: token, id: id};

            jQuery.ajax({
                url: '{{ URL::to("/admin/package/getSingleProduct")}}',
                data: data,
                type: 'post',
                success: function (response) {
                    $('.autocomplete-drop').html('');
                    $('.autocomplete-input').attr('value', '');
                    $('.autocomplete-input').val('');

                    $('.product-list').append('<div class="product-item-wrapper"><div class="product-item"><img src="' + response.image.smallUrl + '"/><input type="hidden" name="products[]" class="product-id" value="' + response.id + '" /><button type="button" name="delete-product" class="btn btn-xs btn-default delete-product" onclick="removeProduct(this)"><i class="oi oi-trash text-danger"></i></button></div></div>');
                }
            });
        }
    </script>
    <div class="autocomplete">
        <input placeholder="{{  __('front.product-search-products') }}" data-token="{{ csrf_token() }}" {!! $attrString !!}>
        <div class="autocomplete-drop"></div>
    </div>
</div>



@push('styles')
    <style>
        .autocomplete {
            position: relative;
            width: 100%;
        }
        .autocomplete > .autocomplete-drop {
            position: absolute;
            width: 100%;
            top: 37px;
            display: none;
            color: #495057;
            background-color: #fff;
            background-image: none;
            background-clip: padding-box;
            border: 1px solid #D9D9D9;
            border-radius: .25rem;
            max-height: 258px;
            overflow: auto;
        }
        .autocomplete > .autocomplete-drop > .autocomplete-item {
            cursor: pointer;
            height: 64px;
            width: 100%;
            padding: 4px;
        }
        .autocomplete > .autocomplete-drop > .autocomplete-item:hover {
            background-color: #eee;
        }
        .autocomplete > .autocomplete-drop > .autocomplete-item > .autocomplete-item-image {
            float: left;
            height: 56px;
            width: 56px;
            margin-right: 4px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border: 1px solid #D9D9D9;
            border-radius: .25rem;
        }
        .autocomplete > .autocomplete-drop > .autocomplete-item > .autocomplete-item-info {
            float: left;
            height: 56px;
            width: 56px;
            width: calc(100% - 176px);
            margin-right: 4px;
            padding-left: 4px;
        }
        .autocomplete > .autocomplete-drop > .autocomplete-item > .autocomplete-item-info > .line {
            height: 28px;
            line-height: 28px;
        }
        .autocomplete > .autocomplete-drop > .autocomplete-item > .autocomplete-item-info > .line:first-of-type {

        }
        .autocomplete > .autocomplete-drop > .autocomplete-item > .autocomplete-item-info > .line:last-of-type {
            font-size: 12px;
            color: #acadae;
        }
        .autocomplete > .autocomplete-drop > .autocomplete-item > .autocomplete-item-price {
            float: left;
            height: 56px;
            width: 112px;
            line-height: 56px;
            font-weight: 700;
            font-size: 16px;
            color: red;
            font-family: "Nexa Light", sans-serif;
            text-align: right;
            padding-right: 8px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(function() {
            var queryLength;
            $('.autocomplete-input').keyup(function (e) {
                var query = this.value;
                queryLength = this.value.length;

                var token = jQuery(e.target).attr('data-token');
                var data = {_token: token, query: query};
                if (queryLength > 3) {
                    jQuery.ajax({
                        url: '{{ URL::to("/admin/package/searchProducts")}}',
                        data: data,
                        type: 'post',
                        success: function (response) {
                            $('.autocomplete-drop').html('');
                            $('.autocomplete-drop').show();

                            for (var product in response) {
                                $('.autocomplete-drop').append('<div data-token="' + token + '" class="autocomplete-item" onmousedown="addProductToPackage(this)" data-id="' + response[product].id + ')"><div class="autocomplete-item-image" style="background-image: url(' + response[product].image.smallUrl + ');"></div><div class="autocomplete-item-info"><div class="line">' + response[product].name + '</div><div class="line">' + response[product].slug + '</div></div><div class="autocomplete-item-price">CHF ' + response[product].price + '</div></div>');
                            }
                        }
                    });
                } else {
                    $('.autocomplete-drop').hide();
                }
            });

            $('.autocomplete-input').blur(function (e) {
                $('.autocomplete-drop').hide();
            });

            $('.autocomplete-input').focus(function (e) {
                if (queryLength > 3) {
                    $('.autocomplete-drop').show();
                }
            });
        });
    </script>
@endpush