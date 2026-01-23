<?php
session_start();
require "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST["email"]) || empty($_POST["password"])) {
        $error = "Email and password are required";
    } else {

        $email = strtolower(trim($_POST["email"]));
        $password = $_POST["password"];

        $admin = $users->findOne(["email" => $email]);

        if (!$admin || !password_verify($password, (string)$admin["password"])) {
            $error = "Invalid email or password";
        } else {

            $_SESSION["admin_id"]    = (string)$admin["_id"];
            $_SESSION["admin_email"] = (string)$admin["email"];
            $_SESSION["first_name"]  = (string)$admin["first_name"];
            $_SESSION["last_name"]   = (string)$admin["last_name"];
            $_SESSION["admin_role"]  = (string)$admin["role"];

            header("Location: ../index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">

        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">

            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email"
                       class="w-full px-4 py-2 border rounded-lg"
                       required>
            </div>

            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 border rounded-lg"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg">
                Login
            </button>
        </form>

    </div>
</div>

</body>
</html>
