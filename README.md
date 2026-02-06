# 🏥 Clinic Manager - Sistema de Gestão de Exames

Este é um sistema para gerenciamento de exames, permitindo o upload de arquivos via FTP, listagem dinâmica e vínculo de documentos a pacientes específicos.

## 🚀 Como rodar o projeto

O projeto utiliza **Docker** para garantir que todo o ambiente (PHP, Apache, MySQL e Servidor FTP) suba de forma idêntica em qualquer máquina.

1. **Clonar o repositório:**
   ```bash
   git clone https://github.com/isalvlace/prj_clinic_manager.git
   cd prj_clinic_manager

2. **Subir os containers:**
  docker compose up -d --build

3. **Acessar:**
  Abra o navegador e acesse: http://localhost:8080
  login: admin@clinica.com
  senha: senha123 