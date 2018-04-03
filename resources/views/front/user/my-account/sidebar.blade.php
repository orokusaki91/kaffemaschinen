<div class="col-sm-3 col-sm-offset-2 vertical-menu">
    <div class="section-sb profile_section-sb">
        <div class="section-sb-current">
            <ul class="section-sb-list profile_section-sb-list" id="section-sb-list">

                <li class="categ-1">
                    <a href="{{ route('my-account.home') }}"><span class="categ-1-label">{{ __('front.account-overview') }}</span></a>
                </li>

                <li class="categ-1">
                    <a href="{{ route('my-account.edit') }}"><span class="categ-1-label">{{ __('front.account-edit-account') }}</span></a>
                </li>
                <li class="categ-1">
                    <a href="{{ route('my-account.orders') }}"><span class="categ-1-label">{{ __('front.account-my-order') }}</span></a>
                </li>

                <li class="categ-1">
                    <a href="{{ route('my-account.address.index') }}"><span class="categ-1-label">{{ __('front.address') }}</span></a>
                </li>

                <li class="categ-1">
                    <a href="{{ route('my-account.change-password') }}"><span class="categ-1-label">{{ __('front.account-change-password') }}</span></a>
                </li>

                <li class="categ-1">
                    <a href="{{ route('logout') }}"><span class="categ-1-label">{{ __('front.account-logout') }}</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>

