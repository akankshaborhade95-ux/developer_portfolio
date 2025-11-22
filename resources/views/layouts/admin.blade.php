<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Developer Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #10b981;
            --primary-dark: #059669;
            --accent-teal: #0d9488;
            --accent-mint: #34d399;
            --success-green: #10b981;
            --warning-amber: #d97706;
            --light-bg: #f0fdf4;
            --card-bg: #ffffff;
            --text-dark: #065f46;
            --text-light: #047857;
            --border-light: #bbf7d0;
            --sidebar-bg: #ecfdf5;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            box-shadow: 2px 0 15px rgba(16, 185, 129, 0.1);
            border-right: 1px solid var(--border-light);
        }
        
        .admin-sidebar .nav-link {
            color: #76b2a1ff;
            padding: 12px 20px;
            margin: 4px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            border: none;
            background: transparent;
        }
        
        .admin-sidebar .nav-link:hover, 
        .admin-sidebar .nav-link.active {
            color: var(--text-dark);
            background: #d1fae5;
            transform: translateX(5px);
            border-left: 3px solid var(--primary-green);
        }
        
        .admin-sidebar .nav-link i {
            width: 20px;
            margin-right: 12px;
            color: #06241aff;
        }
        
        .admin-sidebar .nav-link:hover i,
        .admin-sidebar .nav-link.active i {
            color: var(--primary-green);
        }
        
        .main-content {
            background-color: var(--light-bg);
            min-height: 100vh;
            padding: 20px;
        }
        
        /* Custom card styles */
        .custom-card {
            background: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.08);
            transition: all 0.3s ease;
            border: 1px solid var(--border-light);
        }
        
        .custom-card:hover {
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.12);
            transform: translateY(-2px);
        }
        
        /* Statistics cards - All in green shades */
        .stat-card-primary {
            background: linear-gradient(135deg, #d7abd2ff 0%, #bea5c3ff 100%);
            border: none;
            color: white;
        }
        
        .stat-card-success {
            background: linear-gradient(135deg, #c09ab3ff 0%, #dfbfd0ff 100%);
            border: none;
            color: white;
        }
        
        .stat-card-warning {
            background: linear-gradient(135deg, #c8a9cfff 0%, #bca8baff 100%);
            border: none;
            color: white;
        }
        
        .stat-card-info {
            background: linear-gradient(135deg, #dbb2ccff 0%, #dcbbd7ff 100%);
            border: none;
            color: white;
        }
        
        /* Button styles */
        .btn-custom-primary {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-custom-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-green) 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(90, 199, 163, 0.3);
        }
        
        .btn-custom-secondary {
            background: white;
            border: 1px solid var(--border-light);
            color: var(--text-dark);
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-custom-secondary:hover {
            background: var(--light-bg);
            border-color: var(--primary-green);
            color: var(--primary-green);
        }
        
        /* Form styles */
        .form-control, .form-select {
            border: 1px solid var(--border-light);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(85, 180, 123, 0.1);
        }
        
        /* Table styles */
        .custom-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-light);
        }
        
        .custom-table thead {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            color: white;
        }
        
        .custom-table th {
            border: none;
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .custom-table td {
            padding: 15px 20px;
            border-color: var(--border-light);
            vertical-align: middle;
        }
        
        /* Badge styles */
        .badge-custom {
            border-radius: 20px;
            padding: 6px 14px;
            font-weight: 500;
            font-size: 0.8em;
        }
        
        /* Alert styles */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            border-left: 4px solid var(--primary-green);
        }
        
        /* Header styles */
        .page-header {
            border-bottom: 2px solid var(--border-light);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .page-title {
            color: var(--text-dark);
            font-weight: 700;
            margin: 0;
        }
        
        /* Progress bars */
        .progress {
            height: 8px;
            border-radius: 10px;
            background-color: var(--border-light);
        }
        
        .progress-bar {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-teal) 100%);
            border-radius: 10px;
        }
        
        /* Icon backgrounds */
        .icon-bg {
            background: rgba(55, 176, 136, 0.1);
            border-radius: 12px;
            padding: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Text colors */
        .text-green {
            color: var(--primary-green) !important;
        }
        
        .text-dark-green {
            color: var(--text-dark) !important;
        }
        
        .sidebar-header {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-radius: 12px;
            margin: 15px;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block admin-sidebar collapse">
                <div class="position-sticky pt-4">
                    <div class="sidebar-header">
                        <h4 class="text-dark-green mb-2">
                            <i class="fas fa-leaf me-2"></i>
                            Portfolio Admin
                        </h4>
                        <small class="text-green">Green Edition</small>
                    </div>
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-chart-line"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projects.create') }}">
                                <i class="fas fa-plus-circle"></i>
                                Add Project
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('skills.index') }}">
                                <i class="fas fa-cog"></i>
                                Manage Skills
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('testimonials.index') }}">
                                <i class="fas fa-comments"></i>
                                Testimonials
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link" href="/" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                View Live Site
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-0 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>