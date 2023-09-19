<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center h-screen bg-gray-900">
    <div class="max-w-xs p-12 bg-gray-200 border border-indigo-800 rounded-sm">
        <h1 class="text-2xl font-medium mb-4 text-center">Faça o login</h1>
        <form action="usuarios.php" method="POST" class="flex flex-col">
            <label class="inline-block mb-1">E-mail: </label>
            <input type="email" name="email" class="border border-gray-300 rounded py-2 px-4 w-full focus:outline-none focus:border-indigo-400 mb-2/">
            <label class="inline-block mb-1">Senha: </label>
            <input type="password" name="senha" class="border border-gray-300 rounded py-2 px-4 w-full focus:outline-none focus:border-indigo-400" />
            <div class="flex justify-between mt-6">
                <input type="submit" value="Entrar" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 transition duration-200 rounded-lg text-white" />
                <a href="cadastro.php" class="px-4 py-2 border border-indigo-300 transition duration-200 rounded-lg">Cadastrar</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php

// Verifica se existe uma mensagem de erro na URL
if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 1) {
        echo '<span class="absolute top-[23%] inline-block bg-green-200 text-green-900 p-3 rounded-lg">Usuário e senha inválido!</span>';
    }
}

// Verifica se os dados de login foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe
    $usuarios = [
        ['email' => 'joao@silva.com', 'senha' => '123456'],
        ['email' => 'maria@silva.com', 'senha' => '654321'],
    ];

    if (in_array($email, array_column($usuarios, 'email'))) {
        // Verifica se a senha está correta
        if ($senha == $usuarios[array_search($email, array_column($usuarios, 'email'))]['senha']) {
            // Inicia a sessão
            session_start();

            // Armazena o usuário na sessão
            $_SESSION['usuario'] = $email;

            // Redireciona para a página de usuários
            header("Location: usuarios.php");
        } else {
            // Senha incorreta
            header("Location: login.php?acao=1");
        }
    } else {
        // Usuário não existe
        header("Location: login.php?acao=1");
    }
}
