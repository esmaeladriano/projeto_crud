<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Gerenciamento de Alunos</h2>
        
        <div id="mensagem" class="alert alert-dismissible fade show" style="display:none;"></div>

        <div class="mb-3">
            <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar aluno...">
        </div>

        <button id="adicionarAlunoBtn" class="btn btn-primary">Adicionar Aluno</button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Sexo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="alunoTableBody">
                <!-- Os alunos serão inseridos aqui via AJAX -->
            </tbody>
        </table>

        <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>

    <!-- Modal para Adicionar/Editar Aluno -->
    <div class="modal fade" id="alunoModal" tabindex="-1" role="dialog" aria-labelledby="alunoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alunoModalLabel">Adicionar Aluno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="alunoForm">
                        <input type="hidden" id="alunoId" value="">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="data_nasc">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nasc" required>
                        </div>
                        <div class="form-group">
                            <label for="nome_pai">Nome do Pai</label>
                            <input type="text" class="form-control" id="nome_pai" required>
                        </div>
                        <div class="form-group">
                            <label for="nome_mae">Nome da Mãe</label>
                            <input type="text" class="form-control" id="nome_mae" required>
                        </div>
                        <div class="form-group">
                            <label for="municipio">Município</label>
                            <input type="text" class="form-control" id="municipio" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <input type="text" class="form-control" id="sexo" required>
                        </div>
                        <div class="form-group">
                            <label for="bi">BI</label>
                            <input type="text" class="form-control" id="bi" required>
                        </div>
                        <div class="form-group">
                            <label for="estado_civil">Estado Civil</label>
                            <input type="text" class="form-control" id="estado_civil" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contacto_aluno">Contacto Aluno</label>
                            <input type="text" class="form-control" id="contacto_aluno">
                        </div>
                        <div class="form-group">
                            <label for="contacto_enca1">Contacto Encarregado 1</label>
                            <input type="text" class="form-control" id="contacto_enca1" required>
                        </div>
                        <div class="form-group">
                            <label for="contacto_enca2">Contacto Encarregado 2</label>
                            <input type="text" class="form-control" id="contacto_enca2" required>
                        </div>
                        <div class="form-group">
                            <label for="classe">Classe</label>
                            <input type="text" class="form-control" id="classe" required>
                        </div>
                        <div class="form-group">
                            <label for="curso">Curso</label>
                            <input type="text" class="form-control" id="curso" required>
                        </div>
                        <div class="form-group">
                            <label for="certificado">Certificado</label>
                            <input type="number" class="form-control" id="certificado" required>
                        </div>
                        <div class="form-group">
                            <label for="copia_bi">Copia do BI</label>
                            <input type="number" class="form-control" id="copia_bi" required>
                        </div>
                        <button type="submit" id="salvarAlunoBtn" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../public/aluno.js"></script>
</body>
</html>
