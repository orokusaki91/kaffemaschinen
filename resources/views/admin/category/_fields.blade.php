
@include('admin.forms.text',['name' => 'name' ,'label' => __('lang.category-name')])
@include('admin.forms.text',['name' => 'slug' ,'label' => 'Kategorie-Link'])
@include('admin.forms.select',['name' => 'parent_id' ,'label' => __('lang.category-parent-category'), 'options' => $categoryOptions])


@push('scripts')
<script>

    $(function() {

        var field1Selector = "#name";
        var field2Selector = "#slug";

        var buttonSelector = ".category-save-button";

        function checkFields() {
            var field1Value = jQuery(field1Selector).val();
            var field2Value= jQuery(field2Selector).val();


            if(field1Value != "" && field2Value  != "") {
                jQuery(buttonSelector).attr('disabled', false);
                jQuery(buttonSelector).addClass('btn-primary');
            } else {
                jQuery(buttonSelector).attr('disabled', true);
                jQuery(buttonSelector).removeClass('btn-primary');
            }
        }
        jQuery(document).on('keyup', '#name , #slug', function(e){
            checkFields();
        });

        jQuery(document).on('change', '#name, #slug', function(e){
            checkFields();
        });
        checkFields();
    });
</script>
@endpush