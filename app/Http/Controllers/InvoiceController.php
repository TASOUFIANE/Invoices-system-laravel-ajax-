<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\Section;
use App\Models\Invoice_Detail;
use App\Models\InvoiceAttachement;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices=Invoice::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  
        //
        $sections=Section::all();
        return view('invoices.add-invoice',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $data=$request->validate([
            'invoice_number'=>'required|string|max:255',
            'invoice_date'=>'required|date',
            'due_date'=>'required|date',
            'section'=>'required|exists:sections,id',
            'product'=>'required|string',
            'amount_collection'=>'required|numeric',
            'amount_commission'=>'required|numeric',
            'discount'=>'required|numeric',
            'rate_vat'=>'string',
            'value_vat'=>'required|numeric',
            'total'=>'required|numeric',
            'note'=>'nullable|string',
            'file'=>'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        $invoice=Invoice::create([
            'invoice_number'=>$data['invoice_number'],
            'invoice_date'=>$data['invoice_date'],
            'due_date'=>$data['due_date'],
            'section_id'=>$data['section'],
            'product'=>$data['product'],
            'amount_collection'=>$data['amount_collection'],
            'amount_Commission'=>$data['amount_commission'],
            'discount'=>$data['discount'],           
            'value_vat'=>$data['value_vat'],
            'rate_vat'=>$data['rate_vat'],
            'total'=>$data['total'],
            'status'=>'Unpaid',
            'value_status'=>2,
            'note'=>$data['note'],
            // 'payment_Date'=>null,
        ]);
        Invoice_Detail::create([
            'invoice_number'=>$data['invoice_number'],
            'id_Invoice'=>$invoice->id,
            'product'=>$data['product'],
            'section'=>$invoice->section->name,
            'status'=>$invoice->status,
            'value_status'=>$invoice->value_status,
            'note'=>$data['note'],
            'user'=>auth()->user()->name,
        ]);

        if($request->hasFile('file')){
            $file=$request->file('file');
            $file_name=time().$file->getClientOriginalName();
            $file->move(public_path('attachements/invoices/'),$file_name);
            InvoiceAttachement::create([
                'file_name'=>$file_name,
                'invoice_number'=>$invoice->invoice_number,
                'created_by'=>auth()->user()->name,
                'invoice_id'=>$invoice->id,

            ]);
        }
         return redirect()->back()->with('success','Invoice created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProducts($id)
    {
        $products=Product::where('section_id',$id)->pluck('name','id');
        return json_encode($products);
    }
}
