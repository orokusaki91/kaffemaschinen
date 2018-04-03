<!-- Catalog Categories - start -->
<div class="section-sb-current">
	<h3><a href="{{ route('all.category.view') }}">Kategorie <span id="section-sb-toggle" class="section-sb-toggle"><span class="section-sb-ico"></span></span></a></h3>

	<ul class="section-sb-list" id="section-sb-list">
		@include('front.layouts.category-tree-categories', ['categories', $categories])
	</ul>
</div>
<!--
<div class="section-filter-price">
	<div class="price-inputs">
		<input type="hidden" name="price_from" value="{{ old('price_from') }}">
		<input type="hidden" name="price_to" value="{{ old('price_to') }}">
	</div>
	<div class="section-filter-price" id="range-slider" data-prefix="CHF " data-grid="false"></div>
</div>
-->

