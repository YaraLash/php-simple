<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_POST["image"];
    $width = $_POST["width"];
    $height = $_POST["height"];

    if (isset($image) && $image != "") {
        echo '<img src="' . $image . '" alt="Загруженное изображение" style="width: '
            . $width . 'px; height:' . $height . 'px">';
    } else {
        if (isset($_FILES["image"]) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $image = $uploadDir . basename($_FILES['image']['name']);

            $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

            if (getimagesize($_FILES['image']['tmp_name'])) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                    echo '<img src="' . $image . '" alt="Загруженное изображение" style="width: '
                        . $width . 'px; height:' . $height . 'px">';
                }
            } else {
                echo 'Файл не является изображением.';
            }

        } else {
            echo 'Ошибка: файл не был загружен или произошла ошибка во время загрузки.';
        }
    }
}
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload your image</title>
</head>
<body>
<form action="index.php" method="post" enctype="multipart/form-data">
    <label>
        Загрузите ваше изображение
        <input name="image" type="file" accept="image/*"/>
        <input type="hidden" name="image" value="<?=$image?>">
    </label>
    <label>
        <input name="width" type="number" placeholder="Введите длину">
    </label>
    <label>
        <input name="height" type="number" placeholder="Введите ширину">
    </label>
    <button type="submit">Отправить</button>
</form>
</body>
</html>