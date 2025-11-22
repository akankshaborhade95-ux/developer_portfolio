<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $projectsCount = Project::count();
        $skillsCount = Skill::count();
        $testimonialsCount = Testimonial::count();
        $recentProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('projectsCount', 'skillsCount', 'testimonialsCount', 'recentProjects'));
    }
}