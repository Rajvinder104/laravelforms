<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fully Responsive Colorful Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styles */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            overflow-y: auto;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #ff6347;
            text-align: center;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #fff;
        }

        #sidebar ul li {
            padding: 10px;
            padding-left: 30px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a {
            color: #fff;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
        }

        #sidebar ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        #sidebar ul li.active > a, a[aria-expanded="true"] {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        /* Content Styles */
        #content {
            width: 100%;
            margin-left: 250px;
            transition: all 0.3s;
            padding: 20px;
        }

        #sidebar.active + #content {
            margin-left: 0;
        }

        /* Navbar Styles */
        .navbar {
            padding: 15px 20px;
            background: #00bfff;
            color: #fff;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 998;
            transition: all 0.3s;
        }

        #sidebar.active ~ .navbar {
            margin-left: 0;
        }

        .navbar .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        .navbar .nav-item .nav-link {
            color: #fff;
        }

        /* Footer Styles */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            width: 100%;
            bottom: 0;
        }

        /* Toggle Button */
        #sidebarCollapse {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5em;
            cursor: pointer;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            #sidebar {
                margin-left: -250px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                margin-left: 0;
            }
            #sidebar.active + #content {
                margin-left: 250px;
            }
            .navbar {
                padding: 10px 15px;
            }
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 200px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #sidebarCollapse {
                font-size: 1.3em;
            }
        }

        @media (max-width: 576px) {
            #sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                margin-left: 0;
            }
            #sidebarCollapse {
                font-size: 1.2em;
            }
        }

        /* Ensure footer doesn't overlap content */
        @media (min-width: 768px) {
            #content {
                padding-bottom: 60px; /* Height of footer */
            }
        }

        @media (max-width: 767px) {
            #content {
                padding-bottom: 60px; /* Height of footer */
            }
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><i class="bi bi-speedometer2"></i> Dashboard</h3>
        </div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#"><i class="bi bi-house-door-fill me-2"></i> Home</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-people-fill me-2"></i> Users</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-cart-fill me-2"></i> Sales</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-bar-chart-fill me-2"></i> Reports</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-gear-fill me-2"></i> Settings</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-question-circle-fill me-2"></i> Help</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="me-3">
                    <i class="bi bi-list"></i>
                </button>
                <a class="navbar-brand" href="#">My Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- Notifications Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotifications" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownNotifications">
                                <li><a class="dropdown-item" href="#">Notification 1</a></li>
                                <li><a class="dropdown-item" href="#">Notification 2</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">See All</a></li>
                            </ul>
                        </li>
                        <!-- User Profile Dropdown -->
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownUser" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://via.placeholder.com/30" alt="User" class="rounded-circle me-2">
                                <span class="d-none d-sm-inline">John Doe</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="container-fluid pt-5">
            <!-- Metrics Cards -->
            <div class="row">
                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Users</h5>
                                    <h3>1,024</h3>
                                </div>
                                <i class="bi bi-people-fill" style="font-size: 3em;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Sales</h5>
                                    <h3>$12,345</h3>
                                </div>
                                <i class="bi bi-cart-fill" style="font-size: 3em;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Revenue</h5>
                                    <h3>$45,678</h3>
                                </div>
                                <i class="bi bi-currency-dollar" style="font-size: 3em;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Errors</h5>
                                    <h3>23</h3>
                                </div>
                                <i class="bi bi-exclamation-triangle-fill" style="font-size: 3em;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row">
                <!-- Sales Overview Chart -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Sales Overview</h5>
                        </div>
                        <div class="card-body">
                            <!-- Placeholder for Chart -->
                            <canvas id="salesChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- User Growth Chart -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">User Growth</h5>
                        </div>
                        <div class="card-body">
                            <!-- Placeholder for Chart -->
                            <canvas id="userChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions Table -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Recent Transactions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Jane Doe</td>
                                            <td>$250</td>
                                            <td>2024-04-01</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>John Smith</td>
                                            <td>$150</td>
                                            <td>2024-04-02</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Emily Johnson</td>
                                            <td>$300</td>
                                            <td>2024-04-03</td>
                                            <td><span class="badge bg-danger">Failed</span></td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 My Dashboard. All Rights Reserved.</p>
        </footer>
    </div>

    <!-- Bootstrap 5 JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js (Optional for Charts) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarCollapse');
        const sidebar = document.getElementById('sidebar');
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });

        // Optional: Initialize Charts with Chart.js
        // Uncomment and customize the following scripts to add real data

        /*
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [1200, 1900, 3000, 5000, 2300, 3400],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });

        // User Growth Chart
        const userCtx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(userCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Users',
                    data: [500, 800, 1200, 1700, 2200, 3000],
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    tension: 0.1
                }]
            },
            options: { responsive: true }
        });
        */
    </script>
</body>
</html>
