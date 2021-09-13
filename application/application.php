<?php
    Class Application {
        //변수
        var $param;
        //생성자
        function __construct(){
            $this->getParam();
            new $this->param->page_type($this->param);
        }
        //get param
        function getParam(){
            if(isset($_GET['param'])){
                $get = explode("/",$_GET['param']);
            }
            $param = [];
            $param['page_type'] = isset($get[0]) && $get[0] != '' ? $get[0] : 'main';
            $param['action'] = isset($get[1]) && $get[1] != '' ? $get[1] : NULL;
            $param['idx'] = isset($get[2]) && $get[2] != '' ? $get[2] : NULL;
            $param['page_num'] = isset($get[2]) && $get[2] != '' ? $get[2] : 1;
            $param['include_file'] = isset($param['action']) ? $param['action'] : $param['page_type'];
            $param['get_page'] = _URL."{$param['page_type']}";
            $this->param = (object)$param;
        }
    }




// $this->getParam() : 주소에 할당되는 문자열 ($_GET['param']) 을 쪼개어 객체로 할당

// 메인페이지 :  / 
// $this->param->page_type : main
// $this->param->action : NULL
// $this->param->idx : NULL
// $this->param->page_num : 1
// $this->param->include_file : main
// $this->param->get_page : /main
// 게시판 : /board
// $this->param->page_type : board
// $this->param->action : NULL
// $this->param->idx : NULL
// $this->param->page_num : 1
// $this->param->include_file : board
// $this->param->get_page : /board
// 1번 게시글 보기 : /board/view/1
// $this->param->page_type : board
// $this->param->action : view
// $this->param->idx : 1
// $this->param->page_num : 1
// $this->param->include_file : view
// $this->param->get_page : /board


// new $this->param->page_type($this->param)  : page_type에 할당된 문자열과 일치하는 객체를 생성하고, 생성자에 주소정보를 넘겨준다.

// 메인페이지 : [/ ] 
// $this->param->page_type : main
// 생성 객체 : new Main();
// 게시판 : [ /board ] 
// $this->param->page_type : board
// 생성 객체 : new Board();
// 생성자에 주소정보($this->param)을 넘겨줌