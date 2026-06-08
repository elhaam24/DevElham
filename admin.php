<?php
session_start();
include 'includes/db_connect.php';

// Auth Guard
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$alert = '';
$alert_type = 'success';
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'messages';

// --------------------------------------------------------
// CRUD ACTION HANDLERS (POST)
// --------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'update_about' && $conn) {
        $name = trim($_POST['strong_name']);
        $title = trim($_POST['title']);
        $bio = trim($_POST['bio_text']);
        $photo = trim($_POST['photo_path']);

        $stmt = @$conn->prepare("UPDATE about_me SET strong_name = ?, title = ?, bio_text = ?, photo_path = ? WHERE id = 1");
        if ($stmt) {
            $stmt->bind_param("ssss", $name, $title, $bio, $photo);
            if ($stmt->execute()) {
                $alert = "About Me updated successfully!";
                $active_tab = 'about';
            } else {
                $alert = "Error updating About Me: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    } 
    
    elseif ($action === 'add_skill' && $conn) {
        $name = trim($_POST['name']);
        $icon = trim($_POST['icon']);
        $category = trim($_POST['category']);

        $stmt = @$conn->prepare("INSERT INTO skills (name, icon, category) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $name, $icon, $category);
            if ($stmt->execute()) {
                $alert = "Skill added successfully!";
                $active_tab = 'skills';
            } else {
                $alert = "Error adding skill: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'update_skill' && $conn) {
        $id = intval($_POST['id']);
        $name = trim($_POST['name']);
        $icon = trim($_POST['icon']);
        $category = trim($_POST['category']);

        $stmt = @$conn->prepare("UPDATE skills SET name = ?, icon = ?, category = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sssi", $name, $icon, $category, $id);
            if ($stmt->execute()) {
                $alert = "Skill updated successfully!";
                $active_tab = 'skills';
            } else {
                $alert = "Error updating skill: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'add_project' && $conn) {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $image = trim($_POST['image_path']);
        $link = trim($_POST['link_url']);

        $stmt = @$conn->prepare("INSERT INTO projects (title, description, image_path, link_url) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $title, $description, $image, $link);
            if ($stmt->execute()) {
                $alert = "Project added successfully!";
                $active_tab = 'projects';
            } else {
                $alert = "Error adding project: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'update_project' && $conn) {
        $id = intval($_POST['id']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $image = trim($_POST['image_path']);
        $link = trim($_POST['link_url']);

        $stmt = @$conn->prepare("UPDATE projects SET title = ?, description = ?, image_path = ?, link_url = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $title, $description, $image, $link, $id);
            if ($stmt->execute()) {
                $alert = "Project updated successfully!";
                $active_tab = 'projects';
            } else {
                $alert = "Error updating project: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'add_education' && $conn) {
        $degree = trim($_POST['degree']);
        $institution = trim($_POST['institution']);
        $period = trim($_POST['period']);
        $description = trim($_POST['description']);

        $stmt = @$conn->prepare("INSERT INTO education (degree, institution, period, description) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $degree, $institution, $period, $description);
            if ($stmt->execute()) {
                $alert = "Education entry added successfully!";
                $active_tab = 'education';
            } else {
                $alert = "Error adding education entry: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'update_education' && $conn) {
        $id = intval($_POST['id']);
        $degree = trim($_POST['degree']);
        $institution = trim($_POST['institution']);
        $period = trim($_POST['period']);
        $description = trim($_POST['description']);

        $stmt = @$conn->prepare("UPDATE education SET degree = ?, institution = ?, period = ?, description = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $degree, $institution, $period, $description, $id);
            if ($stmt->execute()) {
                $alert = "Education entry updated successfully!";
                $active_tab = 'education';
            } else {
                $alert = "Error updating education entry: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'add_experience' && $conn) {
        $role = trim($_POST['role']);
        $org = trim($_POST['organization']);
        $period = trim($_POST['period']);
        $description = trim($_POST['description']);

        $stmt = @$conn->prepare("INSERT INTO experience (role, organization, period, description) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $role, $org, $period, $description);
            if ($stmt->execute()) {
                $alert = "Experience entry added successfully!";
                $active_tab = 'experience';
            } else {
                $alert = "Error adding experience entry: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'update_experience' && $conn) {
        $id = intval($_POST['id']);
        $role = trim($_POST['role']);
        $org = trim($_POST['organization']);
        $period = trim($_POST['period']);
        $description = trim($_POST['description']);

        $stmt = @$conn->prepare("UPDATE experience SET role = ?, organization = ?, period = ?, description = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $role, $org, $period, $description, $id);
            if ($stmt->execute()) {
                $alert = "Experience entry updated successfully!";
                $active_tab = 'experience';
            } else {
                $alert = "Error updating experience entry: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'add_course' && $conn) {
        $title = trim($_POST['title']);
        $provider = trim($_POST['provider']);
        $period = trim($_POST['period']);
        $description = trim($_POST['description']);
        $image = trim($_POST['image_path']);

        $stmt = @$conn->prepare("INSERT INTO courses (title, provider, period, description, image_path) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $title, $provider, $period, $description, $image);
            if ($stmt->execute()) {
                $alert = "Course added successfully!";
                $active_tab = 'courses';
            } else {
                $alert = "Error adding course: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }

    elseif ($action === 'update_course' && $conn) {
        $id = intval($_POST['id']);
        $title = trim($_POST['title']);
        $provider = trim($_POST['provider']);
        $period = trim($_POST['period']);
        $description = trim($_POST['description']);
        $image = trim($_POST['image_path']);

        $stmt = @$conn->prepare("UPDATE courses SET title = ?, provider = ?, period = ?, description = ?, image_path = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sssssi", $title, $provider, $period, $description, $image, $id);
            if ($stmt->execute()) {
                $alert = "Course updated successfully!";
                $active_tab = 'courses';
            } else {
                $alert = "Error updating course: " . $stmt->error;
                $alert_type = 'error';
            }
            $stmt->close();
        }
    }
}

// --------------------------------------------------------
// CRUD ACTION HANDLERS (GET)
// --------------------------------------------------------
if (isset($_GET['action']) && $conn) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($action === 'logout') {
        session_destroy();
        header("Location: admin_login.php");
        exit;
    }

    if ($id > 0) {
        // Delete Skill
        if ($action === 'delete_skill') {
            $stmt = @$conn->prepare("DELETE FROM skills WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                $alert = "Skill deleted successfully.";
                $active_tab = 'skills';
            }
        } 
        // Delete Project
        elseif ($action === 'delete_project') {
            $stmt = @$conn->prepare("DELETE FROM projects WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                $alert = "Project deleted successfully.";
                $active_tab = 'projects';
            }
        }
        // Delete Education
        elseif ($action === 'delete_education') {
            $stmt = @$conn->prepare("DELETE FROM education WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                $alert = "Education entry deleted successfully.";
                $active_tab = 'education';
            }
        }
        // Delete Experience
        elseif ($action === 'delete_experience') {
            $stmt = @$conn->prepare("DELETE FROM experience WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                $alert = "Experience entry deleted successfully.";
                $active_tab = 'experience';
            }
        }
        // Delete Course
        elseif ($action === 'delete_course') {
            $stmt = @$conn->prepare("DELETE FROM courses WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                $alert = "Course deleted successfully.";
                $active_tab = 'courses';
            }
        }
        // Edit Skill
        elseif ($action === 'edit_skill') {
            $stmt = @$conn->prepare("SELECT * FROM skills WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result && $result->num_rows > 0) {
                    $edit_item = 'skill';
                    $edit_data = $result->fetch_assoc();
                    $active_tab = 'skills';
                }
                $stmt->close();
            }
        }
        // Edit Project
        elseif ($action === 'edit_project') {
            $stmt = @$conn->prepare("SELECT * FROM projects WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result && $result->num_rows > 0) {
                    $edit_item = 'project';
                    $edit_data = $result->fetch_assoc();
                    $active_tab = 'projects';
                }
                $stmt->close();
            }
        }
        // Edit Education
        elseif ($action === 'edit_education') {
            $stmt = @$conn->prepare("SELECT * FROM education WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result && $result->num_rows > 0) {
                    $edit_item = 'education';
                    $edit_data = $result->fetch_assoc();
                    $active_tab = 'education';
                }
                $stmt->close();
            }
        }
        // Edit Experience
        elseif ($action === 'edit_experience') {
            $stmt = @$conn->prepare("SELECT * FROM experience WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result && $result->num_rows > 0) {
                    $edit_item = 'experience';
                    $edit_data = $result->fetch_assoc();
                    $active_tab = 'experience';
                }
                $stmt->close();
            }
        }
        // Edit Course
        elseif ($action === 'edit_course') {
            $stmt = @$conn->prepare("SELECT * FROM courses WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result && $result->num_rows > 0) {
                    $edit_item = 'course';
                    $edit_data = $result->fetch_assoc();
                    $active_tab = 'courses';
                }
                $stmt->close();
            }
        }
        // Message Toggle Read
        elseif ($action === 'toggle_read') {
            $stmt = @$conn->prepare("SELECT c_status FROM contact WHERE c_id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($status);
                $stmt->fetch();
                $stmt->close();

                $new_status = ($status === 'read') ? 'unread' : 'read';
                $up_stmt = @$conn->prepare("UPDATE contact SET c_status = ? WHERE c_id = ?");
                if ($up_stmt) {
                    $up_stmt->bind_param("si", $new_status, $id);
                    $up_stmt->execute();
                    $up_stmt->close();
                    $alert = "Message marked as " . $new_status . ".";
                    $active_tab = 'messages';
                }
            }
        }
        // Message Delete
        elseif ($action === 'delete') {
            $stmt = @$conn->prepare("DELETE FROM contact WHERE c_id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                $alert = "Message deleted successfully.";
                $active_tab = 'messages';
            }
        }
    }
}

// --------------------------------------------------------
// RETRIEVE LIVE DATABASE RECORDS
// --------------------------------------------------------
$total_messages = 0;
$unread_messages = 0;
$messages = [];
$about_data = ['strong_name'=>'', 'title'=>'', 'bio_text'=>'', 'photo_path'=>''];
$skills_list = [];
$projects_list = [];
$education_list = [];
$experience_list = [];
$courses_list = [];
$edit_item = '';
$edit_data = [];

if ($conn) {
    // Stats & Messages
    $stat_res = $conn->query("SELECT COUNT(*) as count FROM contact");
    if ($stat_res) $total_messages = $stat_res->fetch_assoc()['count'];

    $unread_res = $conn->query("SELECT COUNT(*) as count FROM contact WHERE c_status = 'unread'");
    if ($unread_res) $unread_messages = $unread_res->fetch_assoc()['count'];

    $res = $conn->query("SELECT * FROM contact ORDER BY c_created_at DESC");
    if ($res) {
        while ($row = $res->fetch_assoc()) $messages[] = $row;
    }

    // About Me
    $about_res = $conn->query("SELECT * FROM about_me WHERE id = 1");
    if ($about_res && $about_res->num_rows > 0) $about_data = $about_res->fetch_assoc();

    // Skills
    $skills_res = $conn->query("SELECT * FROM skills ORDER BY id DESC");
    if ($skills_res) {
        while ($row = $skills_res->fetch_assoc()) $skills_list[] = $row;
    }

    // Projects
    $projects_res = $conn->query("SELECT * FROM projects ORDER BY id DESC");
    if ($projects_res) {
        while ($row = $projects_res->fetch_assoc()) $projects_list[] = $row;
    }

    // Education
    $edu_res = $conn->query("SELECT * FROM education ORDER BY id DESC");
    if ($edu_res) {
        while ($row = $edu_res->fetch_assoc()) $education_list[] = $row;
    }

    // Experience
    $exp_res = $conn->query("SELECT * FROM experience ORDER BY id DESC");
    if ($exp_res) {
        while ($row = $exp_res->fetch_assoc()) $experience_list[] = $row;
    }

    // Courses
    $courses_res = $conn->query("SELECT * FROM courses ORDER BY id DESC");
    if ($courses_res) {
        while ($row = $courses_res->fetch_assoc()) $courses_list[] = $row;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevElham - Admin Control Panel</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }
        .admin-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: 100vh;
        }
        
        /* Tab Sidebar */
        .sidebar {
            background: var(--bg-secondary);
            border-right: 1px solid var(--glass-border);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-brand {
            font-size: 24px;
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            padding-left: 10px;
        }
        .tab-btn {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            border-radius: var(--border-radius-sm);
            color: var(--text-secondary);
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            background: transparent;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all var(--transition-fast);
            text-align: left;
            width: 100%;
        }
        .tab-btn:hover {
            background: rgba(255,255,255,0.02);
            color: var(--text-primary);
        }
        .tab-btn.active {
            background: var(--accent-gradient);
            color: var(--text-primary);
            box-shadow: 0 4px 15px rgba(155, 81, 224, 0.3);
        }
        
        /* Main Panel Content */
        .content-panel {
            padding: 40px 5%;
            overflow-y: auto;
        }
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--glass-border);
        }
        .panel-header h1 {
            font-size: 28px;
            color: var(--text-primary);
        }
        .panel-actions {
            display: flex;
            gap: 15px;
        }
        
        /* Dynamic Tab Panels */
        .tab-panel {
            display: none;
        }
        .tab-panel.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Forms Layout & Styling */
        .crud-form {
            background: var(--bg-secondary);
            border: 1px solid var(--glass-border);
            padding: 30px;
            border-radius: var(--border-radius-md);
            box-shadow: var(--glass-shadow);
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .crud-form h2 {
            font-size: 20px;
            margin-bottom: 5px;
            color: var(--text-primary);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 10px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
        }
        .crud-form input, 
        .crud-form select, 
        .crud-form textarea {
            padding: 14px;
            background: var(--bg-primary);
            border: 1px solid var(--glass-border);
            color: var(--text-primary);
            border-radius: var(--border-radius-sm);
            font-family: inherit;
            outline: none;
            transition: all var(--transition-fast);
        }
        .crud-form input:focus, 
        .crud-form select:focus, 
        .crud-form textarea:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 10px rgba(155, 81, 224, 0.1);
        }
        .submit-btn {
            align-self: flex-start;
            padding: 12px 28px;
            background: var(--accent-gradient);
            border: none;
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            border-radius: var(--border-radius-lg);
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(155,81,224,0.3);
            transition: all var(--transition-fast);
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(155,81,224,0.5);
        }
        
        /* Grid Lists for Dynamic Data */
        .list-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .card-item {
            background: var(--bg-secondary);
            border: 1px solid var(--glass-border);
            border-radius: var(--border-radius-md);
            padding: 25px;
            box-shadow: var(--glass-shadow);
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .card-item h3 {
            font-size: 18px;
            color: var(--text-primary);
        }
        .card-item p {
            font-size: 14px;
            color: var(--text-secondary);
            flex-grow: 1;
            line-height: 1.6;
        }
        .card-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
            border-top: 1px solid rgba(255,255,255,0.05);
            padding-top: 12px;
        }
        
        /* Stats indicator */
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-indicator {
            background: var(--bg-secondary);
            border: 1px solid var(--glass-border);
            padding: 20px;
            border-radius: var(--border-radius-sm);
            text-align: center;
        }
        .stat-indicator h4 {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 5px;
        }
        .stat-indicator span {
            font-size: 28px;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: var(--border-radius-sm);
            font-size: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all var(--transition-fast);
        }
        .btn-delete-item {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border: 1px solid rgba(231, 76, 60, 0.2);
        }
        .btn-delete-item:hover {
            background: #e74c3c;
            color: white;
        }
    </style>
</head>
<body>

<div class="admin-layout">
    
    <!-- Tab Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-brand">DevElham</div>
        <button class="tab-btn <?php echo $active_tab === 'messages' ? 'active' : ''; ?>" onclick="switchTab('messages')">✉ Messages</button>
        <button class="tab-btn <?php echo $active_tab === 'about' ? 'active' : ''; ?>" onclick="switchTab('about')">👤 About Me</button>
        <button class="tab-btn <?php echo $active_tab === 'skills' ? 'active' : ''; ?>" onclick="switchTab('skills')">🛠 Skills & Tools</button>
        <button class="tab-btn <?php echo $active_tab === 'projects' ? 'active' : ''; ?>" onclick="switchTab('projects')">🚀 Projects</button>
        <button class="tab-btn <?php echo $active_tab === 'education' ? 'active' : ''; ?>" onclick="switchTab('education')">🎓 Education</button>
        <button class="tab-btn <?php echo $active_tab === 'experience' ? 'active' : ''; ?>" onclick="switchTab('experience')">💼 Experience</button>
        <button class="tab-btn <?php echo $active_tab === 'courses' ? 'active' : ''; ?>" onclick="switchTab('courses')">📜 Courses</button>
        
        <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid var(--glass-border);">
            <a href="admin.php?action=logout" class="tab-btn btn-logout" style="text-align: center; justify-content: center; border: 1px solid #e74c3c; color: #e74c3c;">Logout</a>
        </div>
    </div>
    
    <!-- Panel Content Area -->
    <div class="content-panel">
        
        <div class="panel-header">
            <h1 id="panelTitle">Control Panel</h1>
            <div class="panel-actions">
                <a href="index.php" class="btn btn-view-site" style="font-size: 14px; padding: 10px 20px; text-decoration: none;" target="_blank">View Site</a>
            </div>
        </div>

        <?php if (!empty($alert)): ?>
            <div class="alert-box alert-<?php echo $alert_type; ?>">
                <span><?php echo htmlspecialchars($alert); ?></span>
                <button onclick="this.parentElement.remove()" style="background:transparent;border:none;cursor:pointer;font-weight:bold;color:inherit;">✕</button>
            </div>
        <?php endif; ?>

        <!-- ======================================================== -->
        <!-- TAB PANEL: MESSAGES -->
        <!-- ======================================================== -->
        <div class="tab-panel <?php echo $active_tab === 'messages' ? 'active' : ''; ?>" id="tab-messages">
            <div class="stats-summary">
                <div class="stat-indicator">
                    <h4>Total Inquiries</h4>
                    <span><?php echo $total_messages; ?></span>
                </div>
                <div class="stat-indicator">
                    <h4>Unread Inquiries</h4>
                    <span><?php echo $unread_messages; ?></span>
                </div>
            </div>
            
            <div class="messages-list">
                <?php if (count($messages) > 0): ?>
                    <?php foreach ($messages as $msg): ?>
                        <div class="message-card <?php echo $msg['c_status']; ?>" style="margin-bottom: 20px;">
                            <div class="message-meta">
                                <div class="sender-info">
                                    <h2>
                                        <?php echo htmlspecialchars($msg['c_name']); ?>
                                        <span class="badge badge-<?php echo $msg['c_status']; ?>">
                                            <?php echo $msg['c_status']; ?>
                                        </span>
                                    </h2>
                                    <p><?php echo htmlspecialchars($msg['c_email']); ?></p>
                                </div>
                                <div class="message-date"><?php echo date("F j, Y, g:i a", strtotime($msg['c_created_at'])); ?></div>
                            </div>
                            <div class="message-body"><?php echo htmlspecialchars($msg['c_message']); ?></div>
                            <div class="message-actions">
                                <a href="admin.php?action=toggle_read&id=<?php echo $msg['c_id']; ?>&tab=messages" class="action-btn btn-toggle">
                                    Mark as <?php echo ($msg['c_status'] === 'read') ? 'Unread' : 'Read'; ?>
                                </a>
                                <a href="admin.php?action=delete&id=<?php echo $msg['c_id']; ?>&tab=messages" class="action-btn btn-delete" onclick="return confirm('Permanently delete message?')">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state"><h3>No inquiries yet!</h3></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TAB PANEL: ABOUT ME -->
        <!-- ======================================================== -->
        <div class="tab-panel <?php echo $active_tab === 'about' ? 'active' : ''; ?>" id="tab-about">
            <form action="admin.php?tab=about" method="POST" class="crud-form">
                <h2>Edit About Me</h2>
                <input type="hidden" name="action" value="update_about">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="strong_name">Full Name</label>
                        <input type="text" name="strong_name" id="strong_name" value="<?php echo htmlspecialchars($about_data['strong_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title / Role</label>
                        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($about_data['title']); ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="photo_path">Photo Path</label>
                    <input type="text" name="photo_path" id="photo_path" value="<?php echo htmlspecialchars($about_data['photo_path']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="bio_text">Bio Description</label>
                    <textarea name="bio_text" id="bio_text" rows="8" required><?php echo htmlspecialchars($about_data['bio_text']); ?></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Save Changes</button>
            </form>
        </div>

        <!-- ======================================================== -->
        <!-- TAB PANEL: SKILLS -->
        <!-- ======================================================== -->
        <div class="tab-panel <?php echo $active_tab === 'skills' ? 'active' : ''; ?>" id="tab-skills">
            <?php if ($edit_item === 'skill'): ?>
                <form action="admin.php?tab=skills" method="POST" class="crud-form">
                    <h2>Edit Skill</h2>
                    <input type="hidden" name="action" value="update_skill">
                    <input type="hidden" name="id" value="<?php echo intval($edit_data['id']); ?>">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="skill_name">Skill Name</label>
                            <input type="text" name="name" id="skill_name" value="<?php echo htmlspecialchars($edit_data['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="skill_icon">Icon / Emoji</label>
                            <input type="text" name="icon" id="skill_icon" value="<?php echo htmlspecialchars($edit_data['icon']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="skill_category">Category</label>
                        <select name="category" id="skill_category" required>
                            <option value="languages" <?php echo $edit_data['category'] === 'languages' ? 'selected' : ''; ?>>Languages</option>
                            <option value="backend" <?php echo $edit_data['category'] === 'backend' ? 'selected' : ''; ?>>Backend / Databases</option>
                            <option value="frontend" <?php echo $edit_data['category'] === 'frontend' ? 'selected' : ''; ?>>Frontend / Design</option>
                        </select>
                    </div>
                    
                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="submit-btn">Update Skill</button>
                        <a href="admin.php?tab=skills" class="submit-btn" style="background:#666;">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <form action="admin.php?tab=skills" method="POST" class="crud-form">
                    <h2>Add New Skill</h2>
                    <input type="hidden" name="action" value="add_skill">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="skill_name">Skill Name</label>
                            <input type="text" name="name" id="skill_name" placeholder="e.g. PHP" required>
                        </div>
                        <div class="form-group">
                            <label for="skill_icon">Icon / Emoji</label>
                            <input type="text" name="icon" id="skill_icon" placeholder="e.g. 🐘" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="skill_category">Category</label>
                        <select name="category" id="skill_category" required>
                            <option value="languages">Languages</option>
                            <option value="backend">Backend / Databases</option>
                            <option value="frontend">Frontend / Design</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="submit-btn">Add Skill</button>
                </form>
            <?php endif; ?>

            <h2>Current Skills & Tools</h2>
            <div class="list-grid" style="margin-top: 20px;">
                <?php foreach ($skills_list as $skill): ?>
                    <div class="card-item">
                        <div style="font-size: 24px;"><?php echo htmlspecialchars($skill['icon']); ?></div>
                        <h3><?php echo htmlspecialchars($skill['name']); ?></h3>
                        <p>Category: <strong><?php echo htmlspecialchars($skill['category']); ?></strong></p>
                        <div class="card-actions">
                            <a href="admin.php?action=edit_skill&id=<?php echo $skill['id']; ?>&tab=skills" class="btn-action" style="background:rgba(46, 204, 113,0.1);color:#2ecc71;border:1px solid rgba(46, 204, 113,0.2);">Edit</a>
                            <a href="admin.php?action=delete_skill&id=<?php echo $skill['id']; ?>" class="btn-action btn-delete-item" onclick="return confirm('Delete this skill?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TAB PANEL: PROJECTS -->
        <!-- ======================================================== -->
        <div class="tab-panel <?php echo $active_tab === 'projects' ? 'active' : ''; ?>" id="tab-projects">
            <?php if ($edit_item === 'project'): ?>
                <form action="admin.php?tab=projects" method="POST" class="crud-form">
                    <h2>Edit Project</h2>
                    <input type="hidden" name="action" value="update_project">
                    <input type="hidden" name="id" value="<?php echo intval($edit_data['id']); ?>">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="proj_title">Project Title</label>
                            <input type="text" name="title" id="proj_title" value="<?php echo htmlspecialchars($edit_data['title']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="proj_image">Image Path</label>
                            <input type="text" name="image_path" id="proj_image" value="<?php echo htmlspecialchars($edit_data['image_path']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="proj_link">Project URL / Link</label>
                        <input type="text" name="link_url" id="proj_link" value="<?php echo htmlspecialchars($edit_data['link_url']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="proj_desc">Description</label>
                        <textarea name="description" id="proj_desc" rows="4" required><?php echo htmlspecialchars($edit_data['description']); ?></textarea>
                    </div>
                    
                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="submit-btn">Update Project</button>
                        <a href="admin.php?tab=projects" class="submit-btn" style="background:#666;">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <form action="admin.php?tab=projects" method="POST" class="crud-form">
                    <h2>Add New Project</h2>
                    <input type="hidden" name="action" value="add_project">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="proj_title">Project Title</label>
                            <input type="text" name="title" id="proj_title" required>
                        </div>
                        <div class="form-group">
                            <label for="proj_image">Image Path</label>
                            <input type="text" name="image_path" id="proj_image" value="images/portfolio.png" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="proj_link">Project URL / Link</label>
                        <input type="text" name="link_url" id="proj_link" value="#" required>
                    </div>

                    <div class="form-group">
                        <label for="proj_desc">Description</label>
                        <textarea name="description" id="proj_desc" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Add Project</button>
                </form>
            <?php endif; ?>

            <h2>Current Projects</h2>
            <div class="list-grid" style="margin-top: 20px;">
                <?php foreach ($projects_list as $proj): ?>
                    <div class="card-item">
                        <img src="<?php echo htmlspecialchars($proj['image_path']); ?>" alt="project" style="width:100%;height:140px;object-fit:cover;border-radius:4px;margin-bottom:10px;">
                        <h3><?php echo htmlspecialchars($proj['title']); ?></h3>
                        <p><?php echo htmlspecialchars($proj['description']); ?></p>
                        <div class="card-actions">
                            <a href="admin.php?action=edit_project&id=<?php echo $proj['id']; ?>&tab=projects" class="btn-action" style="background:rgba(46, 204, 113,0.1);color:#2ecc71;border:1px solid rgba(46, 204, 113,0.2);">Edit</a>
                            <a href="admin.php?action=delete_project&id=<?php echo $proj['id']; ?>" class="btn-action btn-delete-item" onclick="return confirm('Delete this project?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TAB PANEL: EDUCATION -->
        <!-- ======================================================== -->
        <div class="tab-panel <?php echo $active_tab === 'education' ? 'active' : ''; ?>" id="tab-education">
            <?php if ($edit_item === 'education'): ?>
                <form action="admin.php?tab=education" method="POST" class="crud-form">
                    <h2>Edit Education Entry</h2>
                    <input type="hidden" name="action" value="update_education">
                    <input type="hidden" name="id" value="<?php echo intval($edit_data['id']); ?>">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edu_degree">Degree / Certificate</label>
                            <input type="text" name="degree" id="edu_degree" value="<?php echo htmlspecialchars($edit_data['degree']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edu_inst">Institution</label>
                            <input type="text" name="institution" id="edu_inst" value="<?php echo htmlspecialchars($edit_data['institution']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="edu_period">Period / Years</label>
                        <input type="text" name="period" id="edu_period" value="<?php echo htmlspecialchars($edit_data['period']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="edu_desc">Description</label>
                        <textarea name="description" id="edu_desc" rows="3" required><?php echo htmlspecialchars($edit_data['description']); ?></textarea>
                    </div>
                    
                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="submit-btn">Update Education</button>
                        <a href="admin.php?tab=education" class="submit-btn" style="background:#666;">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <form action="admin.php?tab=education" method="POST" class="crud-form">
                    <h2>Add Education Entry</h2>
                    <input type="hidden" name="action" value="add_education">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edu_degree">Degree / Certificate</label>
                            <input type="text" name="degree" id="edu_degree" placeholder="e.g. BSc in Computer Science" required>
                        </div>
                        <div class="form-group">
                            <label for="edu_inst">Institution</label>
                            <input type="text" name="institution" id="edu_inst" placeholder="e.g. Harvard University" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="edu_period">Period / Years</label>
                        <input type="text" name="period" id="edu_period" placeholder="e.g. 2023 - Present" required>
                    </div>

                    <div class="form-group">
                        <label for="edu_desc">Description</label>
                        <textarea name="description" id="edu_desc" rows="3" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Add Education</button>
                </form>
            <?php endif; ?>

            <h2>Current Education Timeline</h2>
            <div class="list-grid" style="margin-top: 20px;">
                <?php foreach ($education_list as $edu): ?>
                    <div class="card-item">
                        <h3><?php echo htmlspecialchars($edu['degree']); ?></h3>
                        <p><strong><?php echo htmlspecialchars($edu['institution']); ?></strong> (<?php echo htmlspecialchars($edu['period']); ?>)</p>
                        <p style="font-size:13px;color:var(--text-secondary);"><?php echo htmlspecialchars($edu['description']); ?></p>
                        <div class="card-actions">
                            <a href="admin.php?action=edit_education&id=<?php echo $edu['id']; ?>&tab=education" class="btn-action" style="background:rgba(46, 204, 113,0.1);color:#2ecc71;border:1px solid rgba(46, 204, 113,0.2);">Edit</a>
                            <a href="admin.php?action=delete_education&id=<?php echo $edu['id']; ?>" class="btn-action btn-delete-item" onclick="return confirm('Delete this entry?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TAB PANEL: EXPERIENCE -->
        <!-- ======================================================== -->
        <div class="tab-panel <?php echo $active_tab === 'experience' ? 'active' : ''; ?>" id="tab-experience">
            <?php if ($edit_item === 'experience'): ?>
                <form action="admin.php?tab=experience" method="POST" class="crud-form">
                    <h2>Edit Experience Entry</h2>
                    <input type="hidden" name="action" value="update_experience">
                    <input type="hidden" name="id" value="<?php echo intval($edit_data['id']); ?>">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="exp_role">Role / Position</label>
                            <input type="text" name="role" id="exp_role" value="<?php echo htmlspecialchars($edit_data['role']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exp_org">Organization / Company</label>
                            <input type="text" name="organization" id="exp_org" value="<?php echo htmlspecialchars($edit_data['organization']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exp_period">Period</label>
                        <input type="text" name="period" id="exp_period" value="<?php echo htmlspecialchars($edit_data['period']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="exp_desc">Description</label>
                        <textarea name="description" id="exp_desc" rows="3" required><?php echo htmlspecialchars($edit_data['description']); ?></textarea>
                    </div>
                    
                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="submit-btn">Update Experience</button>
                        <a href="admin.php?tab=experience" class="submit-btn" style="background:#666;">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <form action="admin.php?tab=experience" method="POST" class="crud-form">
                    <h2>Add Experience Entry</h2>
                    <input type="hidden" name="action" value="add_experience">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="exp_role">Role / Position</label>
                            <input type="text" name="role" id="exp_role" placeholder="e.g. Software Engineer" required>
                        </div>
                        <div class="form-group">
                            <label for="exp_org">Organization / Company</label>
                            <input type="text" name="organization" id="exp_org" placeholder="e.g. Google" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exp_period">Period</label>
                        <input type="text" name="period" id="exp_period" placeholder="e.g. Nov 2025 - Jan 2026" required>
                    </div>

                    <div class="form-group">
                        <label for="exp_desc">Description</label>
                        <textarea name="description" id="exp_desc" rows="3" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Add Experience</button>
                </form>
            <?php endif; ?>

            <h2>Current Experience Timeline</h2>
            <div class="list-grid" style="margin-top: 20px;">
                <?php foreach ($experience_list as $exp): ?>
                    <div class="card-item">
                        <h3><?php echo htmlspecialchars($exp['role']); ?></h3>
                        <p><strong><?php echo htmlspecialchars($exp['organization']); ?></strong> (<?php echo htmlspecialchars($exp['period']); ?>)</p>
                        <p style="font-size:13px;color:var(--text-secondary);"><?php echo htmlspecialchars($exp['description']); ?></p>
                        <div class="card-actions">
                            <a href="admin.php?action=edit_experience&id=<?php echo $exp['id']; ?>&tab=experience" class="btn-action" style="background:rgba(46, 204, 113,0.1);color:#2ecc71;border:1px solid rgba(46, 204, 113,0.2);">Edit</a>
                            <a href="admin.php?action=delete_experience&id=<?php echo $exp['id']; ?>" class="btn-action btn-delete-item" onclick="return confirm('Delete this entry?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TAB PANEL: COURSES -->
        <!-- ======================================================== -->
        <div class="tab-panel <?php echo $active_tab === 'courses' ? 'active' : ''; ?>" id="tab-courses">
            <?php if ($edit_item === 'course'): ?>
                <form action="admin.php?tab=courses" method="POST" class="crud-form">
                    <h2>Edit Course</h2>
                    <input type="hidden" name="action" value="update_course">
                    <input type="hidden" name="id" value="<?php echo intval($edit_data['id']); ?>">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="course_title">Course Title</label>
                            <input type="text" name="title" id="course_title" value="<?php echo htmlspecialchars($edit_data['title']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="course_prov">Provider</label>
                            <input type="text" name="provider" id="course_prov" value="<?php echo htmlspecialchars($edit_data['provider']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="course_period">Year / Period</label>
                            <input type="text" name="period" id="course_period" value="<?php echo htmlspecialchars($edit_data['period']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="course_image">Certificate Image Path</label>
                            <input type="text" name="image_path" id="course_image" value="<?php echo htmlspecialchars($edit_data['image_path']); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="course_desc">Description</label>
                        <textarea name="description" id="course_desc" rows="3" required><?php echo htmlspecialchars($edit_data['description']); ?></textarea>
                    </div>
                    
                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="submit-btn">Update Course</button>
                        <a href="admin.php?tab=courses" class="submit-btn" style="background:#666;">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <form action="admin.php?tab=courses" method="POST" class="crud-form">
                    <h2>Add New Course</h2>
                    <input type="hidden" name="action" value="add_course">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="course_title">Course Title</label>
                            <input type="text" name="title" id="course_title" required>
                        </div>
                        <div class="form-group">
                            <label for="course_prov">Provider</label>
                            <input type="text" name="provider" id="course_prov" placeholder="e.g. Microsoft" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="course_period">Year / Period</label>
                            <input type="text" name="period" id="course_period" placeholder="e.g. 2025" required>
                        </div>
                        <div class="form-group">
                            <label for="course_image">Certificate Image Path</label>
                            <input type="text" name="image_path" id="course_image" value="images/c1.png" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="course_desc">Description</label>
                        <textarea name="description" id="course_desc" rows="3" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Add Course</button>
                </form>
            <?php endif; ?>

            <h2>Current Courses</h2>
            <div class="list-grid" style="margin-top: 20px;">
                <?php foreach ($courses_list as $course): ?>
                    <div class="card-item">
                        <img src="<?php echo htmlspecialchars($course['image_path']); ?>" alt="course" style="width:80px;height:80px;object-fit:cover;border-radius:4px;margin-bottom:10px;">
                        <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                        <p><strong><?php echo htmlspecialchars($course['provider']); ?></strong> (<?php echo htmlspecialchars($course['period']); ?>)</p>
                        <p style="font-size:13px;color:var(--text-secondary);"><?php echo htmlspecialchars($course['description']); ?></p>
                        <div class="card-actions">
                            <a href="admin.php?action=edit_course&id=<?php echo $course['id']; ?>&tab=courses" class="btn-action" style="background:rgba(46, 204, 113,0.1);color:#2ecc71;border:1px solid rgba(46, 204, 113,0.2);">Edit</a>
                            <a href="admin.php?action=delete_course&id=<?php echo $course['id']; ?>" class="btn-action btn-delete-item" onclick="return confirm('Delete this course?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<script>
// Client-Side Tab Switcher
function switchTab(tabId) {
    // Update active tab button style
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Find active button
    const activeBtn = Array.from(document.querySelectorAll('.tab-btn')).find(btn => {
        return btn.innerText.toLowerCase().includes(tabId.toLowerCase());
    });
    if (activeBtn) activeBtn.classList.add('active');
    
    // Switch active display panel
    document.querySelectorAll('.tab-panel').forEach(panel => {
        panel.classList.remove('active');
    });
    
    const activePanel = document.getElementById('tab-' + tabId);
    if (activePanel) {
        activePanel.classList.add('active');
    }
    
    // Update panel title header dynamically
    const titleHeader = document.getElementById('panelTitle');
    if (titleHeader) {
        titleHeader.innerText = tabId.charAt(0).toUpperCase() + tabId.slice(1) + ' Manager';
    }
    
    // Update URL parameter without reloading
    const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + tabId;
    window.history.pushState({path:newurl},'',newurl);
}

// Ensure the correct tab title is set on page load
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const initialTab = urlParams.get('tab') || 'messages';
    switchTab(initialTab);
});
</script>
</body>
</html>
