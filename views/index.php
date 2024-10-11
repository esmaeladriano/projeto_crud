<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com Ajax e PHP MVC</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <h1>Gerenciamento de Usuários</h1>
    <form id="userForm">
        <input type="hidden" id="userId">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto">
        <button type="submit">Salvar</button>
    </form>

    <div id="searchContainer">
        <input type="text" id="search" placeholder="Pesquisar...">
    </div>

    <table id="userTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Foto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dados dinâmicos aqui -->
        </tbody>
    </table>

    <div id="pagination">
        <button id="prevPage">Anterior</button>
        <button id="nextPage">Próximo</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/ajax.js"></script>
</body>
</html>
