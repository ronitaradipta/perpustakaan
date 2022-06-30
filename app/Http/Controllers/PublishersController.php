<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->eloquent(Publisher::query())
                ->addColumn('action', 'publishers.action')
                ->toJson();
        }

        return view('publishers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required', 'numeric'],
        ]);

        Publisher::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'Publisher added successfully.');

        return redirect()->route('publishers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('publishers.edit', [
            'publisher' => Publisher::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', Rule::unique('publishers', 'slug')->ignore($id)],
            'address' => ['required'],
            'phone' => ['required', 'numeric'],
        ]);

        $publisher = Publisher::find($id);

        $publisher->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'Publisher updated successfully.');

        return redirect()->route('publishers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();
    }
}
