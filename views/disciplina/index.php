<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Disciplinas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Gestão de Disciplinas</h1>
        

        <!-- Barra de Pesquisa -->
        <div class="mb-3">
            <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar por disciplinas...">
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" id="adicionarDisciplinaBtn">Adicionar Disciplina</button>
        </div>
       
        <div id="mensagem" class="alert" style="display: none;"></div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Professor</th>
                    <th>Turma</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="disciplinaTable">
                <!-- Conteúdo dinâmico via JS -->
            </tbody>
        </table>

        <!-- Modal para adicionar/editar disciplinas -->
        <div class="modal fade" id="disciplinaModal" tabindex="-1" aria-labelledby="disciplinaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disciplinaModalLabel">Adicionar Disciplina</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="disciplinaForm">
                            <input type="hidden" id="disciplinaId" name="id">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="turma">Turma</label>
                                <select class="form-control" id="turma" name="turma"></select>
                            </div>
                            <div class="form-group">
                                <label for="professor">Professor</label>
                                <select class="form-control" id="professor" name="professor"></select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="salvarDisciplinaBtn">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/disc.js"></script>
</body>
</html>
