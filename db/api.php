<?php
require_once '../db/afkmanager.php';

header('Content-Type: application/json');

$database = new Database();
$db = $database->getConnection();
$afkManager = new AfkManager($db);

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'setAfk':
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        if ($afkManager->setAfk($username, $email)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to set AFK']);
        }
        break;

    case 'setActive':
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        if ($afkManager->setActive($username, $email)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to set Active']);
        }
        break;

    case 'getAfkSummary':
        $summary = $afkManager->getAfkSummary();
        echo json_encode($summary);
        break;

    case 'getAfkStats':
        $stats = $afkManager->getAfkStats();
        echo json_encode($stats);
        break;

    default:
        if (empty($action)) {
            echo json_encode(['status' => 'error', 'message' => 'Action not provided']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        }
        break;
}
?>
