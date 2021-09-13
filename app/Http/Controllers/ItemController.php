<?php

use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Database;

class ItemController extends Controller
{
    /**
    * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        return Item::orderBy('created_at', 'DESK')->get();
    }

    /**
     * Show the form for creating a new resource
     *
     * @returns \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show a newly created resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newItem = new Item();
        $newItem->name = $request->item['name'];
        $newItem->save();
        return response()->json([
            'success' => true,
            'newItem' => $newItem
        ]);
    }

    /**
     * Update the specifies resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);

        if ($existingItem){
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->name = $request->item['name'] ? $request->item['name'] : $existingItem->name;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;
        }
        return response()->json([
            'success' => false,
            'message' => 'Item not found!'
        ]);
    }

    /**Remove the specified resource from storage
     *
     * @param int $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $existingItem = Item::find($id);

        if($existingItem) {
            $existingItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Item successfully deleted'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Item not found'
        ]);
    }


}
