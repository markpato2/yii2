<?php
$host = 'db';  // Nome do serviço do contêiner MySQL conforme definido no docker-compose.yml
$username = 'root';
$password = 'root';
$database = 'local_yii2';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
