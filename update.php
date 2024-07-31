<?php
include 'php/db.php';

// Verifica se o ID do paciente foi fornecido
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebe os dados do formulário
        $nome = $_POST['nome'];
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $metodo_pagamento = $_POST['metodo_pagamento'];
        $data_consulta = $_POST['data_consulta'];
        
        // Atualiza os dados do paciente no banco de dados
        $sql = "UPDATE pacientes SET nome = ?, altura = ?, peso = ?, metodo_pagamento = ?, data_consulta = ? WHERE id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sddssi", $nome, $altura, $peso, $metodo_pagamento, $data_consulta, $id);
            
            if ($stmt->execute()) {
                // Redireciona para a página principal após a atualização
                header("Location: index.php");
                exit();
            } else {
                echo "Erro ao atualizar paciente: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        // Consulta para preencher o formulário com os dados atuais
        $sql = "SELECT nome, altura, peso, metodo_pagamento, data_consulta FROM pacientes WHERE id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "Paciente não encontrado.";
                exit();
            }

            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    }
} else {
    echo "ID do paciente não fornecido.";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <title>Adicionar Paciente</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="assets/css/addPaciente.css" />
  </head>
  <body>
    <div class="container">
      <h2>Adicionar Paciente</h2>
      <div class="content">
        <form method="post">
          <div class="form-group">
            <label for="nome"
              >Nome
              <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required />
            </label>
          </div>

          <div class="form-group">
            <label for="altura"
              >Altura
              <input type="number" id="altura" step="0.01" name="altura" value="<?php echo htmlspecialchars($row['altura']); ?>" required />
            </label>
          </div>

          <div class="form-group">
            <label for="peso"
              >Peso
              <input type="number" id="peso" name="peso" value="<?php echo htmlspecialchars($row['peso']); ?>" required />
            </label>
          </div>

         <div class="form-group">
                <label for="metodo_pagamento">Método de Pagamento</label>
                <select id="metodo_pagamento" name="metodo_pagamento" class="form-control" required>
                    <option value="Dinheiro" <?php echo ($row['metodo_pagamento'] == 'Dinheiro') ? 'selected' : ''; ?>>Dinheiro</option>
                    <option value="Pix" <?php echo ($row['metodo_pagamento'] == 'Pix') ? 'selected' : ''; ?>>Pix</option>
                    <option value="Golden" <?php echo ($row['metodo_pagamento'] == 'Golden') ? 'selected' : ''; ?>>Golden</option>
                    <option value="Memorial" <?php echo ($row['metodo_pagamento'] == 'Memorial') ? 'selected' : ''; ?>>Memorial</option>
                </select>
            </div>
            <div class="form-group">
                <label for="data_consulta">Data da Consulta</label>
                <input type="date" id="data_consulta" name="data_consulta" value="<?php echo htmlspecialchars($row['data_consulta']); ?>" required class="form-control" />
            </div>
            <br />
            <button type="submit" class="btn btn-success" id="btnAdd">
              Adicionar
            </button>
            <br />
          </div>
          <a href="index.php" class="btn btn-primary" id="btnVoltar">Voltar</a>
        </form>
      </div>
    </div>
    <script></script>
  </body>
</html>
