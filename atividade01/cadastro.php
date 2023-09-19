<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center h-screen bg-gray-900">
    <div class="max-w-xs p-12 bg-gray-200 border border-indigo-800 rounded-sm">
        <h1 class="text-2xl font-medium mb-4 text-center">Cadastrar</h1>
        <form action="cadastro.php" method="POST" class="flex flex-col">
            <label class="inline-block mb-1">Nome: </label>
            <input type="text" name="nome" class="border border-gray-300 rounded py-2 px-4 w-full focus:outline-none focus:border-indigo-400 mb-2/">
            <label class="inline-block mb-1">E-mail: </label>
            <input type="email" name="email" class="border border-gray-300 rounded py-2 px-4 w-full focus:outline-none focus:border-indigo-400 mb-2/">
            <label class="inline-block mb-1">Senha: </label>
            <input type="password" name="senha" class="border border-gray-300 rounded py-2 px-4 w-full focus:outline-none focus:border-indigo-400" />
            <div class="flex justify-between mt-6">
                <input type="submit" value="Cadastrar" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 transition duration-200 rounded-lg text-white" />
                <a href="login.php" class="px-4 py-2 border border-indigo-300 transition duration-200 rounded-lg">Login</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php

// Verifica se os dados de cadastro foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o e-mail é válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // E-mail inválido
        echo '<span class="absolute top-[23%] inline-block bg-green-200 text-green-900 p-3 rounded-lg">E-mail inválido!</span>';
    } else {
        // Senha tem pelo menos 8 caracteres
        if (strlen($senha) >= 8) {
            // Cadastra o usuário
            $usuarios[] = [
                'nome' => $nome,
                'email' => $email,
                'senha' => $senha,
            ];

            // Redireciona para a página de login
            header("Location: login.php");
        } else {
            // Senha inválida
            echo '<span class="absolute top-[23%] inline-block bg-green-200 text-green-900 p-3 rounded-lg">Senha inválida!</span>';
        }
    }
}

?>
