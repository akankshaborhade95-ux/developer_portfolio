<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $testimonial = new Testimonial();
        $testimonial->client_name = $request->client_name;
        $testimonial->client_position = $request->client_position;
        $testimonial->content = $request->content;
        $testimonial->rating = $request->rating;
        $testimonial->sort_order = $request->sort_order ?? 0;
        $testimonial->is_active = $request->has('is_active');
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('testimonials', 'public');
            $testimonial->avatar = $avatarPath;
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $testimonial->client_name = $request->client_name;
        $testimonial->client_position = $request->client_position;
        $testimonial->content = $request->content;
        $testimonial->rating = $request->rating;
        $testimonial->sort_order = $request->sort_order ?? 0;
        $testimonial->is_active = $request->has('is_active');
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $avatarPath = $request->file('avatar')->store('testimonials', 'public');
            $testimonial->avatar = $avatarPath;
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Delete avatar if exists
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }
        
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}