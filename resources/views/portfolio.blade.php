<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .skill-bar {
            background: #e9ecef;
            border-radius: 25px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        .skill-progress {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 25px;
            padding: 8px;
            color: white;
            text-align: center;
            transition: width 2s ease-in-out;
        }
        .project-card {
            transition: transform 0.3s;
            height: 100%;
        }
        .project-card:hover {
            transform: translateY(-5px);
        }
        .testimonial-card {
            border-left: 4px solid #667eea;
            height: 100%;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">DevPortfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="#home">Home</a>
                    <a class="nav-link" href="#projects">Projects</a>
                    <a class="nav-link" href="#skills">Skills</a>
                    <a class="nav-link" href="#testimonials">Testimonials</a>
                    <a class="nav-link" href="/admin/dashboard">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Full Stack Developer</h1>
            <p class="lead">Building amazing web applications with modern technologies</p>
            <a href="#projects" class="btn btn-light btn-lg mt-3">View My Work</a>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">My Projects</h2>
            <div class="row">
                @foreach($projects as $project)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card project-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <div class="mb-3">
                                @foreach($project->technologies as $tech)
                                <span class="badge bg-primary me-1">{{ $tech }}</span>
                                @endforeach
                            </div>
                            <div class="mt-auto">
                                @if($project->project_url)
                                <a href="{{ $project->project_url }}" class="btn btn-primary btn-sm" target="_blank">View Project</a>
                                @endif
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" class="btn btn-outline-dark btn-sm" target="_blank">GitHub</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Skills & Technologies</h2>
            <div class="row">
                @foreach($skills as $skill)
                <div class="col-md-6 mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ $skill->name }}</strong>
                        <span>{{ $skill->percentage }}%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" style="width: {{ $skill->percentage }}%">
                            {{ $skill->percentage }}%
                        </div>
                    </div>
                    <small class="text-muted">{{ $skill->category }}</small>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Client Testimonials</h2>
            <div class="row">
                @foreach($testimonials as $testimonial)
                <div class="col-md-6 mb-4">
                    <div class="card testimonial-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span class="text-white fw-bold">{{ substr($testimonial->client_name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $testimonial->client_name }}</h6>
                                    <small class="text-muted">{{ $testimonial->client_position }}</small>
                                </div>
                            </div>
                            <p class="card-text">"{{ $testimonial->content }}"</p>
                            <div class="text-warning">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Developer Portfolio. All rights reserved.</p>
            <p>
                <a href="/admin/dashboard" class="text-light">Admin Dashboard</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animate skill bars when they come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const skillBar = entry.target;
                    skillBar.style.width = skillBar.style.width;
                }
            });
        });

        document.querySelectorAll('.skill-progress').forEach(skill => {
            observer.observe(skill);
        });
    </script>
</body>
</html>