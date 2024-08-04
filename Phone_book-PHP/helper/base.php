<?php
    defined('DB_HOST') or die;
    abstract class Base
    {
        private $connect = null;

        public function __construct()
        {
            $this->connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS)
                or die(mysqli_connect_error());
            mysqli_select_db($this->connect,DB_NAME)
                or die($this->getMysqlError());
            mysqli_query($this->connect,"SET NAMES 'UTF8'");
        }

        public function __destruct()
        {
            mysqli_close($this->connect);
        }

        public function getMysqlError()
        {
            return mysqli_error($this->connect);
        }

        public function query($q)
        {
            $result = mysqli_query($this->connect,$q);
            if(stristr($q,'insert'))
                return mysqli_insert_id($this->connect);
            elseif(stristr($q,'update') || stristr($q,'delete'))
                return mysqli_affected_rows($this->connect);
            else
                return $result;
        }

        public function getRows($r)
        {
            return mysqli_fetch_assoc($r);
        }

        public function get($g)
        {
            if(isset($_GET[$g]))
                return trim($_GET[$g]);
            else
                return '';
        }

        public function post($p)
        {
            if(isset($_POST[$p]))
                return trim($_POST[$p]);
            else
                return '';
        }

        public function safer($str)
        {
            return htmlentities($str,ENT_QUOTES,"UTF-8");
        }

        public function redirect($url)
        {
            header("location:$url");
            die;
        }

        public function setSuccess($val,$message)
        {
            if($this->get('msg') == $val)
                print "<div class=\"alert alert-success text-center\">$message</div>";
        }

        public function setDanger($val,$message)
        {
            if($this->get('msg') == $val)
                print "<div class=\"alert alert-danger text-center\">$message</div>";
        }

        public function setWarning($val,$message)
        {
            if($this->get('msg') == $val)
                print "<div class=\"alert alert-warning text-center\">$message</div>";
        }

    }