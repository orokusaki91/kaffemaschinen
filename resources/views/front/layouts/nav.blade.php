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
        <li>
            <!-- <a href="{{ URL::to('shop?slug=' . $nav->slug) }}" class="{{ $__env->yieldContent('nav_active_category') == $nav->slug ? 'active' : '' }}">
                {{ $nav->name }};
            </a> -->
            <li class="{{ count($childCategories) > 0 ? 'dropdown' : '' }}">
                
                <a href="#" class="{{ $__env->yieldContent('nav_active_category') == $nav->slug ? 'active' : '' }}">{{ $nav->name }} {{ count($childCategories) > 0 ? '&#9662;' : '' }}</a>
                @if(count($childCategories) > 0)
                    <ul class="dropdown-menu">
                        @foreach($childCategories as $childCategory)
                            <li>
                                <a href="{{ url('shop?slug=' . $childCategory->slug) }}">{{ $childCategory->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        </li>
    @endforeach
    <li>
        <a href="{{ route('page.partner') }}" class="">
            Partner
        </a>
    </li>
</ul>
<!-- Main menu - end -->


