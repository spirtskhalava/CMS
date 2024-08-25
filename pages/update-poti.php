<?php
session_start();
include "../db_conn.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $columns = [];
    $params = [];
    $types = '';
    $apiKey = 'e59c8dbf08c9dddce376f2328ff2999b';
    $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : '';

    // Function to handle image uploads
    function handleImageUpload($files, $apiKey) {
        $imagePaths = [];
        foreach ($files['name'] as $key => $fileName) {
            $fileTmpPath = $files['tmp_name'][$key];
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
        return $imagePaths;
    }

    if (isset($_FILES['images1']) && !empty($_FILES['images1']['name'][0])) {
        $imagePaths1 = handleImageUpload($_FILES['images1'], $apiKey);
        $imagePathsStr1 = implode(',', $imagePaths1);
        $columns[] = "pickup = ?";
        $params[] = $imagePathsStr1;
        $types .= 's';
    }

    if (isset($_FILES['images2']) && !empty($_FILES['images2']['name'][0])) {
        $imagePaths2 = handleImageUpload($_FILES['images2'], $apiKey);
        $imagePathsStr2 = implode(',', $imagePaths2);
        $columns[] = "warehouse = ?";
        $params[] = $imagePathsStr2;
        $types .= 's';
    }

    if (isset($_FILES['images3']) && !empty($_FILES['images3']['name'][0])) {
        $imagePaths3 = handleImageUpload($_FILES['images3'], $apiKey);
        $imagePathsStr3 = implode(',', $imagePaths3);
        $columns[] = "georgia = ?";
        $params[] = $imagePathsStr3;
        $types .= 's';
    }

    if (!empty($columns)) {
        $sql = "UPDATE vehicles SET " . implode(', ', $columns) . " WHERE id = ?";
        $params[] = $car_id;
        $types .= 'i';

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No images uploaded, nothing to update.";
    }

    $conn->close();
}
?>