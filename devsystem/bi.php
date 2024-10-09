<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Dashboard de Negócios - Dev Fitness</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AdminLTE - Cadastrar Aluno">
    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/adminlte.css">
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
            <!-- App Content Header -->
            <div class="app-content-header">
                <!-- Container -->
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard de Negócios</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard de Negócios</li>
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
                                    <h4 class="card-title mb-0">Dashboard de Negócios</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Formulário de cadastro de aluno -->
                                    <div style="height:1000px;width:1200px; overflow: hidden;">
                                        <iframe 
                                            src="https://app.powerbi.com/view?r=eyJrIjoiMzhjZjAyNDQtMTIzZi00MzkwLThkN2MtNjhiNjk1YTcwZDIwIiwidCI6IjU1M2UyMzIwLWU5YWQtNDIzNi1iYWE3LThjZTBhNzIzZWQyNCJ9" 
                                            frameborder="0" 
                                            style="object-fit: contain; width:100%; height:100%;" 
                                            allowFullScreen="true">
                                        </iframe>
                                    </div>

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
        <?php include 'footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="js/adminlte.js"></script>

</body>

</html>
