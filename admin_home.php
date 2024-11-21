<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Check if the session is still valid (2 hours limit)
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 7200)) {
    session_destroy(); // Destroy the session if it has expired
    header("Location: admin_login.php");
    exit;
}

// Refresh the session time
$_SESSION['login_time'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
</head>

<body>
    <div class="container">
        <!-- Add Project Category -->
        <div class="project-card shadow-lg mb-5">
            <h2 class="text-center mb-4">Add Project Category</h2>
            <form id="categoryForm">
                <div class="form-group">
                    <label for="project_category">Category Name</label>
                    <input type="text" id="project_category" class="form-control" placeholder="Enter category name" required>
                </div>
                <button type="submit" class="btn btn-success btn-block" onclick="addCategory();">Add Category</button>
            </form>
        </div>

        <!-- Add Project Card -->
        <div class="project-card shadow-lg">
            <h2 class="text-center mb-4">Add Project Card</h2>
            <form id="projectForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="project_name">Project Name</label>
                    <input type="text" id="project_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="project_link">Project Link</label>
                    <input type="url" id="project_link" class="form-control">
                </div>
                <div class="form-group">
                    <label for="project_date">Project Date</label>
                    <input type="month" id="project_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" id="client_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category_id">Project Category</label>
                    <select id="category_id" class="form-control" required>
                        <!-- Dynamically populated with categories -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="project_img">Upload Image</label>
                    <input type="file" id="project_img" class="form-control-file" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add Project</button>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="admin_scripts.js"></script>

</html>