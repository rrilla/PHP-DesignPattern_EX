<?php
    //alert
    function alert($str){
        echo "<script>alert('{$str}');</script>";
    }
    //move
    function move($str = false){
        echo "<script>";
            echo $str ? "document.location.replace('{$str}');" : "history.back();";
        echo "</script>";
        exit;
    }
    //access
    function access($bool,$msg,$url = false){
        if(!$bool){
            alert($msg);
            move($url);
        }
    }
    //autoload
    function __autoload($className){
        $className = strtolower($className);
        $className2 = preg_replace('/(model|application)(.*)/',"$1",$className);
        switch($className2){
            case 'application' : $dir = _APP; break;
            case 'model' : $dir = _MODEL; break;
            default : $dir = _CONTROLLER; break;
        }
        
        // if(file_exists($dir)) require_once("{$dir}{$className}.php");
        if(file_exists("{$dir}{$className}.php")){
            require_once("{$dir}{$className}.php");
        }else{
            echo "404";
            return;
        }
            
        // false시 404
    }



// alert() : 경고창을 띄웁니다.
// move() : 페이지 이동을 합니다.
// access() : 조건에 대하여 경고창/페이지이동 등의 명령을 실행합니다.
// __autoload() : 정의 되지 않은 객체를 만들었을 때 실행하는 함수입니다.
// 객체 이름에 model과 application이 포함되어 있으면 해당 폴더로, 나머지는 무조건 controller 폴더에 있는 객체명과 일치하는 php 파일을 불러옵니다.
// new Application(); ==> /application/application.php를 require_once
// new Model(); ==> /application/model/model.php를 require_once
// new Model_main(); ==> /application/model/model_main.php를 require_once
// new Model_board; ==> /application/model/model_board.php를 require_once
// new Model_member; ==> /application/model/model_member.php를 require_once
// new Controller(); ==> /application/controller/controller.php를 require_once
// new Main(); ==> /application/controller/main.php를 require_once
// new Board(); ==> /application/controller/board.php를 require_once
// new Member(); ==> /application/controller/member.php를 require_once
// index.php에서 new Application(); 에 대한 결과로 /application/application.php를 require_once 합니다.