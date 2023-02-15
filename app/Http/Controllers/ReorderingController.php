<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reordering;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReorderingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.reordering.index", [
            "reorderings" => Reordering::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.reordering.create", [
            "products" => Product::all(),
            "suppliers" => Supplier::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reordering = Reordering::create($request->all());
        $reordering->save();
        return redirect()->route("reorderings.show", [
            "reordering" => $reordering
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reordering $reordering)
    {
        return view("admin.reordering.show", [
            "reordering" => $reordering,
            "products" => Product::all(),
            "suppliers" => Supplier::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reordering $reordering)
    {
        return view("admin.reordering.edit", [
            "reordering" => $reordering,
            "products" => Product::all(),
            "suppliers" => Supplier::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reordering $reordering)
    {
        $reordering->update($request->all());
        $reordering->save();
        return redirect()->route("reorderings.show", [
            "reordering" => $reordering
        ]);
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
}
