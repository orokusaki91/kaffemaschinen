<?php

namespace App\DataGrid;

use App\DataGrid\Columns\ImageColumn;
use App\DataGrid\Columns\LinkColumn;
use App\DataGrid\Columns\OnlineColumn;
use App\DataGrid\Columns\TextColumn;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Manager
{
    public $request;
    public $data;
    public $model;
    public $columns = NULL;

    protected $pageItem = 10;
    protected $defaultOrder = ['field' => 'id', 'keyword' => 'asc'];
    protected $orderByDisabled = false;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->columns = Collection::make([]);
    }

    public function model($model)
    {
        $this->model = $model;
        return $this;
    }

    public function column($identifier, $option = []) {
        $column = new TextColumn($identifier, $option);
        $this->columns->put($identifier, $column);

        return $this;
    }

    public function setDefaultOrder($orderBy) {
        $this->defaultOrder = $orderBy;
        return $this;
    }

    public function disableDefaultOrderBy() {
        $this->orderByDisabled = true;
        return $this;
    }

    public function setPagination($item = 10) {
        $this->pageItem = $item;
        return $this;
    }

    public function render() {
        if (null !== $this->request->get('asc')) {
            $this->model->orderBy($this->request->get('asc'), 'asc');
        }

        if (null !== $this->request->get('desc')) {
            $this->model->orderBy($this->request->get('desc'), 'desc');
        }

        if ($this->orderByDisabled == false) {
            if ($this->request->get('asc') == null && $this->request->get('desc') == null) {
                $this->model->orderBy($this->defaultOrder['field'], $this->defaultOrder['keyword']);
            }
        }

        $this->data = $this->model->paginate($this->pageItem);

        return view('admin.datagrid.grid')
                    ->with('dataGrid', $this);
    }

    public function asc($identifier = "") {
        return (NULL !== $this->request->get('asc') && $this->request->get('asc') == $identifier);
    }

    public function desc($identifier = "") {
        return (NULL !== $this->request->get('desc') && $this->request->get('desc') == $identifier);
    }

    public function linkColumn($identifier, $options , $callback) {

        $column = new LinkColumn($identifier, $options ,$callback);
        $this->columns->put($identifier, $column);

        return $this;
    }

    public function onlineColumn($identifier, $options) {
        $column = new OnlineColumn($identifier, $options);
        $this->columns->put($identifier, $column);

        return $this;
    }

    public function imageColumn($identifier, $options) {

        $column = new ImageColumn($identifier, $options);
        $this->columns->put($identifier, $column);

        return $this;
    }

    public function dataTableData($model) {
        $this->model = $model;
        return $this;
    }

    public function get()
    {
        $count = $this->model->get()->count();

        $columns = $this->request->get('columns');

        $orders = $this->request->get('order');

        $order = $orders[0];

        $records = $this->model->orderBy($columns[$order['column']]['name'], $order['dir']);

        $noOfRecord = $this->request->get('length');
        $noOfSkipRecord = $this->request->get('start');

        $records->skip($noOfSkipRecord)->take($noOfRecord);

        $allRecords = $records->get();

        if (isset($this->columns) && $this->columns->count() > 0) {
            $jsonRecords = Collection::make([]);

            foreach ($allRecords as $i => $singleRecord) {
                foreach ($this->columns as $key => $columnData) {
                    if (is_callable($columnData)) {
                        $columnValue = $columnData($singleRecord);
                    } else {
                        $columnValue = $columnData;
                    }

                    $singleRecord->setAttribute($key, $columnValue);
                }

                $jsonRecords->put($i, $singleRecord);
            }
        }

        $data = [
            "data" => (isset($jsonRecords)) ? $jsonRecords : $allRecords,
            "draw" => $this->request->get('draw'),
            "recordsTotal" => $count,
            "recordsFiltered" => $count
        ];

        return JsonResponse::create($data);
    }

    public function addColumn($columnKey, $data) {
        if (NULL === $this->columns) {
            $this->columns = Collection::make([]);
        }
        $this->columns->put($columnKey, $data);
        return $this;
    }
}