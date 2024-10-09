<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Login - DEV Fitness</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Login Page">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard">
    <meta name="keywords" content="bootstrap, admin dashboard">
    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/adminlte.css">

</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="login-logo">DEV Fitness</div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Entre com seu usuário e senha para acessar o sistema</p>
                <!-- Login Form -->
                <form id="loginForm">
                    <div class="input-group mb-3">
                        <input type="email" id="email" class="form-control" placeholder="Email">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" class="form-control" placeholder="Senha">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Credenciais de Acesso -->
                <div style="margin-top: 20px; text-align: center;">
                    <p><strong>Email:</strong> admin@example.com</p>
                    <p><strong>Senha:</strong> admin</p>
                </div>
                <!-- Response Message -->
                <div id="responseMessage" style="margin-top: 20px; color: red;"></div>
            </div> <!-- /.login-card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.login-box -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="js/adminlte.js"></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const responseMessage = document.getElementById('responseMessage');

            try {
                const response = await fetch('https://www.rodrigozambon.com.br/devfitness/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    // Armazena o token no localStorage
                    localStorage.setItem('auth_token', data.token);

                    responseMessage.style.color = 'green';
                    responseMessage.innerHTML = 'Login realizado com sucesso! Redirecionando...';

                    // Redireciona para o dashboard
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 2000);
                } else {
                    responseMessage.style.color = 'red';
                    responseMessage.innerHTML = `Erro no login: ${data.message}`;
                }

            } catch (error) {
                responseMessage.style.color = 'red';
                responseMessage.innerHTML = `Erro ao tentar fazer login: ${error.message}`;
            }
        });
    </script>
</body>

</html>
