<div class="row">
    <div class="col-lg-6 col-sm-12">
        @include('admin.forms.text',['name' => 'name','label' => 'Name'])
    </div>
    <div class="col-lg-6 col-sm-12">
        @if(!isset($productCategories))
            <?php $productCategories = []; ?>
        @endif

        @include('admin.forms.select2',['name' => 'category_id[]',
                                                'label' => __('lang.category'),
                                                'attributes' => ['class' => 'form-control select2',
                                                                'id' => 'category_id',
                                                                'multiple' => true,
                                                                ],
                                                'options' => $categoryOptions,
                                                'values' => $productCategories])


    </div>
</div>


<div class="row">
    <div class="col-lg-6 col-sm-12">
        @if(isset($editMethod) && $editMethod)
            @include('admin.forms.text',['name' => 'slug','label' => __('lang.slug')])
        @endif
    </div>
    
    <div class="col-lg-6 col-sm-12">
        @include('admin.forms.select',['name' => 'status','label' => 'Status', 'options' => ['1' => "Online",'0' => "Offline"]])
    </div>
</div>

@include('admin.forms.textarea',['name' => 'description','label' => __('lang.description'),
                                            'attributes' => ['class' => 'ckeditor','id' => 'description']])

<div class="row">
    <div class="col-lg-6 col-sm-12">
        @include('admin.forms.text',['name' => 'price','label' => __('lang.order-price')])
    </div>
    <div class="col-lg-6 col-sm-12">
        @include('admin.forms.select',['name' => 'pdv', 'label' => __('lang.pdv'), 'options' => ['2.5' => '2.5%', '7.7' => '7.7%']])
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        @include('admin.forms.select',['name' => 'discount','label' => __('lang.discount'), 'options' => ['1' => "Ja",'0' => "Nein"]])
    </div>
    <div class="col-lg-6 col-sm-12">
        @include('admin.forms.text',['name' => 'discount_price', 'label' => __('lang.discount-price')])
    </div>
</div>

<div class="row">
    <div class="col-lg-1 col-sm-12">
        <div class="form-group">
            <label for="has_packaging">{{ __('lang.has-packaging') }}</label>
            <div class="checkbox">
                <label style="margin-left: 20px;">
                    <input id="has_packaging_toggle" name="has_packaging_toggle" type="checkbox" data-toggle="toggle" data-on="{{ __('front.yes') }}" data-off="{{ __('front.no') }}" @if ($model['has_packaging'] === 1) checked @endif>
                    <input hidden id="has_packaging" type="number" name="has_packaging" value="{{ $model['has_packaging'] }}" />
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-12">
        @include('admin.forms.text',['name' => 'packaging','label' => __('lang.packaging')])
    </div>
    <div class="col-lg-3 col-sm-12">
        <div class="form-group">
            <label for="new_product">{{ __('lang.available').' / '.__('lang.unavailable') }}</label>
            <div class="checkbox">
                <label style="margin-left: 20px;">
                    <input id="available_toggle" name="available_toggle" type="checkbox" data-toggle="toggle" data-on="{{ __('front.yes') }}" data-off="{{ __('front.no') }}" @if ($model['available'] === 1) checked @endif>
                    <input hidden id="available" type="number" name="available" value="{{ $model['available'] }}" />
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-sm-12">
        <div class="form-group">
            <label for="unavailable_text" >{{ __('lang.message') }}</label>
            <input type="text" class="form-control" id="unavailable_text" name="unavailable_text" {{ $model['available'] ? 'disabled' : '' }} value="{{ $model['unavailable_text'] }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-sm-12">
        <div class="form-group">
            <label for="new_product">{{ __('lang.new-product') }}</label>
            <div class="checkbox">
                <label style="margin-left: 20px;">
                    <input id="new_toggle" name="new_product_toggle" type="checkbox" data-toggle="toggle" data-on="{{ __('front.yes') }}" data-off="{{ __('front.no') }}" @if ($model['new_product'] === 1) checked @endif>
                    <input hidden id="new_product" type="number" name="new_product" value="{{ $model['new_product'] }}" />
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="form-group">
            <label for="hit_product">{{ __('lang.hit-product') }}</label>
            <div class="checkbox">
                <label style="margin-left: 20px;">
                    <input id="hit_toggle" name="hit_product_toggle" type="checkbox" data-toggle="toggle" data-on="{{ __('front.yes') }}" data-off="{{ __('front.no') }}" @if ($model['hit_product'] === 1) checked @endif>
                    <input hidden id="hit_product" type="number" name="hit_product" value="{{ $model['hit_product'] }}" />
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="form-group">
            <label for="contact_only">{{ __('lang.contact-only') }}</label>
            <div class="checkbox">
                <label style="margin-left: 20px;">
                    <input id="contact_only_toggle" name="contact_only_toggle" type="checkbox" data-toggle="toggle" data-on="{{ __('front.yes') }}" data-off="{{ __('front.no') }}" @if ($model['contact_only'] === 1) checked @endif>
                    <input hidden id="contact_only" type="number" name="contact_only" value="{{ $model['contact_only'] }}" />
                </label>
            </div>
        </div>
    </div>
</div>
