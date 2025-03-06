<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/prj_clinic_manager/assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/prj_clinic_manager/login" method="POST">
            <div>
                <label class="label-login-container" for="email">E-mail</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <button id="btn-entrar" type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
