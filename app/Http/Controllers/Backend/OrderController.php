<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function showOrders(Request $request,$status)
    {
        if(isset($request->search) && $status == "all"){
            $orders = Order::with('orderDetails')           
            ->where('phone','LIKE','%'.$request->search.'%')
            ->orWhere('invoice_number','LIKE','%'.$request->search.'%')
            ->orWhere('name','LIKE','%'.$request->search.'%')
            ->paginate(50);
        }

       else if(isset($request->search) && $status != "all"){
            $orders = Order::with('orderDetails')
            ->where('status',$status)
            ->where('phone','LIKE','%'.$request->search.'%')
            ->orWhere('invoice_number','LIKE','%'.$request->search.'%')
            ->orWhere('name','LIKE','%'.$request->search.'%')
            ->paginate(50);
        }
        else{
             if($status == "all"){
                $orders = Order::with('orderDetails')->paginate(50);
             }
             else{
                $orders = Order::with('orderDetails')->where('status',$status)->paginate(50);
             }
        }
        return view('backend.orders.show-orders',compact('orders','status'));
    }
    
    public function updateOrderStatus(Request $request,$id)
    {
        $orders = Order::find($id);
        $orders->status = $request->status;

        $orders->save();
        return redirect()->back();
    }

    public function orderDelete($id)
    {
        $orders = Order::find($id);
        $orderDetails = OrderDetails::where('order_id',$id)->get();
        foreach($orderDetails as $details){
            $details->delete();
        }
        $orders->delete();
        toastr()->success('Order deleted successfully');
        return redirect()->back();
        
    }

    public function editOrder($id)
    {
        $orders = Order::with('orderDetails')->where('id',$id)->first();    
        return view('backend.orders.edit-orders',compact('orders'));
    }

    public function updateOrder(Request $request,$id)
    {
        $order = Order::find($id);
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->charge = $request->charge;
        $order->address = $request->address;
        
        $order->courier_name = $request->courier_name;
        $order->price = $request->price;

        $order->save();
        toastr()->success('Updated successfully');
        return redirect()->back();

    }

    //courier...

    public function courierEntry($order_id)
    {
        $orders = Order::find($order_id);
        if($orders->courier_name == "steadfast"){
            
        $apiEndpoint = "https://portal.packzy.com/api/v1/create_order";
        $header = [
            'Api-Key' => "qwzgaqw0ghqo1zm8mdht1czgmpucswhr",
            'Secret-Key' => "j6uexh7rumnobjotms0uwygd",
            'Content-Type' => "application/json"
        ];

        //body parameters..
        $invoiceNumber = $orders->invoice_number;
        $customerName = $orders->name;
        $customerPhone = $orders->phone;
        $customerAddress = $orders->address;
        $amount = $orders->price;

        $payLoad = [
            'invoice' => $invoiceNumber,
            'recipient_name' => $customerName,
            'recipient_phone' => $customerPhone,
            'recipient_address' => $customerAddress,
            'cod_amount' => $amount
        ];
        $response = Http::withHeaders($header)->post($apiEndpoint,$payLoad);
        $jsonData = $response->json();
        // dd($jsonData);
        if(isset($jsonData['consignment'])){
            $orders->traking_code = $jsonData['consignment']['tracking_code'];
            $orders->consignment_id = $jsonData['consignment']['consignment_id'];
            $orders->save();
        }
        }

        elseif($orders->courier_name == "pathao"){

        }
        toastr()->success("Courier entry successfully");
        return redirect()->back();
    }

    public function updateOrderDetails(Request $request,$id)
    {
        $details = OrderDetails::find($id);

        $details->qty = $request->qty;
        $details->color = $request->color;
        $details->size = $request->size;

        $details->save();
        return response()->json('Updated Successfully');
    }
}
