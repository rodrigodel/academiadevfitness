<!DOCTYPE html>
<html lang="pt_BR"> 

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sistema Administrativo - Academia Dev Fitness</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AdminLTE - Dev Fitness Dashboard">
    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/adminlte.css">
    <!-- Apexcharts and JSVectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> 
    <!-- App Wrapper -->
    <div class="app-wrapper">
        <!-- Header -->
        <?php include 'header.php'; ?>
        <!-- Sidebar -->
        <?php include 'menu.php'; ?>
        <!-- App Main Content -->
        <main class="app-main">
            <!-- Content Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Cards -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>59</h3>
                                    <p>Total de Alunos</p>
                                </div>
                                <div class="small-box-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    <h3>23</h3>
                                    <p>Alunos no Plano Silver</p>
                                </div>
                                <div class="small-box-icon">
                                    <i class="bi bi-trophy-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-warning">
                                <div class="inner">
                                    <h3>37</h3>
                                    <p>Alunos no Plano Gold</p>
                                </div>
                                <div class="small-box-icon">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-danger">
                                <div class="inner">
                                    <h3>21</h3>
                                    <p>Alunos no Plano Black</p>
                                </div>
                                <div class="small-box-icon">
                                    <i class="bi bi-gem-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabela de Membros -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de Alunos</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>CPF</th>
                                                <th>Telefone</th>
                                                <th>Data de Nascimento</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="student-list">
                                            <!-- Os alunos serão carregados aqui via JS -->
                                        </tbody>
                                    </table>
                                    <br>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" id="pagination">
                                            <!-- A paginação será gerada aqui -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="js/adminlte.js"></script>

    <!-- JavaScript para buscar alunos da API e fazer paginação -->
    <script>
        let currentPage = 1;

    async function fetchStudents(page = 1) {
        const token = localStorage.getItem('auth_token');

        if (!token) {
            document.getElementById('student-list').innerHTML = '<p style="color: red;">Token de autenticação não encontrado. Faça login novamente.</p>';
            return;
        }

        const perPage = 25;

        try {
            const response = await fetch(`https://www.rodrigozambon.com.br/devfitness/api/members?page=${page}&per_page=${perPage}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok) {
                let students = data.members.data;
                let totalPages = data.members.last_page;

                let html = '';

                students.forEach(student => {
                    // Usar a string diretamente e reformatá-la sem criar um objeto Date
                    let dateOfBirth = student.date_of_birth.split('-').reverse().join('/'); // Converte de "YYYY-MM-DD" para "DD/MM/YYYY"

                    html += `
                        <tr>
                            <td>${student.id}</td>
                            <td>${student.name}</td>
                            <td>${student.email}</td>
                            <td>${student.cpf}</td>
                            <td>${student.phone}</td>
                            <td>${dateOfBirth}</td> <!-- Agora formatado corretamente -->
                            <td>
                                <a href="./membros/ver_membro.php?id=${student.id}" class="btn btn-info btn-sm" title="Ver Membro">
                                    <i class="bi bi-person"></i>
                                </a>
                                <a href="/ver-plano/${student.id}" class="btn btn-warning btn-sm" title="Ver Plano">
                                    <i class="bi bi-activity"></i>
                                </a>
                                <a href="/ver-pagamentos/${student.id}" class="btn btn-success btn-sm" title="Ver Pagamentos">
                                    <i class="bi bi-cash"></i>
                                </a>
                            </td>
                        </tr>`;
                });

                document.getElementById('student-list').innerHTML = html;
                generatePagination(totalPages, page);
            }
        } catch (error) {
            document.getElementById('student-list').innerHTML = `<p style="color: red;">Erro ao buscar alunos: ${error.message}</p>`;
        }
    }

    // Função para gerar a paginação
    function generatePagination(totalPages, currentPage) {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        if (currentPage > 1) {
            pagination.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="fetchStudents(${currentPage - 1})">Anterior</a></li>`;
        }

        for (let i = 1; i <= totalPages; i++) {
            const activeClass = i === currentPage ? 'active' : '';
            pagination.innerHTML += `<li class="page-item ${activeClass}"><a class="page-link" href="#" onclick="fetchStudents(${i})">${i}</a></li>`;
        }

        if (currentPage < totalPages) {
            pagination.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="fetchStudents(${currentPage + 1})">Próxima</a></li>`;
        }
    }

    // Carregar os alunos da primeira página ao iniciar a página
    fetchStudents(currentPage);

        </script>
        <script>
            document.getElementById('logout-link').addEventListener('click', function(event) {
            // Desabilita o link de logout imediatamente para evitar múltiplos cliques
            event.preventDefault();
            document.getElementById('logout-link').disabled = true;

            // Remove o token do localStorage, independentemente do sucesso da requisição
            localStorage.removeItem('auth_token');

            // Faz a requisição de logout à API sem tratamento complexo
            fetch('https://www.rodrigozambon.com.br/devfitness/api/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .finally(() => {
                // Redireciona diretamente para a página de login após a requisição
                window.location.replace('/devfront/login.php');
            });
        });
    </script>
</body>

</html>
