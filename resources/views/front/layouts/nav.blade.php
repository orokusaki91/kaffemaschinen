<!-- Main menu - start -->
<button type="button" class="mainmenu-btn">Menu</button>

<ul class="mainmenu">
    <li>
        <a href="{{ route('home') }}" class="{{ $menu_home or ''  }}">
            Home
        </a>
    </li>
    @foreach($navs as $nav)
        <?php $childCategories = $nav['children']; ?>
        <li class="{{ count($childCategories) > 0 ? 'nav' : '' }}">
            <a href="" class="{{ $__env->yieldContent('nav_active_category') == $nav->slug ? 'active' : '' }}">{{ $nav->name }} {{ count($childCategories) > 0 ? '&#9662;' : '' }}</a>
            @if(count($childCategories) > 0)
                <ul class="nav">
                    @foreach($childCategories as $childCategory)
                        <li>
                            <a href="{{ url('shop?slug=' . $childCategory->slug) }}">{{ $childCategory->name }} </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
    <li>
        <a href="{{ route('page.partner') }}" class="">
            Partner
        </a>
    </li>
</ul>
<!-- Main menu - end -->


