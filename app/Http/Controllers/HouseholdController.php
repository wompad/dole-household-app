<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the households.
     */
    public function index()
    {
        $households = Household::latest()->paginate(15);
        
        return view('households.index', compact('households'));
    }

    /**
     * Show the form for creating a new household.
     */
    public function create()
    {
        return view('households.create');
    }

    /**
     * Store a newly created household in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'father_occupation' => ['required', 'string', 'max:255'],
            'mother_occupation' => ['required', 'string', 'max:255'],
            'home_address' => ['required', 'string', 'max:500'],
            'family_income' => ['required', 'numeric', 'min:0'],
            'house_status' => ['required', 'in:rent,living_together_with_parents,owned,others'],
        ]);

        Household::create($validated);

        // Redirect back to dashboard if coming from there, otherwise to households index
        if (request()->header('referer') && str_contains(request()->header('referer'), '/dashboard')) {
            return redirect()->route('dashboard')
                ->with('success', 'Household created successfully.');
        }

        return redirect()->route('households.index')
            ->with('success', 'Household created successfully.');
    }

    /**
     * Display the specified household.
     */
    public function show(Household $household)
    {
        return view('households.show', compact('household'));
    }

    /**
     * Show the form for editing the specified household.
     */
    public function edit(Household $household)
    {
        return view('households.edit', compact('household'));
    }

    /**
     * Update the specified household in storage.
     */
    public function update(Request $request, Household $household)
    {
        $validated = $request->validate([
            'father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'father_occupation' => ['required', 'string', 'max:255'],
            'mother_occupation' => ['required', 'string', 'max:255'],
            'home_address' => ['required', 'string', 'max:500'],
            'family_income' => ['required', 'numeric', 'min:0'],
            'house_status' => ['required', 'in:rent,living_together_with_parents,owned,others'],
        ]);

        $household->update($validated);

        // Redirect back to dashboard if coming from there, otherwise to households index
        if (request()->header('referer') && str_contains(request()->header('referer'), '/dashboard')) {
            return redirect()->route('dashboard')
                ->with('success', 'Household updated successfully.');
        }

        return redirect()->route('households.index')
            ->with('success', 'Household updated successfully.');
    }

    /**
     * Remove the specified household from storage.
     */
    public function destroy(Household $household)
    {
        $household->delete();

        return redirect()->route('households.index')
            ->with('success', 'Household deleted successfully.');
    }
}
