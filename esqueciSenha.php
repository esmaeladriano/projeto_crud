<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center">
            <h1 style="margin-top: 100px; font-weight: bold;">Esqueceu sua senha?</h1>
            <p>Digite seu e-mail abaixo e enviaremos um link para redefinir sua senha.</p>
        </div>
        <div class="col-12 col-md-6 mt-4">
            <fieldset class="container w-100" style="border: 1px solid #ced4da; border-radius: 10px; background-color: #f9f9f9; padding: 20px;">
                <h2 class="text-center" style="color: #34495e; margin-bottom: 20px;">Recuperar senha</h2>

                <form action="send_reset_email.php" method="post">
                    <div class="col mb-3">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #ecf0f1; border: none;">
                                <i class="fa fa-envelope" aria-hidden="true" style="font-size: 1.2em;"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Digite seu e-mail" style="border-left: none; border-radius: 0 5px 5px 0;">
                        </div>
                    </div>
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary mt-3" style="width: 50%;">Enviar</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>
