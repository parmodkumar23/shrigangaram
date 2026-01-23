<?php
/* ================= AUTH + DB ================= */
require "auth_check.php";
require "config/db.php";

/* ================= SESSION DATA ================= */
$firstName = $_SESSION["first_name"] ?? "Admin";
$lastName  = $_SESSION["last_name"] ?? "";
$email     = $_SESSION["admin_email"] ?? "";

/* ================= ADD SERVICE (PRG) ================= */
if (isset($_POST["add"])) {

    $imageName = "";

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            "../images/uploads/" . $imageName
        );
    }

    $services->insertOne([
        "image"       => $imageName,
        "title"       => trim($_POST["title"]),
        "subtitle"    => trim($_POST["subtitle"]),
        "description" => trim($_POST["description"]),
        "phone"       => trim($_POST["phone"]),
        "whatsapp"    => trim($_POST["whatsapp"]),
        "pricing"     => trim($_POST["pricing"]),
        "created_at"  => new MongoDB\BSON\UTCDateTime()
    ]);

    header("Location: index.php?success=1");
    exit;
}

/* ================= DELETE ================= */
if (isset($_GET["delete"])) {
    $services->deleteOne([
        "_id" => new MongoDB\BSON\ObjectId($_GET["delete"])
    ]);
    header("Location: index.php");
    exit;
}

/* ================= FETCH ================= */
$data = $services->find([], ["sort" => ["created_at" => -1]]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Printer Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            Printer Vala
        </div>

        <nav class="flex-1 p-4">
            <a href="index.php" class="block py-2.5 px-4 rounded bg-gray-700">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
        </nav>

        <a href="auth/logout.php" class="p-4 bg-red-600 hover:bg-red-700">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold">
                Welcome, <?= htmlspecialchars($firstName . " " . $lastName) ?>
            </h2>

            <div class="flex items-center gap-4">
                <span class="text-gray-600"><?= htmlspecialchars($email) ?></span>
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($firstName) ?>"
                     class="w-10 h-10 rounded-full">
            </div>
        </header>

        <!-- BODY -->
        <section class="p-6 flex-1 overflow-y-auto">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- LEFT : TABLE -->
                <div>
                    <h2 class="text-2xl font-bold mb-4">Services List</h2>

                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full text-center">
                            <tr class="bg-gray-200">
                                <th class="p-2">Image</th>
                                <th>Title</th>
                                <th>Phone</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>

                            <?php foreach ($data as $row): ?>
                            <tr class="border-t">
                                <td class="p-2">
                                    <img src="../images/uploads/<?= htmlspecialchars($row["image"]) ?>"
                                         class="mx-auto w-14 h-14 rounded object-cover">
                                </td>
                                <td><?= htmlspecialchars($row["title"]) ?></td>
                                <td><?= htmlspecialchars($row["phone"]) ?></td>
                                <td><?= htmlspecialchars($row["pricing"]) ?></td>
                                <td>
                                    <a href="services_edit.php?id=<?= $row["_id"] ?>"
                                       class="text-blue-600">Edit</a> |
                                    <a href="?delete=<?= $row["_id"] ?>"
                                       onclick="return confirm('Delete?')"
                                       class="text-red-600">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

                <!-- RIGHT : FORM -->
                <div>
                    <h2 class="text-2xl font-bold mb-4">Add Service</h2>

                    <?php if (isset($_GET["success"])): ?>
                        <p class="text-green-600 mb-3">✔ Data Added Successfully</p>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data"
                          class="bg-white p-6 rounded shadow grid grid-cols-2 gap-4">

                        <div class="col-span-2">
                            <label class="block font-semibold mb-2">Upload Image</label>
                            <label class="flex flex-col items-center justify-center
                                          h-36 border-2 border-dashed rounded-lg
                                          cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <span class="text-sm text-gray-500">Click to upload</span>
                                <input type="file" name="image" class="hidden" required>
                            </label>
                        </div>

                        <input name="title" placeholder="Title" class="border p-2 rounded" required>
                        <input name="subtitle" placeholder="Subtitle" class="border p-2 rounded">

                        <textarea name="description" placeholder="Description"
                                  class="border p-2 rounded col-span-2"></textarea>

                        <input name="phone" placeholder="Phone" class="border p-2 rounded" required>
                        <input name="whatsapp" placeholder="WhatsApp" class="border p-2 rounded">

                        <input name="pricing" placeholder="Pricing"
                               class="border p-2 rounded col-span-2">

                        <button name="add"
                                class="col-span-2 bg-blue-600 text-white py-2 rounded">
                            Save Service
                        </button>
                    </form>
                </div>

            </div>
        </section>
    </main>
</div>
</body>
</html>
