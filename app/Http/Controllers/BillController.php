<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::latest()->paginate(15);
        return response()->json($bills);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create form not applicable for API']);
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            
            'bill_number' => 'required|unique:bills|max:255',
            'bill_date' => 'required|date_format:Y-m-d\TH:i',

            'customer_name' => 'required|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string|max:500',
            'customer_email' => 'nullable|email|max:255',
            'salesperson_name' => 'nullable|string|max:255',

            'jewel_type' => 'required|in:Silver,Gold,Diamond,Other',
            'items_description' => 'nullable|string',
            'net_weight' => 'required|string|min:0',
            'purity_carat' => 'required|in:18K,22K,24K,Other',
            'making_charges' => 'required|numeric|min:0',
            'wastage_charges' => 'required|numeric|min:0',
             
            
            'payment_mode' => 'nullable|in:Cash,Card,UPI,Bank Transfer,
                Cheque,Gold Scheme/Advance,Other',
                'total_amount' => 'required|numeric|min:0',

        
           
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $bill = Bill::create($validatedData);
        \Log::info("create mess:",$request->all());


        return response()->json($bill);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        return response()->json($bill);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(Bill $bill)
    {
        return response()->json(['message' => 'Edit form not applicable for API']);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Bill $bill)
    {
        $validatedData = $request->validate([

            'bill_number' => 'required|max:255|unique:bills,bill_number,' . $bill->id,
            'bill_date' => 'required|date_format:Y-m-d\TH:i',


            'customer_name' => 'required|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string|max:500',
            'customer_email' => 'nullable|email|max:255',
            'salesperson_name' => 'nullable|string|max:255',

            'jewel_type' => 'required|in:Silver,Gold,Diamond,Other',
            'items_description' => 'nullable|string',
            'net_weight' => 'required|string|min:0',
            'purity_carat' => 'required|in:18K,22K,24K,Other',
            'making_charges' => 'required|numeric|min:0',
            'wastage_charges' => 'required|numeric|min:0',


            'payment_mode' => 'nullable|in:Cash,Card,UPI,Bank Transfer,Cheque,Gold Scheme/Advance,Other',
            'total_amount' => 'required|numeric|min:0',


            'status' => 'required|in:pending,paid,cancelled',

        ]);
        
        //\Log::info("Updated mess:",$request->all());

        $bill->update($validatedData);

        return response()->json($bill);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();

        return response()->json(null);
    }
}
