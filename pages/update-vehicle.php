<?php
session_start();
include "../db_conn.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $make = isset($_POST['make']) ? $_POST['make'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $lot = isset($_POST['lot']) ? $_POST['lot'] : null;
    $auction = isset($_POST['auction']) ? $_POST['auction'] : '';
    $destination = isset($_POST['dest']) ? $_POST['dest'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $has_key = isset($_POST['has_key']) ? $_POST['has_key'] : '';
    $booking_id = isset($_POST['booking_id']) ? $_POST['booking_id'] : '';
    $container_id = isset($_POST['container_id']) ? $_POST['container_id'] : '';
    $container_name = isset($_POST['container_name']) ? $_POST['container_name'] : '';

    // Handle image uploads
    $imagePaths = [];
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $apiKey = 'e59c8dbf08c9dddce376f2328ff2999b';

        foreach ($_FILES['images']['name'] as $key => $fileName) {
            $fileTmpPath = $_FILES['images']['tmp_name'][$key];
            $fileSize = $_FILES['images']['size'][$key];
            $fileType = $_FILES['images']['type'][$key];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, [
                    'image' => curl_file_create($fileTmpPath),
                    'key' => $apiKey
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                $responseArr = json_decode($response, true);

                if ($responseArr['status'] === 200) {
                    $imagePaths[] = $responseArr['data']['url'];
                } else {
                    echo "Error uploading image: $fileName";
                    exit();
                }
            } else {
                echo "Invalid file type: $fileName";
                exit();
            }
        }
        $imagePathsStr = !empty($imagePaths) ? implode(',', $imagePaths) : '';
    } else {
        $imagePathsStr = '';
    }

    // Prepare the update query
    $sql = "UPDATE vehicles SET make = ?, model = ?, year = ?, lot = ?, auction = ?, branch = ?, price = ?, image_paths = COALESCE(?, image_paths), status=?, has_key=?, booking_id=?, container_id=?,container_name=? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssiississsiisi", $make, $model, $year, $lot, $auction, $destination, $price, $imagePathsStr, $status, $has_key, $booking_id, $container_id,$container_name,$id);

    if ($stmt->execute()) {
        $affectedRows = $stmt->affected_rows;
        if ($affectedRows > 0) {
            header("Location: admin.php");
            exit();
        } else {
            echo "No rows were updated. Check if the ID is correct.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>