<?php
require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

try {
    // 🔹 MongoDB Client (ONE TIME)
    $client = new Client(
        "mongodb+srv://ShriGangaRamEnterprises:aryan_ecw123@cluster0.mkldg1l.mongodb.net/?retryWrites=true&w=majority"
    );

    /* ================= AUTH DATABASE ================= */
    // For Signup / Login / Admins
    $authDB = $client->admin_panel;
    $users  = $authDB->admins;

    /* ================= PRINTER DATABASE ================= */
    // For Dashboard / Products / Services
    $printerDB = $client->printer;
    $services  = $printerDB->services;

} catch (Exception $e) {
    die("MongoDB connection failed");
}
