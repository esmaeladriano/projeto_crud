<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Turmas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div id="toastContainer" aria-live="polite" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;"></div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Barra de pesquisa com ícone -->
            <div class="input-group mb-3">
                <input type="text" id="search" class="form-control" placeholder="Pesquisar turmas...">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <!-- Botão para adicionar nova turma -->
            <button class="btn btn-success" data-toggle="modal" data-target="#turmaModal">
                <i class="fas fa-plus"></i> Adicionar Nova Turma
            </button>
        </div>
    </div>

    <!-- Tabela de visualização das turmas -->
    <table class="table table-bordered mt-3" id="turmaTable">
        <thead>
            <tr>
                <th>Código</th>
                <th>Turma</th>
                <th>Curso</th>
                <th>Classe</th>
                <th>Turno</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dados carregados via AJAX -->
        </tbody>
    </table>

    <!-- Paginação -->
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <button id="prevPage" class="page-link">Anterior</button>
            </li>
            <li class="page-item">
                <button id="nextPage" class="page-link">Próximo</button>
            </li>
        </ul>
    </nav>
</div>


<!-- Modal para cadastro/edição -->
<div class="modal fade" id="turmaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar/Editar Turma</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="turmaForm">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="nome">Nome da Turma</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_curso">Curso</label>
                        <select id="id_curso" name="id_curso" class="form-control" required>
                            <!-- Opções via AJAX -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_classe">Classe</label>
                        <select id="id_classe" name="id_classe" class="form-control" required>
                            <!-- Opções via AJAX -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_turno">Turno</label>
                        <select id="id_turno" name="id_turno" class="form-control" required>
                            <!-- Opções via AJAX -->
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../../public/turma.js"></script>

</body>
</html>
