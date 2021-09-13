<?php
    Class Model {
        //변수
        var $db;
        var $column;
        var $table;
        var $param;
        var $action;
        var $sql;
        //생성자
        function __construct($param){
            $this->column = NULL;
            $this->param = $param;
            $this->db = new PDO("mysql:host=localhost;dbname=test;charset=utf8","root","");
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            if(isset($_POST['action'])){
                $this->action = $_POST['action'];
                $this->action();
            }
        }
        //query
        function query($sql = false){
            $sql && $this->sql = $sql;
            $res = $this->db->prepare($this->sql);
            if($res->execute($this->column)){
                return $res;
            } else {
                echo "<pre>";
                echo $this->sql;
                print_r($this->column);
                print_r($this->db->errorInfo());
                echo "</pre>";
            }
        }
        //fetch
        function fetch($sql = false){
            $sql && $this->sql = $sql;
            return $this->query($this->sql)->fetch();
        }
        //fetchAll
        function fetchAll($sql = false){
            $sql && $this->sql = $sql;
            return $this->query($this->sql)->fetchAll();
        }
        //cnt
        function cnt($sql = false){
            $sql && $this->sql = $sql;
            return $this->query($this->sql)->rowCount();
        }
        //column
        function getColumn($arr,$cancel){
            $column = '';
            $cancel = explode("/",$cancel);
            foreach ($arr as $key => $value) {
                if(!in_array($key,$cancel)){
                    $column .= ", {$key} = :{$key}\n";
                    $this->column[$key] = $value;
                }
            }
            return $column = substr($column,2);
        }
        //queryResult
        function combine($column){
            switch($this->action){
                case 'insert' : $sql = " INSERT INTO {$this->table} set \n"; break;
                case 'update' : $sql = " UPDATE {$this->table} set \n"; break;
                case 'delete' : $sql = " DELETE FROM {$this->table} \n"; break;
            }
            return $sql .= $column;
        }
    }


// __construct() : 생성자
// DB에 연결한다.
// column, param 등의 객체 변수를 초기화한다.
// $_POST['action']이 존재할 경우 $this->action() 메소드를 실행한다.
// $this->action은 상속될 Model 객체가 가지고 있다.
// $this->action 에서 insert / delete / update 등의 작업을 처리한다.

// query() : 쿼리문을 실행한다.
// 객체 변수 column에 값이 있을 경우, 렌더링 한다.
// 객체 변수 column에 값이 없을 경우, 그냥 실행한다.

// 오류 발생 시 오류를 출력한다.
// fetch() : SELECT 된 하나의 데이터를 반fetchAll() : SELECT 된 모든 데이터를 반환
// cnt() : SELECT 된 행의 갯수를 반환
// getColumn() : 배열을 query문에 사용될 column 문자열로 반환
// combine() : 쿼리문과 column을 결합