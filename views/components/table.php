<form id="upload-form" action="/prj_clinic_manager/salvar-arquivo" method="POST" enctype="multipart/form-data">
    <div class="upload-container">
        <label for="file-upload" class="upload-box">
            <span id="upload-text">Clique ou arraste o arquivo</span>
        </label>
        <input type="file" id="file-upload" name="arquivo" class="file-input" />
        <div class="button-container">
            <button id="cancel-button" class="cancel-btn" type="button">Cancelar</button>
            <button id="upload-button" class="upload-btn" type="submit" disabled>Subir</button>
        </div>
    </div>
</form>

<div class="card border-0">
    <div class="card-header">
        <h5 class="card-title">Exames</h5>
    </div>
    <div class="card-body">
        <table id="tabela-arquivos" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Caminho</th>
                    <th>Data</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arquivos as $indice => $arquivo): ?>
                    <tr>
                        <td><?= $indice + 1 ?></td>
                        <td><?= htmlspecialchars($arquivo['nome']) ?></td>
                        <td><?= htmlspecialchars($arquivo['caminho']) ?></td>
                        <td><?= htmlspecialchars($arquivo['criado_em']) ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-vincular" data-bs-toggle="modal"
                                data-bs-target="#modalVincular" data-id="<?= htmlspecialchars($arquivo['id']) ?>">
                                Vincular
                            </button>
                        <td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalVincular" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/prj_clinic_manager/vincular-arquivo" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Vincular Arquivo a Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="nome-usuario" class="form-label">Nome do Usuário</label>
                    <input type="text" id="nome-usuario" class="form-control" placeholder="Digite o nome do usuário">
                </div>

                <button type="button" id="btn-pesquisar" class="btn btn-primary mb-3">Pesquisar</button>

                <div id="resultado-pesquisa" class="alert alert-info d-none"></div>

                <input type="hidden" name="usuario_id" id="usuario-id" required>
                <input type="hidden" name="arquivo_id" id="arquivo-id" required>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btn-vincular" disabled>Vincular</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>