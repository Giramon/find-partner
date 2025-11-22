<?php
include ("../config/db.php");

header('Content-Type: application/json');

$idPeople = isset($_GET['idPeople']) ? intval($_GET['idPeople']) : 0;

if ($idPeople > 0) {
    $sql = "SELECT likes FROM people WHERE id = $idPeople";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $valueLikes = $result->fetch_assoc();
        $newValueLikes = $valueLikes['likes'] + 1;

        $sql = "UPDATE people SET likes = '$newValueLikes' WHERE id = '$idPeople'";
        if($conn->query($sql)){
            echo json_encode(['success' => true, 'message' => 'Like added successfully']);
        } else{
            echo json_encode(['success' => false, 'message' => 'Database update error']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
}

$conn->close();
?>