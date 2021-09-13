<?php
    define('_ROOT', dirname(__FILE__)."/");
    define('_APP', _ROOT."application/");
    define('_PUBLIC', _ROOT."public/");
    define('_MODEL', _APP."model/");
    define('_CONFIG', _APP."config/");
    define('_CONTROLLER', _APP."controller/");
    define('_VIEW', _APP."view/");
    $url = str_replace("index.php", "", "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}");
    define('_URL', $url);
    define('_IMG', _URL.'public/img/');
    define('_CSS', _URL.'public/common/css/');
    define('_JS', _URL.'public/common/js/');
    require_once(_CONFIG."lib.php");


    new Application();
    // 정의된 Application 객체가 없는 상태에서 객체를 생성.
    // 이 때 __autoload() 라는 함수를 실행하게 되는 데, 이것에 대한 처리는 lib.php에서 함.
    // >> /application/application.php를 require_once 함.