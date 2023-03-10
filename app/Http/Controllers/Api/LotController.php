<?php

namespace App\Http\Controllers\Api;

use App\Models\Lot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['category_ids'])) {
            $category_ids = explode(',', $_GET['category_ids']);
            $lot_ids = DB::table('category_lots')->whereIn('category_id', $category_ids)->distinct()->pluck('lot_id');
            $lots = Lot::whereIn('id', $lot_ids)->get();
        } else {
            $lots = Lot::all();
        }
        return response()->json([
            'data' => $lots,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return  response()->json($validator->messages(), 400);
        };

        $lot = Lot::create($request->all());
        return response()->json([
            'data' => $lot,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function show(Lot $lot)
    {
        $lot = Lot::where('id', $lot->id)->with('categories')->first();
        return response()->json([
            'data' => $lot,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function edit(Lot $lot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lot $lot)
    {
        $lot->update($request->all());
        return response()->json([
            'data' => $lot,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lot $lot)
    {
        $lot->delete();
    }
}
