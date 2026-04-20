<?php
header("Content-Type: application/json");
include "conexion.php";

$method = $_SERVER['REQUEST_METHOD'];

// ===================== GET =====================
if ($method == "GET") {
    $stmt = $conn->query("SELECT * FROM ventas");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

// ===================== POST =====================
if ($method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $conn->prepare("INSERT INTO ventas (descripcion, cantidad, precio, total, usuario_id)
                            VALUES (:d, :c, :p, :t, :u)");

    $stmt->execute([
        ":d" => $data['descripcion'],
        ":c" => $data['cantidad'],
        ":p" => $data['precio'],
        ":t" => $data['total'],
        ":u" => $data['usuario_id']
    ]);

    echo json_encode(["mensaje" => "Venta guardada"]);
}

// ===================== DELETE =====================
if ($method == "DELETE") {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM ventas WHERE id = :id");
    $stmt->execute([":id" => $id]);

    echo json_encode(["mensaje" => "Venta eliminada"]);
}
?>