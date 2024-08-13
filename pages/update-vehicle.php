<?php
session_start();
include "../db_conn.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
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

    // Prepare to update vehicle details
   $sql = "UPDATE vehicles SET make = ?, model = ?, year = ?, lot = ?, auction = ?, dest = ?, price = ?, image_paths = COALESCE(?, image_paths), status=?,has_key=? WHERE id = ?";
   $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

   // Handle image upload
    $imagePaths = [];
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $uploadFileDir = './uploads/';

        foreach ($_FILES['images']['name'] as $key => $fileName) {
            $fileTmpPath = $_FILES['images']['tmp_name'][$key];
            $fileSize = $_FILES['images']['size'][$key];
            $fileType = $_FILES['images']['type'][$key];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            if (in_array($fileExtension, $allowedExtensions)) {
                $destPath = $uploadFileDir . uniqid() . '.' . $fileExtension;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $imagePaths[] = $destPath;
                } else {
                    echo "Error uploading image: $fileName";
                    exit();
                }
            } else {
                echo "Invalid file type: $fileName";
                exit();
            }
        }
    }

    $imagePathsStr = !empty($imagePaths) ? implode(',', $imagePaths) : null;
    $stmt->bind_param("ssiississsi", $make, $model, $year, $lot, $auction, $destination, $price, $imagePathsStr,  $status,$has_key,$id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>