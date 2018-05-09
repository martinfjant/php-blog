<?php
    session_start();

    use Blogg\Core\Router;
    use Blogg\Core\Request;

    /* Går igenom alla filer och kör en @require på alla filer som slutar på .php,
    och eftersom alla är döpta efter hur de ligger i namespace funkar det, typ*/
    function autoloader($classname)
    {
        $lastSlash = strpos($classname, '\\') + 1;
        $classname = substr($classname, $lastSlash);
        $directory = str_replace('\\', '/', $classname);
        $filename = __DIR__ . '/src/' . $directory . '.php';
        require_once($filename);
    }

    spl_autoload_register('autoloader');

    /* Instansierar router*/
    $router = new Router();

    /* Hämtar data ur databasen genom att Request kontaktar controllern */
    $response = $router->route(new Request());

    /* Laddar in templatesen och ekoar ut en databasreqiest som körs genom en view,
    beroende på vilken request som skickats genom URL:en m.h.a. $response, som är vad
    vi får tillbaka av controllern */
    if (!isset($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = false;
    }

    include_once("templates/header.html");
        echo $response;
    include_once("templates/navigation.phtml");
    include_once("templates/footer.html");
