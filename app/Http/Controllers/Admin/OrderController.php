<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Database\Order;
use App\Models\Database\OrderStatus;
use Illuminate\Http\Request;
use App\DataGrid\Facade as DataGrid;

class OrderController extends AdminController
{
    public function index(Request $request)
    {
        $delivery_type = $request->get('delivery_type');
        $delivery_status = intval($request->get('delivery_status'));
        if ($delivery_status == null) $delivery_status = '';
        $search = $request->get('search');

        $dataGrid = DataGrid::model(Order::query()
            ->where('payment_option', 'like', '%'.$delivery_type.'%')
            ->where('order_status_id', 'like', '%'.$delivery_status.'%')
            ->where(function($query) use ($search){
                $query->where('id', 'LIKE', '%'.$search.'%');
                $query->orWhere('created_at', 'LIKE', '%'.$search.'%');
                $query->orWhere('user_id', 'LIKE', '%'.$search.'%');
                $query->orWhere('payment_option', 'LIKE', '%'.$search.'%');
                $query->orWhereHas('orderStatus', function ($query2) use ($search) {
                    $query2->where('name', 'like', '%'.$search.'%');
                });
            })
        )->setDefaultOrder(['field' => 'id', 'keyword' => 'desc'])
                ->column('id', ['sortable' => true])
                ->column('created_at', ['label' => __('lang.date')])
                ->column('user_id', ['label' => __('lang.buyer-id')])
                ->linkColumn('order_status', ['label' => __('lang.order-shipping-option')], function($model) {
                    return $model->orderStatus->name;
                })
                ->linkColumn('view',['label' => __('lang.view')], function($model) {
                    return "<a href='". route('admin.order.view', $model->id)."' >".__('lang.view')."</a>";
                })
            ->setPagination(100);

        return view('admin.order.index')->with('dataGrid', $dataGrid);
    }

    public function view($id)
    {
        $order = Order::findorfail($id);
        $view = view('admin.order.view')
        ->with('order', $order);

        return $view;
    }

    public function changeStatus($id)
    {
        $order = Order::findorfail($id);

        $orderStatus = OrderStatus::all()->pluck('name', 'id');

        $view = view('admin.order.view')
            ->with('order', $order)
            ->with('orderStatus', $orderStatus)
            ->with('changeStatus', true);

        return $view;
    }

    public function updateStatus($id, UpdateOrderStatusRequest $request)
    {
        $order = Order::findorfail($id);
        $order->update($request->all());

        //$userEmail = $order->user->email;
        $orderStatusTitle = $order->orderStatus->name;

       // Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
