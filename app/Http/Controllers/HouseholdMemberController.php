<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\HouseholdMember;
use Illuminate\Http\Request;

class HouseholdMemberController extends Controller
{
    /**
     * Display a listing of the household members.
     */
    public function index()
    {
        $members = HouseholdMember::with('household')->latest()->paginate(15);
        
        return view('household-members.index', compact('members'));
    }

    /**
     * Show the form for creating a new household member.
     */
    public function create()
    {
        $households = Household::latest()->get();
        return view('household-members.create', compact('households'));
    }

    /**
     * Store a newly created household member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_of_children' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'integer', 'min:0', 'max:150'],
            'sex' => ['required', 'in:male,female'],
            'civil_status' => ['required', 'in:single,married,widowed,divorced,separated'],
            'household_id' => ['required', 'exists:tbl_households,id'],
        ]);

        HouseholdMember::create($validated);

        // Redirect back to dashboard if coming from there, otherwise to members index
        if (request()->header('referer') && str_contains(request()->header('referer'), '/dashboard')) {
            return redirect()->route('dashboard')
                ->with('success', 'Household member created successfully.');
        }

        return redirect()->route('household-members.index')
            ->with('success', 'Household member created successfully.');
    }

    /**
     * Display the specified household member.
     */
    public function show(HouseholdMember $householdMember)
    {
        $householdMember->load('household');
        return view('household-members.show', compact('householdMember'));
    }

    /**
     * Show the form for editing the specified household member.
     */
    public function edit(HouseholdMember $householdMember)
    {
        $households = Household::latest()->get();
        return view('household-members.edit', compact('householdMember', 'households'));
    }

    /**
     * Update the specified household member in storage.
     */
    public function update(Request $request, HouseholdMember $householdMember)
    {
        $validated = $request->validate([
            'name_of_children' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'integer', 'min:0', 'max:150'],
            'sex' => ['required', 'in:male,female'],
            'civil_status' => ['required', 'in:single,married,widowed,divorced,separated'],
            'household_id' => ['required', 'exists:tbl_households,id'],
        ]);

        $householdMember->update($validated);

        // Redirect back to dashboard if coming from there, otherwise to members index
        if (request()->header('referer') && str_contains(request()->header('referer'), '/dashboard')) {
            return redirect()->route('dashboard')
                ->with('success', 'Household member updated successfully.');
        }

        return redirect()->route('household-members.index')
            ->with('success', 'Household member updated successfully.');
    }

    /**
     * Remove the specified household member from storage.
     */
    public function destroy(HouseholdMember $householdMember)
    {
        $householdMember->delete();

        // Redirect back to dashboard if coming from there, otherwise to members index
        if (request()->header('referer') && str_contains(request()->header('referer'), '/dashboard')) {
            return redirect()->route('dashboard')
                ->with('success', 'Household member deleted successfully.');
        }

        return redirect()->route('household-members.index')
            ->with('success', 'Household member deleted successfully.');
    }

    /**
     * Store multiple household members in bulk.
     */
    public function storeBulk(Request $request)
    {
        $validated = $request->validate([
            'members' => ['required', 'array', 'min:1'],
            'members.*.name_of_children' => ['required', 'string', 'max:255'],
            'members.*.birthdate' => ['required', 'date'],
            'members.*.age' => ['required', 'integer', 'min:0', 'max:150'],
            'members.*.sex' => ['required', 'in:male,female'],
            'members.*.civil_status' => ['required', 'in:single,married,widowed,divorced,separated'],
            'members.*.household_id' => ['required', 'exists:tbl_households,id'],
        ]);

        foreach ($validated['members'] as $memberData) {
            HouseholdMember::create($memberData);
        }

        // Return JSON response for AJAX requests
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => count($validated['members']) . ' household member(s) created successfully.',
                'count' => count($validated['members'])
            ]);
        }

        // Redirect back to dashboard if coming from there, otherwise to members index
        if (request()->header('referer') && str_contains(request()->header('referer'), '/dashboard')) {
            return redirect()->route('dashboard')
                ->with('success', count($validated['members']) . ' household member(s) created successfully.');
        }

        return redirect()->route('household-members.index')
            ->with('success', count($validated['members']) . ' household member(s) created successfully.');
    }
}
