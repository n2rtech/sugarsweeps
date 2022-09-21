<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $methods = PaymentMethod::all();
        return view('admin.payment-methods.list', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'method' => 'required',
        ]);

        $method = new PaymentMethod;
        $method->method = $request->method;
        $method->status = isset($request->status) ? 1 : 0;
        $method->save();

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $method = PaymentMethod::find($id);
        if($method->status == 1){
            $method->status = 0;
            $method->save();
            return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method disabled successfully');
        }else{
            $method->status = 1;
            $method->save();
            return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method enabled successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $method = PaymentMethod::find($id);
        return view('admin.payment-methods.edit', compact('method'));
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
        $this->validate($request, [
            'method' => 'required',
        ]);

        $method = PaymentMethod::find($id);
        $method->method = $request->method;
        $method->status = isset($request->status) ? 1 : 0;
        $method->save();

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $method = PaymentMethod::find($id)->delete();
        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method deleted successfully');
    }
}
