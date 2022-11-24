<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Category;
use App\Item;
use App\Inventory;
use App\Suppliers;
use Illuminate\Support\Facades\Validator;


class InventoryController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    

    public function inventory()
    {

        return view('inventory/inventory');
    }

    public function inventoryProductReturnList()
    {

        return view('inventory/inventoryProductReturnList');
    }
    

    public function inventoryInsert(Request $request)
    {
        $inputs = $request->all();
        
        $inputs = Inventory::create($inputs);

        return redirect(Route('inventory'))->with('successMsg', 'New Inventory successfully added !!');
         // return response()->json($inputs);
    }



    public function inventoryEdit($inventoryId)
    {
        $inventoryData = DB::table('inventory_view')->where('inventoryId', $inventoryId )->first();
        return view('inventory/inventoryEdit', compact('inventoryData'));

    }



    public function inventoryUpdate(Request  $request,  $inventoryId)
    {
        Inventory::where('inventoryId', $inventoryId)->update($request->except(['_token'])); 

        return redirect(Route('inventory'))->with('successMsg', 'Inventory successfully Updated !!');
    }


     public function inventoryProductReturn(Request $request)
    {
        // return dd($request->all());
        Inventory::where('inventoryId', $request->inventoryId)->update($request->except(['_token','_method']));  
        return redirect(Route('inventory'))->with('successMsg', 'Product Return Process Successfully Completed !!');
    }





    public function inventoryDelete($inventoryId)
    {
        Inventory::where('inventoryId',$inventoryId)->delete(); 

        return redirect(Route('inventory'))->with('successMsg', 'Inventory successfully deleted !!');
    }



    public function inventoryItemsInsert(Request $request)
    {
        $inputs = $request->all();
        
        $inputs = Item::create($inputs);

        return redirect(Route('inventory'))->with('successMsg', 'New item successfully added !!');
         // return response()->json($inputs);
    }

    public function inventorySupplierInsert(Request $request)
    {
        $inputs = $request->all();
        
        $inputs = Suppliers::create($inputs);

        return redirect(Route('inventory'))->with('successMsg', 'New supplier successfully added !!');
         // return response()->json($inputs);
    }





    public function inventorySettings()
    {

        $categoryData = DB::table('category_view')->get();
        $itemData = DB::table('item_inventory_view')->get();

        return view('inventory/inventorySettings', compact('categoryData', 'itemData'));
    }



    public function category()
    {

    	$category = Category::all();

        return view('inventory/category', compact('category'));
    }

    public function categoryInsert(Request $request)
    {

        $this->validate($request, [
            'category' => 'required|unique:category', 
        ]);

        $inputs = $request->all();
        
        $inputs = Category::create($inputs);

        return redirect(Route('inventory.settings'))->with('successMsg', 'New Category successfully added !!');
         // return response()->json($inputs);
    }


    public function invSettingsCatUpdate(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|min:1|unique:category,category,'.$request->categoryId.',categoryId' // forcing to accept duplicate for that record not for others
        ]);

        Category::find($request->categoryId)->update($request->all()); 

        return redirect(Route('inventory.settings'))->with('successMsg', 'Category successfully updated !!');

        // return dd($request->all());
    }




    public function categoryDelete($categoryId)
    {
        Category::where('categoryId',$categoryId)->delete(); 

        return redirect(Route('inventory.settings'))->with('successMsg', 'Category successfully deleted !!');
    }



    public function items()
    {

        return view('inventory/items');
    }


    public function itemShow($itemId)
    {
        $itemdata = Item::where('itemId', $itemId )->first();
        return view('inventory/itemShow', compact('itemdata'));

    }



    public function itemsInsert(Request $request)
    {
        $this->validate($request, [
            'itemCode' => 'required|unique:item', // forcing to accept duplicate for that record not for others
            'itemName' => 'required|string|max:255',
        ]);

        $inputs = $request->all();
        
        $inputs = Item::create($inputs);

        return redirect(Route('inventory.settings'))->with('successMsg', 'New item successfully added !!');
         // return response()->json($inputs);
    }

    public function itemsUpdate(Request  $request,  $itemId)
    {
        $this->validate($request, [
            'itemCode' => 'required|unique:item,itemCode,'.$itemId.',itemId', // forcing to accept duplicate for that record not for others
            'itemName' => 'required|string|max:255',
        ]);

        Item::where('itemId', $itemId)->update($request->except(['_token'])); 

        return redirect(Route('inventory.settings'))->with('successMsg', 'Item successfully Updated !!');
    }


    public function itemDelete($itemId)
    {
        Item::where('itemId',$itemId)->delete(); 

        return redirect(Route('inventory.settings'))->with('successMsg', 'Item successfully deleted !!');
    }



    // stock report

    public function stockReport()
    {

        return view('inventory/stockReport');
    }



}
