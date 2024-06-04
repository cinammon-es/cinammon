<?php
require_once 'AfkManager.php';

header('Content-Type: application/json');

try {
    $afkManager = new AfkManager();
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
            echo json_encode(['status' => 'invalid action']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
