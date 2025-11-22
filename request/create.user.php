<?php
header('Content-Type: application/json');

include ("../config/db.php");

$uploadDir = '../img/profiles/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $gender = trim($_POST['gender'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $lookingFor = trim($_POST['lookingFor'] ?? '');
    
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Имя обязательно для заполнения';
    }
    
    if ($age < 18 || $age > 100) {
        $errors[] = 'Возраст должен быть от 18 до 100 лет';
    }
    
    if (!in_array($gender, ['male', 'female'])) {
        $errors[] = 'Укажите пол';
    }
    
    if (empty($description)) {
        $errors[] = 'Описание обязательно для заполнения';
    }
    
    if (empty($lookingFor)) {
        $errors[] = 'Укажите, кого вы ищете';
    }
    
    $photoPath = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['photo'];
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($file['tmp_name']);
        
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Разрешены только изображения (JPEG, PNG, GIF, WebP)';
        }
        
        if (empty($errors)) {
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '_' . time() . '.' . $fileExtension;
            $photoPath = $uploadDir . $fileName;
            
            if (!move_uploaded_file($file['tmp_name'], $photoPath)) {
                $errors[] = 'Ошибка при загрузке файла';
            } else {
                $photoPath = 'profiles/' . $fileName;
            }
        }
    } else {
        $errors[] = 'Фото обязательно для загрузки';
    }
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
        exit;
    }
    
    $sql = "INSERT INTO people (name, age, src, description, tags, sex, likes) VALUES (?, ?, ?, ?, ?, ?, ?)";

    switch ($lookingFor) {
        case 'friendship':
            $lookingFor = 'Дружба и общение';
            break;
        case 'serious':
            $lookingFor = 'Серьёзные отношения';
            break;
        case 'dating':
            $lookingFor = 'Свободные встречи';
            break;
        case 'travel':
            $lookingFor = 'Спутник для путешествий';
            break;
        default:
            $lookingFor = '';
            break;
    }
    
    if ($stmt = $conn->prepare($sql)) {
        $likes = 0;
        
        $stmt->bind_param("sissssi", $name, $age, $photoPath, $description, $lookingFor, $gender, $likes);
        
        if ($stmt->execute()) {
            echo json_encode([
                'success' => true, 
                'message' => 'Анкета успешно создана!',
                'profileId' => $stmt->insert_id
            ]);
        } else {
            if ($photoPath && file_exists('../img/' . $photoPath)) {
                unlink('../img/' . $photoPath);
            }
            echo json_encode(['success' => false, 'message' => 'Ошибка базы данных: ' . $stmt->error]);
        }
        
        $stmt->close();
    } else {
        if ($photoPath && file_exists('../img/' . $photoPath)) {
            unlink('../img/' . $photoPath);
        }
        echo json_encode(['success' => false, 'message' => 'Ошибка подготовки запроса: ' . $conn->error]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
}

$conn->close();
?>