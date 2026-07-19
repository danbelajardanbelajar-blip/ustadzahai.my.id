<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (!isset($input['tableName']) || !isset($input['data'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid input. Required: tableName and data']);
    exit;
}

$tableName = $input['tableName'];
$tableData = $input['data'];

$dataFile = __DIR__ . '/data.json';
$currentData = [];

if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    if ($content) {
        $currentData = json_decode($content, true) ?: [];
    }
}

// Update the specific table
$currentData[$tableName] = $tableData;

// Save back to file safely
if (file_put_contents($dataFile, json_encode($currentData, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to write to file. Check permissions.']);
}
