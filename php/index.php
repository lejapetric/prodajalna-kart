<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('CSS_PATH', 'static/css/');

session_start();

// Najprej include ViewHelper ker ga potrebujemo za redirect
require_once("ViewHelper.php");

// Potem controllerji
require_once("controller/KarteController.php");
require_once("controller/StoreController.php");
require_once("controller/RegistracijaController.php");
require_once("controller/PrijavaController.php");
require_once("controller/OrderController.php");
require_once("controller/LogoutController.php");
require_once("controller/ProfileController.php");
require_once("controller/ProfileEditController.php");

#REST controllerji
require_once("controller/KarteRESTController.php");

// Popravljen BASE_URL - odstranite "/" na koncu, ker jo že dodaja $_SERVER["SCRIPT_NAME"]
define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

/*if(!isset($_SERVER["HTTPS"])) {
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}*/

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// Uncomment to see the contents of variables
/* var_dump(BASE_URL);
  var_dump(IMAGES_URL);
  var_dump(CSS_URL);
  var_dump($path);
  exit(); */

$cookieCounter = filter_input(INPUT_COOKIE, "counter", FILTER_VALIDATE_INT);
$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$action = filter_input(INPUT_POST, "do", FILTER_SANITIZE_SPECIAL_CHARS);

if ($cookieCounter === NULL) {
    setcookie('counter', 1, time() + 3600);
    $message = "To je tvoj prvi obisk.";
} else if ($cookieCounter === FALSE) {
    $message = "Piškotek ima neveljaven format.";
} else {
    $counter = $cookieCounter + 1;
    $message = "To je že tvoj $counter. obisk.";
    setcookie('counter', $counter, time() + 3600);
}

if ($action == "delete") {
    setcookie('counter', NULL, -1);
    $message = "Piškotek je bil izbrisan. <a href='$url'>Nadaljuj ...</a>";
}

//regex urls za REST

$urls = [
    "/^registracija$/" => function () {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            RegistracijaController::register();  // Popravljeno!
        } else {
            RegistracijaController::registrationForm();  // Popravljeno!
        }
    },        
    "/^prijava$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            PrijavaController::login();
        } else {
            PrijavaController::loginForm();
        }
    },
    "/^karte$/" => function () {
        KarteController::index();
    },
    "/^karte\/edit$/" => function () {
        KarteController::editList();
    },
    "/^karta\/add$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            KarteController::add();
        } else {
            KarteController::showAddForm();
        }
    },
    "/^karta\/edit$/" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            KarteController::edit();
        } else {
            KarteController::showEditForm();
        }
    },
    "/^karta\/delete$/" => function () {
        KarteController::delete();
    },
    "/^karta\/deactivate$/" => function () {
        KarteController::deactivate();
    },
    "/^karta\/activate$/" => function () {
        KarteController::activate();
    },           
    "/^store$/" => function () {
        StoreController::index();
    },
    "/^store\/add-to-cart$/" => function () {
        StoreController::addToCart();
    },
    "/^store\/update-cart$/" => function () {
        StoreController::updateCart();
    },
    "/^store\/purge-cart$/" => function () {
        StoreController::purgeCart();
    },
    "/^store\/order$/" => function () {
        OrderController::index();
    },
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "store");
    },
    "/^logout$/" => function () {
        LogoutController::index();
    },
    "/^profile$/" => function () {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            ProfileController::edit();
        } else {
            ProfileController::show();
        }
    },
    "/^profile\/edit$/" => function () {
        ProfileEditController::editProfile();
    },
    "/^profile\/change-password$/" => function () {
        ProfileEditController::changePassword();
    },
    "/^buyers$/" => function () {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            ProfileController::editBuyer();
        } else {
            ProfileController::showBuyers();
        }
    },
    "/^buyer\/add$/" => function () {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            ProfileController::addBuyer();
        } else {
            ProfileController::showBuyerAdd();
        }
    },
    "/^sellers$/" => function () {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            ProfileController::editSeller();
        } else {
            ProfileController::showSellers();
        }
    },
    "/^seller\/add$/" => function () {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            ProfileController::addSeller();
        } else {
            ProfileController::showSellerAdd();
        }
    },
    
    "/^orders$/" => function () {
        OrderController::allOrders();
    },
    "/^store\/order\/submit$/" => function () {
        OrderController::submitOrder();
    },
    "/^order\/details\/(\d+)$/" => function ($method, $order_id) {
        OrderController::orderDetails($order_id);
    },
    "/^order\/update-status$/" => function () {
        OrderController::updateStatus();
    },
    #REST - dodani parametri za metode
    "/^api\/store\/(\d+)$/" => function ($method = null, $id = null) {
        // Za REST route vzamemo parametre iz preg_match
        $method = $_SERVER["REQUEST_METHOD"];
        
        // Preveri če je $id nastavljen, sicer vzemi iz URL
        if ($id === null) {
            preg_match("/^api\/store\/(\d+)$/", $GLOBALS['path'], $matches);
            $id = isset($matches[1]) ? $matches[1] : null;
        }
        
        switch ($method) {
            case "PUT":
                KarteRESTController::edit($id);
                break;
            case "DELETE":
                KarteRESTController::delete($id);
                break;
            default:  // GET
                KarteRESTController::get($id);
                break;
        }
    },
    "/^api\/store$/" => function ($method = null) {
        $method = $_SERVER["REQUEST_METHOD"];
        switch ($method) {
            case "POST":
                KarteRESTController::add();
                break;
            default:    // GET
                KarteRESTController::index();
                break;
        }
    },
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            // Odstranimo celotni match (prvi element) ker nam ni potreben
            array_shift($params);
            
            // Dodamo REQUEST_METHOD kot prvi parameter če ga potrebujemo
            array_unshift($params, $_SERVER["REQUEST_METHOD"]);
            
            // Pokličemo controller s parametri
            call_user_func_array($controller, $params);
            
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
            echo "An error occurred: <pre>$e</pre>";
        }

        exit();
    }
}

