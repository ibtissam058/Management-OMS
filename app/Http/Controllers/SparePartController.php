<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selected = $request->query('category');
        $sparepart = \App\Models\SparePart::query()
        ->when($selected !== null && $selected !== '', fn($q) => $q->where('category', $selected))
        ->orderBy('id', 'desc')
        ->get();
        return view('inventory.index', compact('sparepart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'price' => 'required',]);
            $sparepart = SparePart::create($validated);
            
            Log::info('Spare part created successfully', ['id' => $sparepart->id, 'name' => $sparepart->name]);
            
            return redirect()->route('inventory.index')->with('success', 'Spare part added successfully');

        }catch(\Exception $e){
            Log::error('Failed to create spare part', ['error' => $e->getMessage(), 'data' => $request->all()]);
            
            return redirect()->back()->with('error', 'Failed to add spare part: ' . $e->getMessage())->withInput();
        }
        
        //SparePart::create($request->all());
        return redirect()->route('inventory.index')->with('success', 'SparePart added');
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparepart)
    {
        return view('inventory.show', compact('sparepart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparepart)
    {
        return view('inventory.edit', compact('sparepart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePart $sparepart)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $sparepart->update($request->all());
        return redirect()->route('inventory.index')->with('success', 'SparePart updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('inventory.index')->with('success', 'SparePart deleted');
    }
}
