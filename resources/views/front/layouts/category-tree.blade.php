<?php foreach ($categories as $category): ?>

<?php $childCategories = $category['children']; ?>


@if(count($childCategories) > 0)
    <li>
        <a
           href="{{ url('shop?slug=' . $category['object']->slug) }}"
           title="{{ $category['object']->name }}">
            {{ $category['object']->name }}
        </a>
        <i class="fa fa-angle-right"></i>
@else

    <li class="">
        <a
           href="{{ url('shop?slug=' . $category['object']->slug) }}"
           title="{{ $category['object']->name }}">
            {{ $category['object']->name }}
        </a>
        @endif


        <?php while (true): ?>

        <?php if ($category['object'] == NULL): ?>
            <?php break ?>
        <?php endif; ?>

        <?php
        $slug = $category['object']->slug;
        $name = $category['object']->name;
        $category['object'] = NULL;
        ?>
        <?php if (count($childCategories) > 0): ?>
        <ul>
            @include('front.layouts.category-tree',['categories' => $childCategories])
        </ul>
        <?php endif; ?>
        <?php endwhile; ?>
    </li>
    <?php endforeach; ?>