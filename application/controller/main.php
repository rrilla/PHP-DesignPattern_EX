<?php
    Class Main extends Controller {
        function basic(){
        }
    }


// Controller를 Extends 할 때 Controller를 호출한다. 즉, __autoload() 가 실행된다.
// 따라서 /application/controller/controller.php 가 require_once되고, Controller 객체가 생성된다.