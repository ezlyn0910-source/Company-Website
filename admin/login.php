<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$page_title = "Admin Login - NR Intellitech";
$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        // Include auth functions
        require_once __DIR__ . '/../includes/auth.php';
        
        if (attemptLogin($username, $password)) {
            header('Location: index.php');
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --pinetree: #1a2412;          /* Darker pine tree */
            --dustyblue: #5c6b5a;         /* Muted dusty blue */
            --shadowgreen: #1e3525;       /* Deeper shadow green */

            --sagegreen: #3c5a45;         /* Darker sage green */
            --accent-gold: #DAA112;       /* Keeping gold accent */
            --dark-green: #091a0f;        /* Darker green */
            --morningblue: #6b7c72;       /* Darker morning blue */
            --bone: #cad7b1;              /* Dark bone color */
            --softyellow: #c9a63d;        /* Muted soft yellow */
            --white: #FFFFFF;
            --black: #000000;
            --primary-blue: #0A2540;

            --card-bg: rgba(30, 35, 30, 0.7);
            --section-bg: #111811;
            --text-light: rgba(255, 255, 255, 0.85);
            --text-muted: rgba(255, 255, 255, 0.6);

            --glow-green: 0 0 15px rgba(83, 125, 93, 0.3);
            --softyellow-border: 1px solid var(--softyellow);
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.231);
            --box-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.25);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--sagegreen) 0%, var(--shadowgreen) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100" opacity="0.05"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23cad7b1" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            z-index: -1;
        }

        .login-container {
            background: var(--card-bg);
            padding: 40px 35px;
            border-radius: 12px;
            box-shadow: var(--box-shadow-hover);
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-gold), var(--softyellow));
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: var(--white);
            font-size: 28px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .login-header h1 i {
            color: var(--accent-gold);
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--bone);
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            font-size: 15px;
            transition: var(--transition);
            color: var(--bone);
        }

        .form-group input::placeholder {
            color: var(--text-muted);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 2px rgba(218, 161, 18, 0.2);
            background: rgba(255, 255, 255, 0.12);
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 40px;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .form-group input:focus + i {
            color: var(--accent-gold);
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--softyellow) 100%);
            color: var(--shadowgreen);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(218, 161, 18, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            background: rgba(241, 0, 24, 0.1);
            color: #ff6b6b;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #f10018ff;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-message i {
            font-size: 16px;
        }

        .success-message {
            background: rgba(58, 134, 58, 0.1);
            color: #6bcf6b;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #3a863a;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .success-message i {
            font-size: 16px;
        }

        .admin-info {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
            background: rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
        }

        .admin-info strong {
            color: var(--bone);
            display: block;
            margin-bottom: 8px;
        }

        .admin-info code {
            background: rgba(0, 0, 0, 0.2);
            padding: 3px 6px;
            border-radius: 4px;
            font-family: monospace;
            color: var(--accent-gold);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 40px;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
        }

        .password-toggle:hover {
            color: var(--accent-gold);
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .brand-logo i {
            font-size: 40px;
            color: var(--accent-gold);
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 25px;
            }
            
            .login-header h1 {
                font-size: 24px;
            }
        }

        /* Animation for form elements */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header, .form-group, .login-btn, .admin-info {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .form-group {
            animation-delay: 0.1s;
        }

        .login-btn {
            animation-delay: 0.2s;
        }

        .admin-info {
            animation-delay: 0.3s;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="brand-logo">
            <i class="fas fa-cogs"></i>
        </div>
        
        <div class="login-header">
            <h1><i class="fas fa-lock"></i> NR Intellitech</h1>
            <p>Admin Portal Access</p>
        </div>

        <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                You have been logged out successfully.
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required 
                       value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                       placeholder="Enter your username">
                <i class="fas fa-user"></i>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required 
                       placeholder="Enter your password">
                <i class="fas fa-key"></i>
                <span class="password-toggle" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt"></i> Login to Dashboard
            </button>
        </form>

        <div class="admin-info">
            <strong>Default Credentials</strong>
            <p>Username: <code>admin</code><br>
            Password: <code>nr_intellitech_2024</code></p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Add focus effect to form inputs
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Simple animation on load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.login-container').style.opacity = '0';
            document.querySelector('.login-container').style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                document.querySelector('.login-container').style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                document.querySelector('.login-container').style.opacity = '1';
                document.querySelector('.login-container').style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>