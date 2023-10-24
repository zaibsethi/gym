<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function addInventory()
    {
        return view('backend.inventory.add-inventory');
    }

    public function createInventory(Request $request)
    {
        $inventoryData = $request->all();
        $inventoryData['belong_to_gym'] = Auth::user()->belong_to_gym;
        Inventory::create($inventoryData);
        return redirect(route('addInventory'))->with('success', 'Inventory Added successfully.');
    }

    public function inventoryList()
    {
        $inventoryData = Inventory::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.inventory.inventory-list', compact('inventoryData'));
    }

    public function editInventory($id)
    {
        $inventoryData = Inventory::find($id);
        return view('backend.inventory.edit-inventory', compact('inventoryData'));
    }

    public function updateInventory(Request $request, Inventory $id)
    {

        $inventoryData = $request->all();
        $id->update($inventoryData);
        return redirect(route('inventoryList'))->with('success', 'Inventory updated successfully.');

    }

}
