<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('block_index'), 403);
        $blocks = Block::all();
        return view('admin.block.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('block_create'), 403);
        return view('admin.block.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($data['identifier']);
        
        $data = $request->validate([
            'identifier' => 'required|unique:blocks'
        ]);
        $data = $request->except('_token', 'image');
        $data['identifier'] = Str::replace(' ', '-', $request->identifier);
        $data['identifier'] = Str::lower($data['identifier']);
        
        // dd($data['identifier']);

        // dd($request->all());
        $blockData = Block::create($data);
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $blockData->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('block.index')->withSuccess('Block Add Successfully.');
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
        // echo $id;
        abort_unless(Gate::allows('block_edit'), 403);
        $block = Block::find($id);
        return view('admin.block.edit', compact('block'));
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
        $data = $request->except('_token', '_method');
        // dd($request->all());

        $blockData = Block::findOrFail($id);
        $blockData->update($data);

        if ($request->hasFile('image')) {
            $blockData->clearMediaCollection('image');
            $blockData->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('block.index')->withSuccess('BLock Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Block::where('id', $id)->delete();
        return redirect()->route('block.index')->withSuccess('Block DELETE Successfully.');
    }
}
