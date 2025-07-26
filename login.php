<?php
session_start();
require_once 'dbconn.php';

// to generate CSRF token herefor the security 
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_checker'], $_SESSION['csrf_token']) || $_POST['csrf_checker'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token");
    }

    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password']);

    if (!$email || !$password) {
        $message = "All fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true); 
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username']; 
                unset($_SESSION['csrf_token']); 
                header('Location: dashboard.php');
                exit;
            } else {
                $message = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $message = "An error occurred. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if ($message): ?>
        <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="hidden" name="csrf_checker" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>