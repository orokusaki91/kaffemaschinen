@include('admin.forms.text', ['name' => 'first_name', 'label' => __('lang.first-name')])
@include('admin.forms.text', ['name' => 'last_name', 'label' => __('lang.last-name')])

@if($editMethod == true)
    <?php $attributes = ['disabled' => true, 'class' => 'form-control', 'id' => 'email']; ?>
@else
    <?php $attributes = ['class' => 'form-control', 'id' => 'email']; ?>
@endif

@include('admin.forms.text', ['name' => 'email', 'label' => 'Email', 'attributes' => $attributes])

@if($editMethod == false)
    @include('admin.forms.password', ['name' => 'password', 'label' => __('lang.admin-password-label')])
    @include('admin.forms.password', ['name' => 'password_confirmation', 'label' => __('lang.confirm-password')])
@endif

@include('admin.forms.select', ['name' => 'role_id', 'label' => __('lang.user-role'), 'options' => $roles])