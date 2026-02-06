<form id="upload-form" action="/salvar-arquivo" method="POST" enctype="multipart/form-data">
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

<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucesso!</strong> O arquivo foi vinculado corretamente ao usuário.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0">
    <div class="card-header">
        <h5 class="card-title">Exames</h5>
    </div>
    <div class="card-body">
        <table id="tabela-arquivos" class="display">
            <thead>
                <tr>
                    <tr>
                        <th>Id</th>
                        <th>Nome do Arquivo</th>
                        <th>Paciente / Status</th> 
                        <th>Caminho FTP</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arquivos as $indice => $arquivo): ?>
                    <tr>
                        <td><?= $indice + 1 ?></td>
                        <td><?= htmlspecialchars($arquivo['nome']) ?></td>
                        <td>
                            <?php if (!empty($arquivo['nome_usuario'])): ?>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    <?= htmlspecialchars($arquivo['nome_usuario']) ?>
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Pendente
                                </span>
                            <?php endif; ?>
                        </td> 
                        <td><small class="text-muted"><?= htmlspecialchars($arquivo['caminho']) ?></small></td>
                        <td><?= date('d/m/Y H:i', strtotime($arquivo['criado_em'])) ?></td>
                        <td>
                            <button class="btn <?= empty($arquivo['nome_usuario']) ? 'btn-primary' : 'btn-outline-secondary' ?> btn-sm btn-vincular" 
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalVincular" 
                                    data-id="<?= htmlspecialchars($arquivo['id']) ?>">
                                <?= empty($arquivo['nome_usuario']) ? 'Vincular' : 'Alterar Vínculo' ?>
                            </button>
                        </td> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalVincular" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/vincular-arquivo" method="POST" class="modal-content">
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