<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Creative;
use App\Models\Vendor;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Validator;
// use Carbon\Carbon;

class VendorController extends Controller
{

    public function fetchFineArtPrintByVendorID($vendorId)
    {

        $returnData = [];
        $returnData["orders"] = [];
        $returnData['print_line_items'] =[];

        $orders = \App\Models\Order::where('user_id', '=', $vendorId)->orderBy('user_id', 'ASC')->get(
            [
                'orders.id AS external_order_id',
                'orders.first_name AS buyer_first_name',
                'orders.last_name AS buyer_last_name',
                'orders.address_1 AS buyer_shipping_address_1',
                'orders.address_2 AS buyer_shipping_address_2', 
                'orders.city AS buyer_shipping_city', 
                'orders.state AS buyer_shipping_state', 
                'orders.postal_code AS buyer_shipping_postal', 
                'orders.country AS buyer_shipping_country', 
            'orders.*']
        );

        if(empty($orders[0])){
            return response(['data' => $returnData, 'message' => 'orders, orderLineItem and creative data', 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }

        foreach ($orders as $order){ 
            $temp["external_order_id"] = $order->external_order_id;
            $temp["buyer_first_name"] = $order->buyer_first_name;
            $temp["buyer_last_name"] = $order->buyer_last_name;
            $temp["buyer_shipping_address_1"] = $order->buyer_shipping_address_1;
            $temp["buyer_shipping_address_2"] = $order->buyer_shipping_address_2;
            $temp["buyer_shipping_city"] = $order->buyer_shipping_city;
            $temp["buyer_shipping_state"] = $order->buyer_shipping_state;
            $temp["buyer_shipping_postal"] = $order->buyer_shipping_postal;
            $temp["buyer_shipping_country"] = $order->buyer_shipping_country;

            array_push($returnData["orders"], $temp);
 
            $orderLineItems = \App\Models\OrderLineItem::where('order_id', '=', $order->external_order_id)->orderBy('quantity', 'ASC')->get(
                [
                    'order_line_items.id AS external_order_line_item_id',
                'order_line_items.*']
            );
           
            if(!empty($orderLineItems)){
                foreach ($orderLineItems as $orderLineItem){
                    $temp2['external_order_line_item_id'] = $orderLineItem->external_order_line_item_id;
                    $temp2['product_id'] = $orderLineItem->product_id;
                    $temp2['quantity'] = $orderLineItem->quantity;

                    $creatives = \App\Models\Creative::where('user_id', '=', $vendorId)->orderBy('id', 'ASC')->take(1)->get();
                    $temp2['image_url'] = $creatives[0]->image_url;
                    array_push($returnData["print_line_items"], $temp2);
                }
            }

        } 
          

        return response(['data' => $returnData, 'message' => 'orders, orderLineItem and creative data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function fetchFineArtPrintByVendorName(Request $request)
    {
        $returnData = [];
        $returnData["orders"] = [];
        $returnData['print_line_items'] =[];

        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }


        $input = $request->all();
        $vendor_name = $input['vendor_name'];

        $vendor = \App\Models\Vendor::where('name', '=', $vendor_name)->get();

        if(empty($vendor[0])){
            return response(['data' => $returnData, 'message' => 'orders, orderLineItem and creative data', 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }

        $orders = \App\Models\Order::where('user_id', '=', $vendor[0]->id)->orderBy('user_id', 'ASC')->get(
            [
                'orders.id AS external_order_id',
                'orders.first_name AS buyer_first_name',
                'orders.last_name AS buyer_last_name',
                'orders.address_1 AS buyer_shipping_address_1',
                'orders.address_2 AS buyer_shipping_address_2', 
                'orders.city AS buyer_shipping_city', 
                'orders.state AS buyer_shipping_state', 
                'orders.postal_code AS buyer_shipping_postal', 
                'orders.country AS buyer_shipping_country', 
            'orders.*']
        );

        if(empty($orders)){
            return response('Vendor ID does not exit', env('HTTP_SERVER_CODE_BAD_REQUEST'));
        }

        foreach ($orders as $order){ 
            $temp["external_order_id"] = $order->external_order_id;
            $temp["buyer_first_name"] = $order->buyer_first_name;
            $temp["buyer_last_name"] = $order->buyer_last_name;
            $temp["buyer_shipping_address_1"] = $order->buyer_shipping_address_1;
            $temp["buyer_shipping_address_2"] = $order->buyer_shipping_address_2;
            $temp["buyer_shipping_city"] = $order->buyer_shipping_city;
            $temp["buyer_shipping_state"] = $order->buyer_shipping_state;
            $temp["buyer_shipping_postal"] = $order->buyer_shipping_postal;
            $temp["buyer_shipping_country"] = $order->buyer_shipping_country;

            array_push($returnData["orders"], $temp);
 
            $orderLineItems = \App\Models\OrderLineItem::where('order_id', '=', $order->external_order_id)->orderBy('quantity', 'ASC')->get(
                [
                    'order_line_items.id AS external_order_line_item_id',
                'order_line_items.*']
            );
           
            if(!empty($orderLineItems)){
                foreach ($orderLineItems as $orderLineItem){
                    $temp2['external_order_line_item_id'] = $orderLineItem->external_order_line_item_id;
                    $temp2['product_id'] = $orderLineItem->product_id;
                    $temp2['quantity'] = $orderLineItem->quantity;

                    $creatives = \App\Models\Creative::where('user_id', '=', $vendor[0]->id)->orderBy('id', 'ASC')->take(1)->get();
                    $temp2['image_url'] = $creatives[0]->image_url;
                    array_push($returnData["print_line_items"], $temp2);
                }
            }

        } 
          

        return response(['data' => $returnData, 'message' => 'orders, orderLineItem and creative data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

}
