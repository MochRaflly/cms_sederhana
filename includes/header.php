<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Sederhana</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <button id="darkModeToggle" class="btn btn-dark mr-2" title="Toggle Dark/Light Mode"><i class="fas fa-moon"></i></button>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#userSettingsModal">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <span class="brand-text font-weight-light">CMS Sederhana</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Mini Toggle -->
            <div class="sidebar-toggle d-flex justify-content-end p-2">
                <button id="sidebarToggle" class="btn btn-sm btn-light" title="Toggle Sidebar"><i class="fas fa-angle-double-left"></i></button>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt" data-toggle="tooltip" data-placement="right" title="Dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="posts.php" class="nav-link">
                            <i class="nav-icon fas fa-file-alt" data-toggle="tooltip" data-placement="right" title="Posts"></i>
                            <p>Posts</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="categories.php" class="nav-link">
                            <i class="nav-icon fas fa-list" data-toggle="tooltip" data-placement="right" title="Categories"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link">
                            <i class="nav-icon fas fa-users" data-toggle="tooltip" data-placement="right" title="Users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#userSettingsModal">
                            <i class="nav-icon fas fa-cog" data-toggle="tooltip" data-placement="right" title="Pengaturan"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
</body>
</html> 