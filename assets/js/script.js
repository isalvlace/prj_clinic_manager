document.addEventListener("DOMContentLoaded", function () {
    function alternarClasseRaiz() {
        const atual = document.documentElement.getAttribute('data-bs-theme');
        document.documentElement.setAttribute('data-bs-theme', atual === 'dark' ? 'light' : 'dark');
    }

    function eClaro() {
        return localStorage.getItem("light");
    }

    function aplicarTemaInicial() {
        if (eClaro()) {
            alternarClasseRaiz();
        }
    }

    function alternarLocalStorage() {
        eClaro() ? localStorage.removeItem("light") : localStorage.setItem("light", "set");
    }

    function inicializarAlternanciaTema() {
        const themeToggle = document.querySelector(".theme-toggle");
        if (themeToggle) {
            themeToggle.addEventListener("click", function () {
                alternarLocalStorage();
                alternarClasseRaiz();
            });
        }
    }

    function alternarSidebar() {
        document.querySelector("#sidebar").classList.toggle("collapsed");
        const menuIcon = document.querySelector("#sidebar-toggle i");
        if (menuIcon) {
            menuIcon.classList.toggle("fa-bars");
            menuIcon.classList.toggle("fa-times");
        }
    }

    function inicializarToggleSidebar() {
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        if (sidebarToggle) {
            sidebarToggle.addEventListener("click", alternarSidebar);
        }
    }

    function funcionalidadesCarregamento() {
        const fileInput = document.getElementById("file-upload");
        const uploadBox = document.querySelector(".upload-box");
        const uploadText = document.getElementById("upload-text");
        const uploadButton = document.getElementById("upload-button");
        const cancelButton = document.getElementById("cancel-button");

        if (uploadButton) {
            uploadButton.addEventListener("click", function (event) {
                enviarArquivo(event); 
            });
        }

        if (fileInput) {
            fileInput.addEventListener("change", function () {
                if (fileInput.files.length > 0) {
                    uploadText.textContent = fileInput.files[0].name;  
                    uploadButton.disabled = false;  
                    uploadBox.classList.add("file-selected");  
                } else {
                    resetUploadBox();
                }
            });
        }
    
        if (uploadBox) {
            uploadBox.addEventListener("dragover", function (e) {
                e.preventDefault();
                uploadBox.style.backgroundColor = "#8ec1f0";  
            });
    
            uploadBox.addEventListener("dragleave", function () {
                uploadBox.style.backgroundColor = "";  
            });
    
            uploadBox.addEventListener("drop", function (e) {
                e.preventDefault();
                fileInput.files = e.dataTransfer.files;   
                uploadText.textContent = fileInput.files[0].name;  
                uploadButton.disabled = false; 
                uploadBox.classList.add("file-selected");  
            });
        }
    
        if (cancelButton) {
            cancelButton.addEventListener("click", function () {
                resetUploadBox();
            });
        }
    
        function resetUploadBox() {
            fileInput.value = "";  
            uploadText.textContent = "Clique ou arraste o arquivo";  
            uploadButton.disabled = true; 
            uploadBox.classList.remove("file-selected");  
            uploadBox.style.backgroundColor = "";  
        }
    } 
    
    function enviarArquivo(event) {
        event.preventDefault(); 

        const form = document.getElementById("upload-form");
        if (!form) {
            alert("Formulário não encontrado.");
            return;
        }
    
        const formData = new FormData(form);
    
        fetch(form.action, {
            method: form.method,  
            body: formData,  
            headers: {
                'Accept': 'application/json' 
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro de resposta do servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
                window.location.reload(); 
            } else {
                alert("Erro ao salvar arquivo: " + data.message);
            }
        })
        .catch(error => {
            alert("Erro de conexão ou outro problema: " + error);
        });
    }

    aplicarTemaInicial();
    inicializarAlternanciaTema();
    inicializarToggleSidebar();
    funcionalidadesCarregamento();
});