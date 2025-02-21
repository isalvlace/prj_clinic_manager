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

    aplicarTemaInicial();
    inicializarAlternanciaTema();
    inicializarToggleSidebar();
});
