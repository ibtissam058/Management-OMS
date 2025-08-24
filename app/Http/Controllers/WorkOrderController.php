<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Models\Equipment;
use App\Models\Technician; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workorders = WorkOrder::all();
        return view('workorders.index', compact('workorders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipments  = Equipment::orderBy('name')->get(['id','name']);
        $technicians = Technician::orderBy('name')->get(['id','name']);

        return view('workorders.create', compact('equipments','technicians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'equipment_id'  => 'required|integer',         
            'description'   => 'required|string|max:1000',
            'priority'      => 'required|in:Low,Medium,High',
            'status'        => 'required|in:Open,In Progress,Completed',
            'technician_id' => 'nullable|integer',
            'due_date'      => 'nullable|date',
            'cost'          => 'nullable|numeric|min:0',
        ]);

        WorkOrder::create($data);

        return redirect()->route('workorders.index')->with('success','Work order created');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\WorkOrder $workorder)
    {
        return view('workorders.show', compact('workorder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkOrder $workorder)
    {
        $equipments  = Equipment::orderBy('name')->get(['id','name']);
        $technicians = Technician::orderBy('name')->get(['id','name']);
        
        return view('workorders.edit', compact('workorder','equipments','technicians'));
    }

    /**
 * Update the specified resource in storage.
 */
    public function update(Request $request, WorkOrder $workorder)
    {
        Log::info('Update method called', [
            'workorder_id' => $workorder->id,
            'request_data' => $request->all()
        ]);
        try {
            $data = $request->validate([
                'equipment_id'  => 'required|integer|exists:equipment,id',         
                'description'   => 'required|string|max:1000',
                'priority'      => 'required|in:Low,Medium,High',
                'status'        => 'required|in:Pending,In Progress,Completed',
                'technician_id' => 'nullable|integer|exists:technicians,id',
                'due_date'      => 'required|date',
                'cost'          => 'nullable|numeric|min:0',
            ]);
            
            Log::info('Validation passed', ['validated_data' => $data]);
            
            $workorder->update($data);
            
            Log::info('WorkOrder updated successfully', ['workorder_id' => $workorder->id]);
            
            return redirect()->route('workorders.index')->with('success', 'Work order updated successfully');
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            
            return back()->withErrors($e->errors())->withInput();
        
        } catch (\Exception $e) {
            Log::error('Update failed', ['error' => $e->getMessage()]);
        return back()->with('error', 'Failed to update work order: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkOrder $workOrder)
    {
        $workOrder->delete();
        return redirect()->route('workorders.index')->with('success', 'WorkOrder deleted');
    }
}
