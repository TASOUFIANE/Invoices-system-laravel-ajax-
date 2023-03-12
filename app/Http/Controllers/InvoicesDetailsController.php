<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Detail;
use App\Models\InvoiceAttachement;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{
    //
    public function edit($id)
    {
        $invoice = Invoice_Detail::where('id_Invoice', $id)->first();
        $attachement= InvoiceAttachement::where('invoice_id', $id)->first();
        // $sections = Section::all();
        // $products = Product::all();
        return view('invoices.edit', compact('invoice','attachement'));
    }
}
