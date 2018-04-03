<div class="image-preview">
    <div class="actual-image-thumbnail">
        <img id="{{ $tmp }}" class="img-thumbnail img-tag img-responsive" src="{{ $image->smallUrl }}"/>
        <input type="hidden" name="image[{{ $tmp }}][path]" value="{{ $image->relativePath }}"/>
        <input type="hidden" class="is_main_image_hidden_field" name="image[{{ $tmp }}][is_main_image]" value="0"/>

    </div>
    <div class="image-info">
        <div class="image-title">
        </div>
        <div class="actions">
            <div class="action-buttons pull-right">

                <button type="button"
                        class="btn is_main_image_button  selected-icon"
                        title="Select as Main Image">
                        <i class="oi oi-check"></i>
                </button>
                <button type="button" class="destroy-image btn btn-xs btn-default" title="Remove file" >
                    <i class="oi oi-trash text-danger"></i>
                </button>
            </div>

            <label>
                <input type="radio" style="display: none;"  name="{{$tmp}}" class="radio">
                <a onclick="effect('{{$tmp}}','black_white')" type="button" >
                    <i class="fas fa-adjust"></i>
                </a>
            </label>
            <label>
                <input type="radio" style="display: none;"  name="{{$tmp}}" class="radio">
                <a onclick="effect('{{$tmp}}','brightness')" type="button" >
                    <i class="fas fa-sun"></i>
                </a>
            </label>
            <label>
                <input type="radio" style="display: none;"  name="{{$tmp}}" class="radio">
                <a onclick="effect('{{$tmp}}','contrast')" type="button" >
                    <i class="fas fa-moon"></i>
                </a>
            </label>
            <label>
                <input type="radio" style="display: none;"  name="{{$tmp}}" class="radio">
                <a onclick="effect('{{$tmp}}','none')" type="button" >
                    <i class="fas fa-ban"></i>
                </a>
            </label>

            <input type="hidden" name="filters[{{$tmp}}]" id="final_effect_{{ $tmp }}" value="none">

        </div>
    </div>
</div>