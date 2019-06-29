<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\PacketSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PacketSizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.packet_sizes.index')
                ->with('packetSizes', PacketSize::all());
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
            'packet_size' => 'required|numeric|min:1|unique:packet_sizes',
        ]);

        if (PacketSize::create($attributes)) {
            Session::flash('success', 'Packet size has been created successfully');
        }

        return redirect()->route('admin.packet-sizes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PacketSize  $packet_size
     * @return \Illuminate\Http\Response
     */
    public function edit(PacketSize $packet_size)
    {
        return view('admin.packet_sizes.edit')
                ->with('packetSize', $packet_size);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PacketSize  $packet_size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PacketSize $packet_size)
    {
        $attributes = $request->validate([
            'packet_size' => 'required|numeric|min:1|unique:packet_sizes,packet_size,'.$packet_size->id,
        ]);

        if ($packet_size->update($attributes)) {
            Session::flash('success', 'Packet size has been updated successfully');
        }

        return redirect()->route('admin.packet-sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PacketSize  $packet_size
     * @return \Illuminate\Http\Response
     */
    public function destroy(PacketSize $packet_size)
    {
        if ($packet_size->delete()) {
            Session::flash('success', 'Packet size has been deleted successfully');
        }

        return redirect()->route('admin.packet-sizes.index');
    }
}
