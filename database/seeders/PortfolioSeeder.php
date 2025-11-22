<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        // Sample Projects
        Project::create([
            'title' => 'E-Commerce Website',
            'description' => 'A full-featured e-commerce platform with payment integration and admin dashboard.',
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Bootstrap'],
            'project_url' => 'https://example.com',
            'github_url' => 'https://github.com/example/ecommerce',
            'sort_order' => 1,
            'is_active' => true
        ]);

        Project::create([
            'title' => 'Task Management App',
            'description' => 'A collaborative task management application with real-time updates.',
            'technologies' => ['React', 'Node.js', 'MongoDB', 'Express'],
            'project_url' => 'https://example.com/taskapp',
            'github_url' => 'https://github.com/example/taskapp',
            'sort_order' => 2,
            'is_active' => true
        ]);

        // Sample Skills
        Skill::create([
            'name' => 'PHP & Laravel',
            'percentage' => 90,
            'category' => 'Backend',
            'sort_order' => 1,
            'is_active' => true
        ]);

        Skill::create([
            'name' => 'JavaScript & Vue.js',
            'percentage' => 85,
            'category' => 'Frontend',
            'sort_order' => 2,
            'is_active' => true
        ]);

        Skill::create([
            'name' => 'MySQL',
            'percentage' => 80,
            'category' => 'Database',
            'sort_order' => 3,
            'is_active' => true
        ]);

        // Sample Testimonials
        Testimonial::create([
            'client_name' => 'Dhiraj',
            'client_position' => 'CEO at TechCorp',
            'content' => 'Excellent work! Delivered ahead of schedule with great attention to detail.',
            'rating' => 5,
            'sort_order' => 1,
            'is_active' => true
        ]);

        Testimonial::create([
            'client_name' => 'Akanksha',
            'client_position' => 'Project Manager at DesignStudio',
            'content' => 'Professional and highly skilled developer. Would definitely work with again!',
            'rating' => 5,
            'sort_order' => 2,
            'is_active' => true
        ]);
    }
}