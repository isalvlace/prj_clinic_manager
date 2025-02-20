<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="/prj_clinic_manager/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Para ícones -->

    <!-- CSS do DataTables -->
    <link rel="stylesheet" href="/prj_clinic_manager/assets/css/jquery.dataTables.min.css">
</head>
<body>
    <header>
        <div class="user-info">
            <h4>Bem-vindo, <?= htmlspecialchars($_SESSION["usuario_nome"]) ?>!</h4>
            <p>Seu nível de permissão: <?= $_SESSION["permissao_id"] ?></p>
        </div>
        <a href="index.php?page=sair" class="logout-btn">Sair</a>
    </header>

    <div class="wrapper">
        <input type="checkbox" id="menu-checkbox">
        <nav class="menu">
            <label for="menu-checkbox" class="menu-toggle">
                <span></span><span></span><span></span>
            </label>
            <ul>
                <li><a href="#"><i class="fa-solid fa-file"></i> Lista Arquivos</a></li>
                <li><a href="#"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <h2 class="lista-arquivos">Lista de Arquivos</h2>
            <hr>

            <div class="upload-container">
                <label for="file-upload" class="upload-box">Clique ou arraste o arquivo</label>
                <input type="file" id="file-upload" class="file-input" />
                <div class="button-container">
                    <button id="cancel-button" class="cancel-btn">Cancelar</button>
                    <button id="upload-button" class="upload-btn" disabled>Subir</button>  
                </div>
            </div>

            <table id="tabela-arquivos">
                <thead>
                    <tr>
                        <th>Arquivo</th>
                        <th>Vinculado</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>arquivo1.pdf</td>
                        <td>Bugs Bunny</td>
                        <td>15/02/2025</td>
                    </tr>
                    <tr>
                        <td>arquivo2.pdf</td>
                        <td>Harold</td>
                        <td>15/02/2025</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="/prj_clinic_manager/assets/js/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables -->
    <script type="text/javascript" src="/prj_clinic_manager/assets/js/jquery.dataTables.min.js"></script>
    
    <!-- Seu script personalizado -->
    <script type="text/javascript" src="/prj_clinic_manager/assets/js/script.js"></script>

    <script type="text/javascript">
        // DATATABLE
        if ($.fn.dataTable.isDataTable('#tabela-arquivos')) {
            $('#tabela-arquivos').DataTable().clear().destroy();
        }
    
        $('#tabela-arquivos').DataTable({
            "language": {
                "sEmptyTable": "Nenhum dado disponível na tabela",
                "sInfo": "Mostrando _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros totais)",
                "sLengthMenu": "_MENU_ registros por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sSearch": "Buscar:",
                "sZeroRecords": "Nenhum registro encontrado",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sLast": "Último",
                    "sNext": "Próximo",
                    "sPrevious": "Anterior"
                }
            },
        });
    </script>
</body>
</html>