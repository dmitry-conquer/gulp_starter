<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";

$mail = new PHPMailer(true);
$mail->CharSet = "UTF-8";
$mail->setLanguage("ru", "phpmailer/language/");
$mail->IsHTML(true);

//От кого письмо
if (trim(!empty($_POST["email"]))) {
    $mail->setFrom($_POST["email"]);
}
//Кому отправить
$mail->addAddress("conquer-code@proton.me"); // Указать нужный E-mail
//Тема письма
$mail->Subject = "Нове замовлення!";

//Тело письма
$body = "<html>
    <head>
        <meta charset='utf-8'>
        <style>
            /* Оформление заголовка */
            h1 {
                background-color: #f2f2f2;
                padding: 10px;
                border-top: 5px solid #4CAF50;
                border-bottom: 5px solid #4CAF50;
            }

            /* Оформление данных */
            p {
                margin: 10px;
            }
            strong {
                display: inline-block;
                width: 150px;
                font-weight: bold;
            }

            /* Оформление кнопки */
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 10px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <h1>Нове замовлення!</h1>";

if (trim(!empty($_POST["firstName"]))) {
    $body .= "<p><strong>Имя:</strong> " . $_POST["firstName"] . "</p>";
}
if (trim(!empty($_POST["lastName"]))) {
    $body .= "<p><strong>Фамилия:</strong> " . $_POST["lastName"] . "</p>";
}
if (trim(!empty($_POST["email"]))) {
    $body .= "<p><strong>Почта:</strong> " . $_POST["email"] . "</p>";
}
if (trim(!empty($_POST["info"]))) {
    $body .= "<p><strong>Текст:</strong> " . $_POST["info"] . "</p>";
}
if (isset($_POST["callback"])) {
    $body .= "<p><strong>Способ:</strong> " . $_POST["callback"] . "</p>";
}

$body .= "<a class='button' href='http://example.com/'>Перейти на сайт</a>
    </body>
</html>";

$mail->Body = $body;

//Отправляем
if (!$mail->send()) {
    $message = "Ошибка";
} else {
    $message = "Данные отправлены!";
}

$response = ["message" => $message];

header("Content-type: application/json");
echo json_encode($response);
?>
