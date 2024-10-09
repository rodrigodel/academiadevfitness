<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cadastrar Aluno - Dev Fitness</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AdminLTE - Cadastrar Aluno">
    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/adminlte.css">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!-- App Wrapper -->
    <div class="app-wrapper">
        <!-- Header -->
        <?php include '../header.php'; ?>
        <!-- Sidebar -->
        <?php include '../menu.php'; ?>

        <!-- App Main Content -->
        <main class="app-main">
            <!-- App Content Header -->
            <div class="app-content-header">
                <!-- Container -->
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Cadastrar Novo Aluno</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Cadastrar Aluno</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="app-content">
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <!-- Card de Cadastro -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Formulário de Cadastro de Aluno</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Formulário de cadastro de aluno -->
                                    <form id="formCadastrarAluno">
                                        <div class="form-group mb-3">
                                            <label for="name">Nome</label>
                                            <input type="text" class="form-control" id="name" placeholder="Digite o nome do aluno" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Digite o email do aluno" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="cpf">CPF</label>
                                            <input type="text" class="form-control" id="cpf" placeholder="Digite o CPF do aluno" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone">Telefone</label>
                                            <input type="text" class="form-control" id="phone" placeholder="Digite o telefone do aluno" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="date_of_birth">Data de Nascimento</label>
                                            <input type="date" class="form-control" id="date_of_birth" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="gender">Gênero</label>
                                            <select class="form-control" id="gender" required>
                                                <option value="">Selecione o gênero</option>
                                                <option value="male">Masculino</option>
                                                <option value="female">Feminino</option>
                                                <option value="other">Outro</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                                    </form>

                                    <!-- Mensagem de resposta -->
                                    <div id="responseMessage" style="margin-top: 20px;"></div>
                                </div>
                            </div>
                            <!-- Fim do Card de Cadastro -->
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <?php include '../footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../js/adminlte.js"></script>

    <script>
        document.getElementById('formCadastrarAluno').addEventListener('submit', async function (e) {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const cpf = document.getElementById('cpf').value;
            const phone = document.getElementById('phone').value;
            const dateOfBirth = document.getElementById('date_of_birth').value;
            const gender = document.getElementById('gender').value;

            const responseMessage = document.getElementById('responseMessage');

            try {
                const token = localStorage.getItem('auth_token');

                if (!token) {
                    responseMessage.innerHTML = `<p style="color: red;">Token de autenticação não encontrado. Faça login novamente.</p>`;
                    return;
                }

                const response = await fetch('https://www.rodrigozambon.com.br/devfitness/api/members', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        cpf: cpf,
                        phone: phone,
                        date_of_birth: dateOfBirth,
                        gender: gender
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    responseMessage.innerHTML = `<p style="color: green;">Aluno cadastrado com sucesso!</p>`;
                    // Limpar o formulário após sucesso
                    document.getElementById('formCadastrarAluno').reset();
                } else {
                    responseMessage.innerHTML = `<p style="color: red;">Erro ao cadastrar aluno: ${data.message}</p>`;
                }
            } catch (error) {
                responseMessage.innerHTML = `<p style="color: red;">Erro ao tentar cadastrar aluno: ${error.message}</p>`;
            }
        });
    </script>
</body>

</html>
