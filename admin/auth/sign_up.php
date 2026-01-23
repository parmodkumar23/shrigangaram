<?php
session_start();
require "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        empty($_POST["first_name"]) ||
        empty($_POST["last_name"]) ||
        empty($_POST["email"]) ||
        empty($_POST["password"])
    ) {
        $error = "All fields are required";
    } else {

        $firstName = trim($_POST["first_name"]);
        $lastName  = trim($_POST["last_name"]);
        $email     = strtolower(trim($_POST["email"]));
        $password  = $_POST["password"];

        if ($users->findOne(["email" => $email])) {
            $error = "Admin already exists";
        } else {

            $users->insertOne([
                "first_name" => $firstName,
                "last_name"  => $lastName,
                "email"      => $email,
                "password"   => password_hash($password, PASSWORD_BCRYPT),
                "role"       => "admin",
                "created_at" => new MongoDB\BSON\UTCDateTime()
            ]);

            header("Location: login.php?registered=1");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">

        <h2 class="text-2xl font-bold mb-4 text-center">Create Admin Account</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">

            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="first_name" placeholder="First Name"
                       class="px-4 py-2 border rounded-lg w-full" required>

                <input type="text" name="last_name" placeholder="Last Name"
                       class="px-4 py-2 border rounded-lg w-full" required>
            </div>

            <input type="email" name="email" placeholder="Email Address"
                   class="px-4 py-2 border rounded-lg w-full" required>

            <input type="password" name="password" placeholder="Password"
                   class="px-4 py-2 border rounded-lg w-full" required>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold">
                Register
            </button>
        </form>

        <p class="mt-4 text-center">
            Already have an account?
            <a href="login.php" class="text-green-600 font-bold">Login</a>
        </p>
    </div>
</div>

</body>
</html>
