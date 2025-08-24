<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selected = $request->query('speciality');
        $technicians = \App\Models\Technician::query()
            ->when($selected !== null && $selected !== '', fn($q) => $q->where('speciality', $selected))
            ->orderBy('id', 'desc')
            ->get();
        return view('technicians.index', compact('technicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('technicians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email'     => 'required|email|max:255',
        ]);

        
        Technician::create($data);

        return redirect()->route('technicians.index')->with('success', 'Technician added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technician $technician)
    {
        return view('technicians.show', compact('technician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technician $technician)
    {
        return view('technicians.edit', compact('technician'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technician $technician)
    {
        $data=$request->validate([
            'name' => 'required',
            'speciality' => 'required',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $technician->update($data);
        return redirect()->route('technicians.index')->with('success', 'Technician updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technician $technician)
    {
        $technician->delete();
        return redirect()->route('technicians.index')->with('success', 'Technician deleted');
    }
}
