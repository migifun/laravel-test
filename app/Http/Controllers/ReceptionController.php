<?php

namespace App\Http\Controllers;

use App\Models\Reception;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function form()
    {
        return view('reception.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'purpose' => 'required|in:meeting,interview,delivery,other',
        ]);

        $reception = Reception::create($validated);

        return redirect()->route('reception.calling', $reception);
    }

    public function calling(Reception $reception)
    {
        return view('reception.calling', compact('reception'));
    }

    public function index()
    {
        $receptions = Reception::latest()->get();
        return view('reception.index', compact('receptions'));
    }

    public function destroy(Reception $reception)
    {
        $reception->delete();

        return redirect()->route('reception.index');
    }
}
