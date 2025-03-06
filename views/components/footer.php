        <footer class="footer"> <!-- Início do footer -->
            <div class="container-fluid"> <!-- Início do container-fluid -->
                <div class="row text-muted"> <!-- Início do row -->
                    <div class="col-6 text-start"> <!-- Início do col -->
                        <p class="mb-0">
                        </p>
                    </div> <!-- Fim do col -->
                    <div class="col-6 text-end">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Unbrella Corporation</a>
                            </li>
                        </ul>
                    </div>
                </div> <!-- Fim do row -->
            </div> <!-- Fim do container-fluid -->
        </footer> <!-- Fim do footer -->
    </div> <!-- Fim do main -->
</div> <!-- Fim do wrapper -->

<!-- Scripts -->
<script src="/prj_clinic_manager/assets/js/jquery-3.6.0.min.js"></script>
<script src="/prj_clinic_manager/assets/js/jquery.dataTables.min.js"></script>
<script src="/prj_clinic_manager/assets/js/bootstrap.bundle.min.js"></script>
<script src="/prj_clinic_manager/assets/js/script.js"></script>

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













