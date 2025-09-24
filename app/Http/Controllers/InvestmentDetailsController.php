<?php

namespace App\Http\Controllers;

use App\Models\InvestmentDetail;
use Illuminate\Http\Request;

class InvestmentDetailsController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {

            $InvestmentDetail = InvestmentDetail::select('id', 'transaction_id', 'amount', 'type_of_payment', 'investment_date', 'status', 'payment_proof', 'remarks')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.index', ['details' => $InvestmentDetail]); // admin dashboard
        }
        $InvestmentDetail = InvestmentDetail::select('transaction_id', 'amount', 'type_of_payment', 'investment_date', 'status','remarks')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('invest.index', ['details' => $InvestmentDetail]); // Ensure you have a Blade view at resources/views/invest/form.blade.php
    }

    public function showForm()
    {
        return view('invest.form'); // Ensure you have a Blade view at resources/views/invest/form.blade.php
    }

    public function store(Request $request)
    {
        // Validate only user-input fields
        $validated = $request->validate([
            'amount'          => 'required|numeric|min:1',
            'transaction_id'  => 'required|string|max:255',
            'type_of_payment' => 'required|string|max:255',
            'investment_date' => 'required|date',
            'payment_proof'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Set fields that are not user-editable
        $validated['user_id'] = auth()->id();
        $validated['status']  = 0; // pending by default

        // Handle file upload if present
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('payment_proofs', $filename, 'public'); // stored in storage/app/public/payment_proofs
            $validated['payment_proof'] = $filename;
        }

        // Save investment details
        \App\Models\InvestmentDetail::create($validated);

        return redirect()->route('investment.index')->with('success', 'Investment details submitted successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate status
        $request->validate([
            'status'  => 'required|in:0,1,2',
            'remarks' => 'nullable|string|max:255', // remarks only if rejected
        ]);

        // Find the investment
        $investment = InvestmentDetail::findOrFail($id);

        // Update status
        $investment->status = $request->status;

        // Save remarks only if rejected
        if ($request->status == 2) {
            $investment->remarks = $request->remarks; // assuming you added 'remarks' column in DB and fillable
        } else {
            $investment->remarks = null; // clear previous remarks if any
        }

        $investment->save();

        return back()->with('success', 'Investment status updated successfully!');
    }
}
