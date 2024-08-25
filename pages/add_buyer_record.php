<?php
require_once "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buyer_id = $_POST['buyer_id'];
    $user_id = $_POST['user_id'];
    $code = $_POST['code'];
    $auction = $_POST['auction'];
    $auctionuser = $_POST['auctionuser'];

    $sql = "UPDATE buyers SET user_id=?,code =?,auction=?,auctionuser=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $user_id,$code, $auction, $auctionuser, $buyer_id );

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

?>