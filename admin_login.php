<?php
session_start();
include 'includes/db_connect.php';

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $id;
                    $_SESSION['admin_username'] = $username;
                    
                    header("Location: admin.php");
                    exit;
                } else {
                    $error = "Incorrect password.";
                }
            } else {
                $error = "Admin account not found.";
            }
            $stmt->close();
        } else {
            $error = "Database error. Please try again.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevElham - Admin Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: radial-gradient(circle at center, rgba(155, 81, 224, 0.1) 0%, #0a0814 80%);
        }
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--border-radius-md);
            box-shadow: var(--glass-shadow);
            text-align: center;
        }
        .login-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 30px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 600;
        }
        .login-container input {
            width: 100%;
            padding: 14px;
            background: var(--bg-primary);
            border: 1px solid var(--glass-border);
            color: var(--text-primary);
            border-radius: var(--border-radius-sm);
            outline: none;
            transition: all var(--transition-fast);
        }
        .login-container input:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 10px rgba(155, 81, 224, 0.2);
        }
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: left;
            padding: 10px 15px;
            background: rgba(231, 76, 60, 0.1);
            border-left: 4px solid #e74c3c;
            border-radius: 4px;
        }
        .login-btn {
            width: 100%;
            padding: 14px;
            background: var(--accent-gradient);
            color: var(--text-primary);
            font-weight: 700;
            border: none;
            border-radius: var(--border-radius-lg);
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(155, 81, 224, 0.3);
            transition: all var(--transition-fast);
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(155, 81, 224, 0.5);
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 14px;
            color: var(--text-muted);
            text-decoration: none;
            transition: color var(--transition-fast);
        }
        .back-link:hover {
            color: var(--text-secondary);
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h1>Admin Portal</h1>
        <p>Log in to manage portfolio messages</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="admin_login.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter username" required autocomplete="username">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required autocomplete="current-password">
        </div>

        <button type="submit" class="login-btn">Log In</button>
    </form>

    <a href="index.php" class="back-link">← Back to Portfolio</a>
</div>

</body>
</html>
