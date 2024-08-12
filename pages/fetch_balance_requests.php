<?php
require_once "../db_conn.php";

$sql = "SELECT br.id, d.name AS dealer_name, br.request_date, br.amount, br.person_name, br.status 
        FROM balance_requests br
        JOIN users d ON br.dealer_id = d.id";
$result = $conn->query($sql);

$requests = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}

echo json_encode($requests);

$conn->close();
?>