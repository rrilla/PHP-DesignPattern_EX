<?php
    Class Controller {
        //변수
        var $param;
        var $db;
        var $title;
        var $setAjax;
        //생성자
        function __construct($param){
            header("Content-type:text/html;charset=utf8");
            $this->param = $param;
            $modelName = "Model_{$this->param->page_type}";
            $this->db = new $modelName($this->param);
            $this->setAjax = false;
            $this->index();
        }
        //index
        function index(){
            $method = isset($this->param->action) ? $this->param->action : 'basic';
            if(method_exists($this,$method)) $this->$method();
            $this->getTitle();
            $this->header();
            $this->content();
            $this->footer();
        }
        //header
        function header(){
            $this->setAjax || require_once(_VIEW."header.php");
        }
        //footer
        function footer(){
            $this->setAjax || require_once(_VIEW."footer.php");
        }
        //content
        function content(){
            $this_arr = (array)$this;
            extract($this_arr);
            $dir = _VIEW."{$this->param->page_type}/{$this->param->include_file}.php";
            if(file_exists($dir)) require_once($dir);
        }
        //getTitle
        function getTitle(){
            $this->title = 'MVC Model';
        }
    }


    // __construct() : 생성자
    // 문자셋 지정 (utf-8)
    // 주소 정보 객체 반환
    // Model 객체 생성
    // ajax를 일단 false로 초기화
    // $this->index(); 메소드 실행
    // Model 객체 뒤에는 page_type이 붙는다.
    // 메인페이지 [ http://127.0.0.1 ] 에서
    // $this->param->page_type 에는 main 이 할당되어 있으므로
    // Model_main 객체가 만들어진다.
    // header() : 페이지 상단 호출
    // footer() : 페이지 하단 호출
    // content() : 컨텐츠 호출
    // getTitle() : 타이틀 지정.
    // Controller 객체를 상속하는 경우, 개별 getTitle()을 만들어 title을 따로 지정할 수 있음.
    // $this->$method() : $this->param->action에 값이 있을 경우 action값으로, 아니면 $this->basic()이 실행된다.
    // 따라서 각 Controller 마다 $method에 해당하는 method를 실행하여 데이터를 렌더링 하거나 기초 세팅을 한다.
     
    
    // 메인페이지 [ / ]
    // $this->param->page_type : main
    // $this->param->action : NULL
    // action에 NULL이 할당되어 있으므로 new Main() 객체의 basic() 메소드가 실행된다.
    // 게시판 [ /board ]
    // $this->param->page_type : board
    // $this->param->action : NULL
    // action에 NULL이 할당되어 있으므로 new Board() 객체의 basic() 메소드가 실행된다.
    // 1번 게시글 보기 [ /board/view/1 ]
    // $this->param->page_type : board
    // $this->param->action : view
    // new Board() 객체의 view() 메소드가 실행된다.
    // 게시글 작성 [ /board/write ]
    // $this->param->page_type : board
    // $this->param->action : write
    // new Board() 객체의 write() 메소드가 실행된다.
    // 1번 게시글 수정 [ /board/write/1 ]
    // $this->param->page_type : board
    // $this->param->action : write
    // new Board() 객체의 write() 메소드가 실행된다.
    // 1번 게시글 삭제 [ /board/delete/1 ]
    // $this->param->page_type : board
    // $this->param->action : delete
    // new Board() 객체의 delete() 메소드가 실행된다.
    // index() : View로 렌더링
    // __construct(); 에서 메인페이지의 경우 Model_main  객체를 생성한다.
    // 즉, /application/model/model_main.php 파일이 호출된다.

