<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->technologies = explode(',', $request->technologies);
        $project->project_url = $request->project_url;
        $project->github_url = $request->github_url;
        $project->sort_order = $request->sort_order ?? 0;
        $project->is_active = $request->has('is_active');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $project->image = $imagePath;
        }

        $project->save();

        return redirect()->route('admin.dashboard')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $project->title = $request->title;
        $project->description = $request->description;
        $project->technologies = explode(',', $request->technologies);
        $project->project_url = $request->project_url;
        $project->github_url = $request->github_url;
        $project->sort_order = $request->sort_order ?? 0;
        $project->is_active = $request->has('is_active');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $imagePath = $request->file('image')->store('projects', 'public');
            $project->image = $imagePath;
        }

        $project->save();

        return redirect()->route('admin.dashboard')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        // Delete image if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Project deleted successfully!');
    }
}