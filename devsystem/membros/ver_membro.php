<!DOCTYPE html>
<html lang="pt_BR"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sistema Administrativo - Academia Dev Fitness</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/adminlte.css">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <?php include '../header.php'; ?>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <?php include '../menu.php'; ?>
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Visualizar Membro</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Visualizar Membro</li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><i class="bi bi-person"></i> Dados do Membro</h3>
                                    <div class="ms-auto d-flex">
                                        <a id="edit-member-btn" href="#" class="btn btn-warning me-2">
                                            <i class="bi bi-pencil"></i> Editar Membro
                                        </a>
                                        <a id="delete-member-btn" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Deletar Membro
                                        </a>
                                    </div>
                                </div> <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered" id="member-info">
                                        <!-- Aqui será carregada a informação do membro -->
                                    </table>
                                    <br>
                                    <h3 class="card-title"><i class="bi bi-cash"></i> Pagamentos</h3>
                                    <br><br>
                                    <table class="table table-bordered" id="member-payments">
                                        <!-- Aqui será carregada a lista de pagamentos -->
                                    </table>
                                    <br>
                                    <h3 class="card-title"><i class="bi bi-activity"></i> Planos</h3>
                                    <br><br>
                                    <table class="table table-bordered" id="member-plans">
                                        <!-- Aqui será carregada a lista de planos -->
                                    </table>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                    </div> <!-- /.row (main row) -->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main-->
        <?php include '../footer.php'; ?>
    </div> <!--end::App Wrapper-->

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('auth_token');
            const memberId = new URLSearchParams(window.location.search).get('id');

            // Função para definir o link do botão "Editar Membro"
            document.getElementById('edit-member-btn').setAttribute('href', `editar_membro.php?id=${memberId}`);

            // Função para buscar os dados do membro
            async function fetchMemberData() {
                try {
                    const response = await fetch(`https://www.rodrigozambon.com.br/devfitness/api/members/${memberId}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Erro ao buscar dados do membro.');
                    }

                    const data = await response.json();
                    displayMemberInfo(data.member);
                } catch (error) {
                    console.error('Erro:', error);
                    document.getElementById('member-info').innerHTML = `<p>${error.message}</p>`;
                }
            }

            // Função para exibir os dados do membro
            function displayMemberInfo(member) {
                const dateOfBirth = member.date_of_birth.split('-').reverse().join('/');
                const memberInfo = `
                    <tr><th>ID</th><td>${member.id}</td></tr>
                    <tr><th>Nome</th><td>${member.name}</td></tr>
                    <tr><th>Email</th><td>${member.email}</td></tr>
                    <tr><th>CPF</th><td>${member.cpf}</td></tr>
                    <tr><th>Telefone</th><td>${member.phone}</td></tr>
                    <tr><th>Data de Nascimento</th><td>${dateOfBirth}</td>
                    <tr><th>Gênero</th><td>${member.gender}</td></tr>
                    <tr><th>Data de Criação</th><td>${new Date(member.created_at).toLocaleDateString('pt-BR')}</td></tr>
                `;
                document.getElementById('member-info').innerHTML = memberInfo;
            }

            // Função para buscar os pagamentos do membro
            async function fetchMemberPayments() {
                try {
                    const response = await fetch(`https://www.rodrigozambon.com.br/devfitness/api/members/${memberId}/payments`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Erro ao buscar pagamentos do membro.');
                    }

                    const data = await response.json();
                    displayMemberPayments(data);
                } catch (error) {
                    console.error('Erro:', error);
                    document.getElementById('member-payments').innerHTML = `<p>${error.message}</p>`;
                }
            }

            // Função para exibir os pagamentos do membro
            function displayMemberPayments(payments) {
                let paymentsInfo = '<thead><tr><th>ID</th><th>Data</th><th>Método de Pagamento</th><th>Status</th></tr></thead><tbody>';
                
                if (payments.length > 0) {
                    payments.forEach(payment => {
                        paymentsInfo += `
                            <tr>
                                <td>${payment.id}</td>
                                <td>${new Date(payment.date).toLocaleDateString('pt-BR')}</td>
                                <td>${payment.payment_method}</td>
                                <td>${payment.status === "1" ? "Pago" : "Pendente"}</td>
                            </tr>
                        `;
                    });
                } else {
                    paymentsInfo += '<tr><td colspan="4">Nenhum pagamento encontrado</td></tr>';
                }

                paymentsInfo += '</tbody>';
                document.getElementById('member-payments').innerHTML = paymentsInfo;
            }

            // Função para buscar os planos do membro
            async function fetchMemberPlans() {
                try {
                    const response = await fetch(`https://www.rodrigozambon.com.br/devfitness/api/members/${memberId}/plans`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Erro ao buscar planos do membro.');
                    }

                    const data = await response.json();
                    displayMemberPlans(data);
                } catch (error) {
                    console.error('Erro:', error);
                    document.getElementById('member-plans').innerHTML = `<p>${error.message}</p>`;
                }
            }

            // Função para exibir os planos do membro
            function displayMemberPlans(plans) {
                let plansInfo = '<thead><tr><th>ID</th><th>Tipo de Plano</th><th>Início</th><th>Fim</th><th>Status</th></tr></thead><tbody>';
                
                if (plans.length > 0) {
                    plans.forEach(plan => {
                        plansInfo += `
                            <tr>
                                <td>${plan.id}</td>
                                <td>${plan.plan_type}</td>
                                <td>${new Date(plan.start_date).toLocaleDateString('pt-BR')}</td>
                                <td>${new Date(plan.end_date).toLocaleDateString('pt-BR')}</td>
                                <td>${plan.status}</td>
                            </tr>
                        `;
                    });
                } else {
                    plansInfo += '<tr><td colspan="5">Nenhum plano encontrado</td></tr>';
                }

                plansInfo += '</tbody>';
                document.getElementById('member-plans').innerHTML = plansInfo;
            }

            // Função para deletar o membro
            document.getElementById('delete-member-btn').addEventListener('click', async function(event) {
                event.preventDefault();

                if (!confirm('Você tem certeza que deseja deletar este membro? Esta ação não pode ser desfeita.')) {
                    return;
                }

                try {
                    const response = await fetch(`https://www.rodrigozambon.com.br/devfitness/api/members/${memberId}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Erro ao deletar membro. Status: ' + response.status);
                    }

                    const data = await response.json();
                    if (data.status === true) {
                        alert('Membro deletado com sucesso!');
                        window.location.href = '/devsystem/dashboard.php';
                    } else {
                        alert('Erro ao deletar membro: ' + data.message);
                    }

                } catch (error) {
                    console.error('Erro ao deletar membro:', error);
                    alert('Erro ao tentar deletar o membro.');
                }
            });

            fetchMemberData();
            fetchMemberPayments();
            fetchMemberPlans();
        });
    </script>
</body>
</html>
