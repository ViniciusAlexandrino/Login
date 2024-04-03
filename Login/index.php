<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Registro e Login</title>
</head>
<body>
    <h2>Registro de Usuário</h2>

    <form method="post">
        <input type="text" name="nome" placeholder="Nome completo" required><br><br>
        <input type="email" name="email" placeholder="Endereço de e-mail" required><br><br>
        <input type="password" name="senha" placeholder="Senha" required><br><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>

    <h2>Login de Usuário</h2>

    <form method="post">
        <input type="email" name="email" placeholder="Endereço de e-mail" required><br><br>
        <input type="password" name="senha" placeholder="Senha" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>

    <?php
    // Função para verificar se o e-mail já está cadastrado
    function verificarEmail($email) {
        // Supondo que os dados dos usuários estão armazenados em um arquivo users.txt
        $linhas = file('users.txt', FILE_IGNORE_NEW_LINES);
        foreach ($linhas as $linha) {
            list($emailUsuario, ) = explode('|', $linha);
            if ($emailUsuario === $email) {
                return true;
            }
        }
        return false;
    }

    // Função para registrar um novo usuário
    function registrarUsuario($nome, $email, $senha) {
        // Armazenar os dados do novo usuário em users.txt
        $dadosUsuario = "$email|$senha|$nome";
        file_put_contents('users.txt', $dadosUsuario . PHP_EOL, FILE_APPEND);
        echo "<p>Usuário registrado com sucesso!</p>";
    }

    // Função para autenticar o login do usuário
    function autenticarUsuario($email, $senha) {
        // Verificar se o e-mail e a senha correspondem a algum usuário
        $linhas = file('users.txt', FILE_IGNORE_NEW_LINES);
        foreach ($linhas as $linha) {
            list($emailUsuario, $senhaUsuario, $nomeUsuario) = explode('|', $linha);
            if ($emailUsuario === $email && $senhaUsuario === $senha) {
                echo "<p>Login bem-sucedido. Bem-vindo, $nomeUsuario!</p>";
                return;
            }
        }
        echo "<p>E-mail ou senha incorretos. Tente novamente.</p>";
    }

    // Verificar se o formulário de registro foi submetido
    if (isset($_POST['registrar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Verificar se o e-mail já está cadastrado
        if (verificarEmail($email)) {
            echo "<p>Este e-mail já está cadastrado. Por favor, utilize outro.</p>";
        } else {
            // Registrar o novo usuário
            registrarUsuario($nome, $email, $senha);
        }
    }

    // Verificar se o formulário de login foi submetido
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Autenticar o login do usuário
        autenticarUsuario($email, $senha);
    }
    ?>
</body>
</html>
