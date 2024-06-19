<?php
session_start();
include_once "../../connect.php";

if (!empty($_GET["id"])) {
  $id = $_GET["id"];

  // Consulta ao banco de dados para obter os dados do usuário com o ID fornecido
  $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
  $result = $conexao->query($sqlSelect);

  // Verifica se encontrou algum registro
  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $nome = $row["nome"];
      $email = $row["email"];
      $password = $row["password"];
      $nivel_acesso = $row["nivel_acesso"];
    }
  } else {
    // Se não encontrou nenhum registro, redireciona de volta para a página admin.php
    header("Location: dash-adm.php");
    exit();
  }
} else {
  // Se não foi fornecido nenhum ID, redireciona de volta para a página admin.php
  header("Location: dash-adm.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Produto</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <style>
    /* edit-form.css */

    body {
      background-color: #e0f7fa;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      text-align: center;
    }

    .form-header h2 {
      color: #007bb5;
      margin-bottom: 20px;
    }

    .users-form .form-group {
      margin-bottom: 15px;
    }

    .users-form .input-field,
    .users-form select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #007bb5;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .users-form .submit-button {
      background-color: #007bb5;
      color: #ffffff;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s;
    }

    .users-form .submit-button:hover {
      background-color: #005f8a;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <div class="form-header">
      <h2>Editar</h2>
    </div>
    <form class="users-form" action="saveEdit.php?id=<?php echo $id; ?>" method="post">
      <div class="form-group">
        <input type="text" id="name" name="nome" class="input-field" placeholder="Nome" required value="<?php echo $nome; ?>">
      </div>
      <div class="form-group">
        <input type="email" id="email" name="email" class="input-field" placeholder="email" required value="<?php echo $email; ?>">
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" class="input-field" step="0.01" placeholder="password" required value="<?php echo $password; ?>">
      </div>
      <div class="form-group">
        <select name="nivel_acesso" id="role" required>
          <option value="2" <?php echo $nivel_acesso == 2 ? "selected" : ""; ?>>Cliente</option>
          <option value="1" <?php echo $nivel_acesso == 1 ? "selected" : ""; ?>>Admin</option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="submit-button">Salvar</button>
      </div>
    </form>
  </div>
</body>

</html>