<?php

namespace App\Models\Database;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductCollection extends Collection
{
    protected $_collection = NULL;

    public function addCategoryFilter($categoryId)
    {
        $this->_collection = $this->_collection->filter(function ($product) use ($categoryId) {
           if ($product->categories->count() > 0 && $product->categories->pluck('id')->contains($categoryId)) {
               return $product;
           }
        });

        return $this;
    }

    public function paginateCollection($perPage = 10)
    {
        $request = request();
        $page = request('page');
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $this->_collection->slice($offset, $perPage), // Only grab the items we need
            count($this->_collection), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from url
        );

        $paginate = new LengthAwarePaginator($this->_collection, $perPage, $pageNumber);

        return $paginate;
    }

    public function setCollection($products)
    {
        $this->_collection = $products;
        return $this;
    }
}