<?php

class HomeController {
    public function index() {
        include_once __DIR__ . "/../views/components/head.php";
        include_once __DIR__ . "/../views/components/sidebar.php";
        include_once __DIR__ . "/../views/components/navbar.php";
        
        $page = $_GET['page'] ?? 'home';
        
        $pageFile = __DIR__ . "/../views/components/{$page}.php";

        if (file_exists($pageFile)) {
            include_once $pageFile;
        } else {
            echo "Página não encontrada!";
        }

        include_once __DIR__ . "/../views/components/footer.php";
    }
}
?>