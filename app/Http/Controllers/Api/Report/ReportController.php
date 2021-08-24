<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerProductResource;
use App\Http\Resources\MovedProductResource;
use App\Http\Resources\NewProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function newProductReport(){
        return NewProductResource::collection(Product::where('storage_id')->get());
        //return NewProductResource::collection(Product::where('name', 'rrr')->get());
    }

    public function movedProductReport(Request $request){

        $finish = Product::where('storage_id', '>', 0);

        if($request->all()){
            if($request->only('name')){
                $finish = Product::where('storage_id', '>', 0)->where('name',$request->only('name'));
            }
            if($request->only('serial_number')){
                $finish = $finish->where('storage_id', '>', 0)->where('serial_number',$request->only('serial_number'));
            }
            if($request->only('inventory_number')){
                $finish = $finish->where('storage_id', '>', 0)->where('inventory_number',$request->only('inventory_number'));
            }
            if($request->only(['start_salary', 'end_salary'])){
                $finish = $finish->where('storage_id', '>', 0)->where('salary', '>', $request->only('start_salary'))->where('salary', '<', $request->only('end_salary'));
            }
            if($request->only(['start_reg_date', 'end_reg_date'])){
                $finish = $finish->where('storage_id', '>', 0)->where('created_at', '>', $request->only('start_reg_date'))->where('created_at', '<', $request->only('end_reg_date'));
            }
            if($request->only(['start_move_date', 'end_move_date'])){
                $finish = $finish->where('storage_id', '>', 0)->where('updated_at', '>', $request->only('start_move_date'))->where('updated_at', '<', $request->only('end_move_date'));
            }
        }else{
            //return MovedProductResource::collection(Product::where('storage_id', '>', 0)->get());
        }
        return MovedProductResource::collection($finish->get());

    }


    public function customerProductReport(Request $request){
        $user = auth()->user();
        $finish = Product::where('customer_id', $user->id);
        //return CustomerProductResource::collection(Product::where('customer_id', $user->id)->get());
        if($request->all()){
            if($request->only('name')){
                $finish = $finish->where('customer_id', $user->id)->where('name',$request->only('name'));
            }
            if($request->only('serial_number')){
                $finish = $finish->where('customer_id', $user->id)->where('serial_number',$request->only('serial_number') );
            }
            if($request->only('status')){
                $finish = $finish->where('customer_id', $user->id)->where('storage_id',$request->only('status') );
            }
            if($request->only('inventory_number')){
                $finish = $finish->where('customer_id', $user->id)->where('inventory_number',$request->only('inventory_number') );
            }
            if($request->only(['start_salary', 'end_salary'])){
                $finish = $finish->where('customer_id', $user->id)->where('salary', '>', $request->only('start_salary'))->where('salary', '<', $request->only('end_salary'));
            }
            if($request->only(['start_reg_date', 'end_reg_date'])){
                $finish = $finish->where('customer_id', $user->id)->where('created_at', '>', $request->only('start_reg_date'))->where('created_at', '<', $request->only('end_reg_date'));
            }
        }
        return CustomerProductResource::collection($finish->get());

    }

}
