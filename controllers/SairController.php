<?php
class SairController {
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit();
    }
}
