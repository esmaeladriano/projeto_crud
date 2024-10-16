<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Disciplinas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Gerenciamento de Disciplinas</h2>
        
        <div id="mensagem" class="alert alert-dismissible fade show" style="display:none;"></div>

        <div class="mb-3">
            <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar disciplina...">
        </div>

        <button id="adicionarDisciplinaBtn" class="btn btn-primary">Adicionar Disciplina</button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="disciplinaTableBody">
                <!-- As disciplinas serão inseridas aqui via AJAX -->
            </tbody>
        </table>

        <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>

    <!-- Modal para Adicionar/Editar Disciplina -->
    <div class="modal fade" id="disciplinaModal" tabindex="-1" role="dialog" aria-labelledby="disciplinaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disciplinaModalLabel">Adicionar Disciplina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="disciplinaForm">
                        <input type="hidden" id="disciplinaId" value="">
                        <div class="form-group">
                            <label for="nome">Nome da Disciplina</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <button type="submit" id="salvarDisciplinaBtn" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../public/assets/ajax/disc.js"></script>
</body>
</html>
