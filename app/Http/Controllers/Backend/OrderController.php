<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\DroppedOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutForDeliveryOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order      =       Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Delete specific resource from storage
     */
    public function destroy(string $id)
    {
        $order      =       Order::findOrFail($id);

        // delete order product
        $order->orderProducts()->delete();
        // delete transaction
        $order->transaction()->delete();

        // delete order now
        $order->delete();
    }

    /**
     * Change the status of the order
     */
    public function changeOrderStatus(Request $request)
    {
        $order      =       Order::findOrFail($request->id);
        $order->order_status        =       $request->status;
        $order->save();
        return response(['status' => 'success', 'message' => 'order status updated successfully!']);
    }

    /**
     * Change the status of the payment
     */
    public function changePaymentStatus(Request $request)
    {
        $order      =       Order::findOrFail($request->id);
        $order->payment_status      =       $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'payment status changed successfully!']);
    }

    /**
     * Display all pending orders
     */
    public function pendingOrder(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-order');
    }


    /**
     * Display all processed orders
     */
    public function orderProcessed(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed-order');
    }

    /**
     * Display all dropped off orders
     */
    public function orderDroppedOff(DroppedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped-off');
    }

    /**
     * Display all shipped orders
     */
    public function orderShipped(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped');
    }

    /**
     * Display all out for delivery orders
     */
    public function orderOutForDelivery(OutForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out-for-delivery');
    }

    /**
     * Display all delivered orders
     */
    public function orderDelivered(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered');
    }
    /**
     * Display all canceled orders
     */
    public function orderCanceled(CanceledOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.canceled');
    }
}
