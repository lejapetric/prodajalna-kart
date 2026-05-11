<?php
class LogoutController {
    public static function index() {
        $_SESSION = array();
        // Destroy the session.
        //session_destroy();
        ViewHelper::render("view/logout.php");
    }
}
