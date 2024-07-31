<?php
include 'php/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converte o ID para um inteiro

    // Consulta SQL para excluir o paciente com o ID fornecido
    $sql = "DELETE FROM pacientes WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // Redireciona para a página principal após a exclusão
            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao excluir paciente: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
} else {
    echo "ID do paciente não fornecido.";
}

$conn->close();
?>
