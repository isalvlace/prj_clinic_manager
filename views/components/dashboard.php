<main class="content px-3 py-2"> <!-- Início do content -->
    <div class="container-fluid"> <!-- Início do container-fluid -->
        <div class="mb-3">
            <h4>Admin Dashboard</h4>
        </div>
        <div class="row">  
            <div class="col-12 col-md-6 d-flex">  
                <div class="card flex-fill border-0 illustration">  
                    <div class="card-body p-0 d-flex flex-fill">  
                        <div class="row g-0 w-100">  
                            <div class="col-6">
                                <div class="p-3 m-1">
                                    <h4>Bem-vindo, <?= htmlspecialchars($_SESSION["usuario_nome"]) ?>!</h4>
                                    <p>Seu nível de permissão é: <?= $_SESSION["perfil"] ?></p>
                                </div>
                            </div>
                        </div>  
                    </div>  
                </div>  
            </div>  
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h4 class="mb-2">
                                    176 exames no último mês
                                </h4>
                                <p class="mb-2">
                                    Total de exames nesta semana
                                </p>
                                <div class="mb-0">
                                    <span class="badge text-success me-2">
                                        25
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Fim do container-fluid -->
</main> <!-- Fim do content -->