// ODSTRANI ALI KOMENTIRAJ VSO TO KODO:
/*
// Funkcija za preverjanje in preklapljanje protokola
function preveriProtokol() {
    // Seznam poti, ki zahtevajo HTTPS
    $zavarovane_poti = [
        '/registracija', '/login', '/profile', 
        '/checkout', '/nakup', '/admin', 
        '/uporabnik', '/upravljanje', '/payment'
    ];
    
    $trenutna_pot = $_SERVER['REQUEST_URI'];
    
    // Preveri ali trenutna pot zahteva HTTPS
    $zahteva_https = false;
    foreach ($zavarovane_poti as $pot) {
        if (strpos($trenutna_pot, $pot) === 0) {
            $zahteva_https = true;
            break;
        }
    }
    
    // Preveri ali smo na pravilnem protokolu
    $je_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    
    // Če smo na napačnem protokolu, preusmeri
    if ($zahteva_https && !$je_https) {
        // HTTPS zahteva, vendar smo na HTTP
        $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $url, true, 301);
        exit();
    } elseif (!$zahteva_https && $je_https) {
        // HTTP zahteva, vendar smo na HTTPS
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $url, true, 301);
        exit();
    }
    
    // Če se uporabnik prijavi, preklopi na HTTPS
    if (isset($_SESSION['user_id']) && !$je_https) {
        $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $url, true, 301);
        exit();
    }
}

// Pokliči funkcijo na začetku
session_start();  // ODSTRANI TA DRUGI session_start()!
preveriProtokol();

// Funkcija za preverjanje certifikata
function preveriCertifikat() {
    if (isset($_SERVER['SSL_CLIENT_VERIFY']) && $_SERVER['SSL_CLIENT_VERIFY'] == 'SUCCESS') {
        // Certifikat je veljaven
        $cert_data = openssl_x509_parse($_SERVER['SSL_CLIENT_CERT']);
        
        // Shrani podatke o certifikatu v sejo - POPRAVLJENA RAZLIČICA
        $_SESSION['certificate'] = [
            'common_name' => isset($cert_data['subject']['CN']) ? $cert_data['subject']['CN'] : '',
            'email' => isset($cert_data['subject']['emailAddress']) ? $cert_data['subject']['emailAddress'] : '',
            'valid_from' => isset($cert_data['validFrom_time_t']) ? $cert_data['validFrom_time_t'] : '',
            'valid_to' => isset($cert_data['validTo_time_t']) ? $cert_data['validTo_time_t'] : ''
        ];
        
        return true;
    }
    return false;
}

// Za admin strani zahtevaj certifikat
if (strpos($_SERVER['REQUEST_URI'], '/admin') === 0) {
    if (!preveriCertifikat()) {
        header('HTTP/1.0 403 Forbidden');
        echo 'Dostop zavrnjen: Veljaven digitalni certifikat je obvezen.';
        exit();
    }
}
*/

// Dodaj samo to vrstico, da stran deluje:
StoreController::index();
?>