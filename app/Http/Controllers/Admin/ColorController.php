<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $validatedData['ststus'] = $request->status == true ? '1' : '0';
        Color::create($validatedData);

        return redirect('admin/colors')->with('message', 'Color Added Successfully');
    }
    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, $color_id)
    {
        // return $request->validated();
        $validatedData = $request->validated();
        // dd($validatedData);
        $validatedData['status'] = $request->status == true ? '1' : '0';
        // dd($validatedData);
        Color::find($color_id)->update($validatedData);
        return redirect('admin/colors')->with('message', 'Color Updated Successfully');
    }

    public function destroy($color_id)
    {
        $color = Color::findOrFail($color_id);
        $color->delete();
        return redirect('admin/colors')->with('message', 'Color Deleted Successful');
    }
}
