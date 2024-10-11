<div class="container mt-5">
    <div class="text-center">
        <h2 class="animate__animated animate__fadeIn">Ficha de Inscrição</h2>
    </div>
    <form action="adimissao.php" enctype="multipart/form-data" method="post" id="formularioAdmissao" class="needs-validation animate__animated animate__zoomIn" novalidate>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome completo" required>
            </div>
            <div class="col-md-6">
                <label for="data" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data" name="data" required>
            </div>
            <div class="col-md-6">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="" selected disabled>Selecione...</option>
                    <option value="F">Feminino</option>
                    <option value="M">Masculino</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="municipio" class="form-label">Município</label>
                <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Seu município" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
            </div>
            <div class="col-md-6">
                <label for="bi" class="form-label">Nº do BI</label>
                <input type="text" class="form-control" id="bi" name="bi" placeholder="Número do Bilhete de Identidade" required>
            </div>
            <div class="col-md-6">
                <label for="certificado" class="form-label">Certificado ou Declaração</label>
                <input type="file" class="form-control" id="certificado" name="certificado" required>
            </div>
            <div class="col-md-6">
                <label for="copia" class="form-label">Cópia do BI ou Passaporte</label>
                <input type="file" class="form-control" id="copia" name="copia" required>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary animate__animated animate__pulse">Enviar Inscrição</button>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
