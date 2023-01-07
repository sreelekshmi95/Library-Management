<?php

namespace App\Http\Controllers;

use App\Models\publisher;
use App\Http\Requests\StorepublisherRequest;
use App\Http\Requests\UpdatepublisherRequest;

class ControllerPublisher extends Controller
{
  
    public function index()
    {
        return view('publisher.index', [
            'publishers' => publisher::Paginate(5)
        ]);
    }

   
    public function create()
    {
        return view('publisher.create');
    }

    
    public function store(StorepublisherRequest $request)
    {
        publisher::create($request->validated());
        return redirect()->route('publishers');
    }

   
    public function edit(publisher $publisher)
    {
        return view('publisher.edit', [
            'publisher' => $publisher
        ]);
    }

    
    public function update(UpdatepublisherRequest $request, $id)
    {
        $publisher = publisher::find($id);
        $publisher->name = $request->name;
        $publisher->save();

        return redirect()->route('publishers');
    }

    public function destroy($id)
    {
        publisher::find($id)->delete();
        return redirect()->route('publishers');
    }
}
