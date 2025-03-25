<?php
require_once('includes/db.php');
$shortHash = 'ma55516b8e';
$stmt = $conn->prepare("UPDATE linkshortati SET visite = visite + 1 WHERE linkshortato = ?");
$stmt->bind_param("s", $shortHash);
$stmt->execute();
$stmt = $conn->prepare("SELECT originalLink FROM linkshortati WHERE linkshortato = ?");
$stmt->bind_param("s", $shortHash);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
header("Location: " . $row['originalLink']);
exit;
?>