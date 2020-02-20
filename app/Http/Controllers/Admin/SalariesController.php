<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff;

class SalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.salary.index')
            ->with('salaries', Salary::with(['staff'])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.salary.create')
            ->with('staffs', Staff::orderBy('name')->pluck('name','id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'staff' => 'required|numeric',
            'status' => 'required|numeric',
            'amount' => 'required|numeric',
            'date' => 'required',
        ]);

        $attributes['staff_id'] = $request->staff;
        $attributes['note'] = $request->note;

        if(Salary::create($attributes)){
            Session::flash('success','Salary has been added successfully');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        $salary['staff'] = $salary->staff_id;
        return view('admin.salary.edit')
            ->with('staffs', Staff::orderBy('name')->pluck('name','id')->toArray())
            ->with('salary', $salary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $attributes = $request->validate([
            'staff' => 'required|numeric',
            'status' => 'required|numeric',
            'amount' => 'required|numeric',
            'date' => 'required',
        ]);

        $attributes['staff_id'] = $request->staff;
        $attributes['note'] = $request->note;

        if($salary->update($attributes)){
            Session::flash('success','Salary has been updated successfully');
        }
        return redirect()->route('admin.salaries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        if($salary->delete()){
            Session::flash('success','Salary has been deleted successfully');
        }
        return redirect()->route('admin.salaries.index');
    }
}
