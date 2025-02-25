<div class="upload-container">
    <label for="file-upload" class="upload-box">
        <span id="upload-text">Clique ou arraste o arquivo</span>
    </label>
    <input type="file" id="file-upload" class="file-input" />
    <div class="button-container">
        <button id="cancel-button" class="cancel-btn">Cancelar</button>
        <button id="upload-button" class="upload-btn" disabled>Subir</button>  
    </div>
</div>


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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arquivos as $indice => $arquivo): ?>
                    <tr>
                        <td><?= $indice + 1 ?></td>
                        <td><?= htmlspecialchars($arquivo['nome_arquivo']) ?></td>
                        <td><?= htmlspecialchars($arquivo['caminho']) ?></td>
                        <td><?= htmlspecialchars($arquivo['criado_em']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>  
    </div>  
</div>  
   