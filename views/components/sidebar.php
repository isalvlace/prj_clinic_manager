<aside id="sidebar" class="js-sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="/prj_clinic_manager/home">Clinic Manager</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">Administrativo</li>
            <li class="sidebar-item">
                <a href="/prj_clinic_manager/home?page=dashboard" class="sidebar-link">
                    <i class="fa-solid fa-list pe-2"></i> Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fa-solid fa-file-lines pe-2"></i> Listas
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/prj_clinic_manager/home?page=table" class="sidebar-link">Exames</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>