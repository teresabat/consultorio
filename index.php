<?php

include 'php/db.php';

// consultar o db
$sql = "SELECT id, nome, altura, peso, metodo_pagamento, data_consulta FROM pacientes";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
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
    <link rel="stylesheet" href="assets/css/index.css" />
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="addPaciente">
          <a href="addPaciente.php" class="btn btn-success"
            >Adicionar Paciente</a
          >
        </div>
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Altura</th>
              <th scope="col">Peso</th>
              <th scope="col">Pagamento</th>
              <th scope="col">Consulta</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if ($result->num_rows > 0 ){
                while($row = $result->fetch_assoc()){
              echo "<tr>
                <td>{$row['nome']}</td>
                <td>{$row['altura']}</td>
                <td>{$row['peso']}</td>
                <td>{$row['metodo_pagamento']}</td>
                <td>" . date('d/m/Y', strtotime($row['data_consulta'])) . "</td>
                <td>
                    <a href='update.php?id={$row['id']}' class='btn btn-primary'>Editar</a>
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Excluir</a>
                </td>
            </tr>"; 
        }
    } else {
        echo "Nenhum paciente encontrado";
            }
                $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>