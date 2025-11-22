<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SkillController extends Controller
{
    public function index()
    {
        try {
            Log::info('Accessing skills index page');
            $skills = Skill::orderBy('sort_order')->get();
            Log::info('Skills retrieved successfully', ['count' => $skills->count()]);
            return view('admin.skills.index', compact('skills'));
        } catch (\Exception $e) {
            Log::error('Error in skills index: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'Error loading skills page: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        Log::info('Skill store method called', $request->all());
        
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'category' => 'required|string|max:255',
        ]);

        try {
            Skill::create([
                'name' => $request->name,
                'percentage' => $request->percentage,
                'category' => $request->category,
                'sort_order' => $request->sort_order ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            Log::info('Skill created successfully');
            return redirect()->route('skills.index')->with('success', 'Skill created successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error creating skill: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating skill: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'category' => 'required|string|max:255',
        ]);

        try {
            $skill->update([
                'name' => $request->name,
                'percentage' => $request->percentage,
                'category' => $request->category,
                'sort_order' => $request->sort_order ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('skills.index')->with('success', 'Skill updated successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error updating skill: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating skill: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Skill $skill)
    {
        try {
            $skill->delete();
            return redirect()->route('skills.index')->with('success', 'Skill deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting skill: ' . $e->getMessage());
            return redirect()->route('skills.index')->with('error', 'Error deleting skill.');
        }
    }
}