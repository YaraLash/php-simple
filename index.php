<?php

/**
 * Здоровающаяся функция
 * @param $name
 * @return void
 */
function hello($name = "Мир")
{
    echo "Привет, " . $name . "!";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

$username = $_POST["name"];
if (isset($_POST["name"])) {
    hello($username);
} else {
    hello();
}

?>
<h4>Хотите, чтобы с вами поздаровались?</h4>
<form method="post" action="index.php">
    <label>
        <span>Введите ваше имя</span>
        <input name="name" placeholder="Ваше имя"/>
    </label>
    <button type="submit">Поздороваться</button>
</form>
</body>
</html>