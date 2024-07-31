<?php 

include 'php/db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $nome = $_POST['nome'];
  $altura = $_POST['altura'];
  $peso = $_POST['peso'];
  $metodo_pagamento = isset($_POST['metodo_pagamento']) ? $_POST['metodo_pagamento'] : '';
  $consulta = $_POST['consulta'];

  // Sanitiza os dados para prevenir injeção de SQL
  $nome = $conn->real_escape_string($nome);
  $altura = $conn->real_escape_string($altura);
  $peso = $conn->real_escape_string($peso);
  $metodo_pagamento = $conn->real_escape_string($metodo_pagamento);
  $consulta = $conn->real_escape_string($consulta);

  $sql = "INSERT INTO pacientes (nome, altura, peso, metodo_pagamento, data_consulta) VALUES ('$nome', '$altura', '$peso', '$metodo_pagamento', '$consulta')";

  if ($conn->query($sql) === TRUE){
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
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
              <input type="text" id="nome" name="nome" required />
            </label>
          </div>

          <div class="form-group">
            <label for="altura"
              >Altura
              <input type="number" id="altura" step="0.01" name="altura" required />
            </label>
          </div>

          <div class="form-group">
            <label for="peso"
              >Peso
              <input type="number" id="peso" name="peso" required />
            </label>
          </div>

          <div class="form-group">
            <label for="metodo_pagamento">Método Pagamento
              <input type="text" id="metodo_pagamento" name="metodo_pagamento" required>
            </label>
          </div>
            <div class="form-group">
              <label for="consulta">Consulta</label><br />
              <input type="date" id="consulta" name="consulta" required />
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
