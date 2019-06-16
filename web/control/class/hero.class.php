<?php


class hero {

    /**
     * Check for Page Module
     *
     * @param string $pageName Nome della pagina
     * @return page Inclusione della pagina /module/NomeModulo/mod_util.php
     */
    public static function checkModule($pageName) {
        if (file_exists(MODULE_PATH . DS . $pageName . DS . 'mod_util.php')) {
            include_once(MODULE_PATH . DS . $pageName . DS . 'mod_util.php');
        }
    }

    public static function loadModuleJS($pageName, $action = null) {
        if (file_exists(MODULE_PATH . DS . $pageName . DS . 'js_script.php')) {
            include_once(MODULE_PATH . DS . $pageName . DS . 'js_script.php');
        }

        if(isset($action)){
            if (file_exists(JS_PATH . DS . $pageName . DS . $action . ".js")) {
                echo "<script>";
                include_once(JS_PATH . DS . $pageName . DS . $action . ".js");
                echo "</script>";
            }
        }
    }

    public static function loadModule($request) {
        global $page;
        $Module = $GLOBALS['ModuleInfo'];
        if (isset($request['module']) && $request['module'] == $Module['name'] && in_array($request['action'], $Module['pages'])) {
            include_once(MODULE_PATH . DS . ucfirst($page) . DS . $request['action'] . ".php");
            return true;
        } else {
            return false;
        }
    }


    public static function loadModuleFunction($page) {
        include_once(MODULE_PATH . DS . ucfirst($page) . DS . "mod_util.php");
    }


    public static function menuLoader($role, $page = 'Home') {
        global $mysqli;

        $active = "";
        $result = $mysqli->query("SELECT label, link, icon FROM menu WHERE role = '$role' OR role = 'GLOBAL' ORDER BY ordine_menu ASC");
        while ($menu = $result->fetch_assoc()) {
            if ($page == substr($menu['link'], strpos($menu['link'], "?") + 1)) {
                $active = 'class="active"';
            } else {
                $active = "";
            }

            echo '<li ' . $active . '>
                    <a href="' . $menu['link'] . '">
                        <i class="material-icons">' . $menu['icon'] . '</i>
                        <p>' . $menu['label'] . '</p>
                    </a>
                </li>';
        }
    }

    function createPage() {
        //crea pagina con modulo
    }

    /**
     * ACL
     * L'idea semplice e far fare solo
     * un redirect a 401.html, altrimenti vai liscio
     *
     * @param $user_id => $_SESSION['user_id']
     * @param $tipo_user => $_SESSION['tipo_user']
     */
    function ACL($user_id, $tipo_user){
        // echo "<script>window.location = '401.html';</script>";
    }


}
