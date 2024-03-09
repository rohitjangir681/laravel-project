<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Support\Facades\Gate;


class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('block_index'), 403);
        $blocks = Block::all();
        return view('admin.block.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('block_create'), 403);
        return view('admin.block.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        
        
        $request->validate([
                'title' => 'required',
                'heading' => 'required',
                'ordering' => 'required',
                'status' => 'required'
        ]);
            
        $name = $request->identifier ? $request->identifier : $request->title;
        $identifier = generateUniqueUrlKey($name);

            // echo $identifier;

        $block = Block::create([
            'title' => $request->title,
            'heading' => $request->heading,
            'ordering' => $request->ordering,
            'identifier' => $identifier,
            'status' => $request->status,
            'description' => $request->description
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $block->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('block.index')->withSuccess('Block Add successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // echo $id;
        abort_unless(Gate::allows('block_edit'), 403);
        $block = Block::find($id);
        return view('admin.block.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'heading' => 'required',
            'ordering' => 'required',
            'status' => 'required'
        ]);   


        $block = Block::findOrFail($id);

        $block->update([
            'title' => $request->title,
            'heading' => $request->heading,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'description' => $request->description
        ]);

        if ($request->hasFile('image')) {
            $block->clearMediaCollection('image');
            $block->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('block.index')->withSuccess('Block Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Block::where('id', $id)->delete();
        return redirect()->back()->withSuccess('Block Deleted successfully.');
    }
}
