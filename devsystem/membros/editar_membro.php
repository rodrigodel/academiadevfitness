<!DOCTYPE html>
<html lang="pt_BR"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Editar Membro - Academia Dev Fitness</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AdminLTE - Dev Fitness Dashboard">
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
            <!-- Content Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Editar Membro</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Editar Membro</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Formulário de Edição de Membro -->
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Dados do Membro</h3>
                                </div>
                                <div class="card-body">
                                    <form id="editMemberForm">
                                        <div class="form-group">
                                            <label for="name">Nome</label>
                                            <input type="text" id="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" id="cpf" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Telefone</label>
                                            <input type="text" id="phone" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_of_birth">Data de Nascimento</label>
                                            <input type="date" id="date_of_birth" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gênero</label>
                                            <select id="gender" class="form-control" required>
                                                <option value="male">Masculino</option>
                                                <option value="female">Feminino</option>
                                            </select>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    </form>
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../js/adminlte.js"></script>

    <script>
        // Função para buscar os dados do membro a partir da API e preencher o formulário
        async function fetchMemberData(memberId) {
            const token = localStorage.getItem('auth_token');
            const response = await fetch(`https://www.rodrigozambon.com.br/devfitness/api/members/${memberId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok) {
                const member = data.member;
                document.getElementById('name').value = member.name;
                document.getElementById('email').value = member.email;
                document.getElementById('cpf').value = member.cpf;
                document.getElementById('phone').value = member.phone;
                document.getElementById('date_of_birth').value = member.date_of_birth;
                document.getElementById('gender').value = member.gender;
            } else {
                console.error('Erro ao buscar dados do membro:', data.message);
            }
        }

        // Função para enviar os dados editados para a API
        document.getElementById('editMemberForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const memberId = new URLSearchParams(window.location.search).get('id');
            const token = localStorage.getItem('auth_token');

            const memberData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                cpf: document.getElementById('cpf').value,
                phone: document.getElementById('phone').value,
                date_of_birth: document.getElementById('date_of_birth').value,
                gender: document.getElementById('gender').value
            };

            const response = await fetch(`https://www.rodrigozambon.com.br/devfitness/api/members/${memberId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(memberData)
            });

            const data = await response.json();

            if (response.ok) {
                alert('Membro atualizado com sucesso!');
                window.location.href = '../dashboard.php';
            } else {
                alert('Erro ao atualizar membro: ' + data.message);
            }
        });

        // Carrega os dados do membro ao carregar a página
        document.addEventListener('DOMContentLoaded', function() {
            const memberId = new URLSearchParams(window.location.search).get('id');
            if (memberId) {
                fetchMemberData(memberId);
            } else {
                alert('ID do membro não encontrado.');
            }
        });
    </script>
</body>
</html>
