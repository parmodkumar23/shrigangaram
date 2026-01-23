<?php
require "auth_check.php";
require "config/db.php";

$id = $_GET["id"];
$item = $services->findOne([
    "_id" => new MongoDB\BSON\ObjectId($id)
]);

if (isset($_POST["update"])) {

    $services->updateOne(
        ["_id" => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            "title" => $_POST["title"],
            "subtitle" => $_POST["subtitle"],
            "description" => $_POST["description"],
            "phone" => $_POST["phone"],
            "whatsapp" => $_POST["whatsapp"],
            "pricing" => $_POST["pricing"]
        ]]
    );

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">

<form method="POST" class="bg-white p-6 rounded shadow grid gap-3">

<input name="title" value="<?= $item["title"] ?>" class="border p-2">
<input name="subtitle" value="<?= $item["subtitle"] ?>" class="border p-2">
<textarea name="description" class="border p-2"><?= $item["description"] ?></textarea>
<input name="phone" value="<?= $item["phone"] ?>" class="border p-2">
<input name="whatsapp" value="<?= $item["whatsapp"] ?>" class="border p-2">
<input name="pricing" value="<?= $item["pricing"] ?>" class="border p-2">

<button name="update"
        class="bg-green-600 text-white py-2 rounded">
    Update
</button>

</form>

</body>
</html>
