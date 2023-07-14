<?php

namespace App\Http\Controllers;

use App\Model\ItemsUpload;
use Illuminate\Http\Request;
use App\DBTransactions\ItemUpload\CreateItemUpload;


/**
 * Item Upload Controller Class
 * @author ZinMyoHtetAung
 * @create 06/22/2023
 * @param
 * @return 
 */
class ItemsUploadController extends Controller
{
    /**
     * Store item image to items_uploads DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param  Request  $formData
     * @return void
     */
    public function storeItemsUplaod(Request $request)
    {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemsUpload  $itemsUpload
     * @return \Illuminate\Http\Response
     */
    public function show(ItemsUpload $itemsUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemsUpload  $itemsUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemsUpload $itemsUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemsUpload  $itemsUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemsUpload $itemsUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemsUpload  $itemsUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemsUpload $itemsUpload)
    {
        //
    }
}
