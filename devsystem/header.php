<nav class="app-header navbar navbar-expand bg-body"> 
    <!--begin::Container-->
    <div class="container-fluid"> 
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="/devsystem/dashboard.php" class="nav-link">Lista de Alunos</a>
            </li>
        </ul>
        <!--end::Start Navbar Links--> 

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle--> 

            <!--begin::User Menu-->
            <li class="nav-item">
                <a class="nav-link" href="#" id="logout-link">Sair</a>
            </li>
            <!--end::User Menu-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>

<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();

        // Remove o token do localStorage
        localStorage.removeItem('auth_token');

        // Faz a requisição de logout à API
        fetch('https://www.rodrigozambon.com.br/devfitness/api/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .finally(() => {
            // Redireciona para a página de login
            window.location.replace('/devsystem/');
        });
    });
</script>
