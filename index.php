
    <?php
    mb_internal_encoding("UTF-8");
    session_start();

    // Načtení kontrolerů nebo modelů
    function autoLoad(string $class)
    {
        if (preg_match('/Controler$/', $class))
            require("Controlers/" . $class . ".php");
        else
            require("Models/" . $class . ".php");
    }

    // Spuštění funkce autoLoad
    spl_autoload_register("autoLoad");

    // Připojení k Db
    Db::connect("127.0.0.1", "root", "", "insurance_company");

    $router = new RouterControler();
    $router->work(array($_SERVER['REQUEST_URI']));
    $router-> writeView();


    ?>
