<?php
    defined('DB_HOST') or die;
    class Frontend extends Base
    {
        public function register()
        {
            $e = $this->safer($this->post('email'));
            $p = $this->safer($this->post('pass'));
            $q = "INSERT into users values (NULL,'$e','$p','')";
            $r = $this->query($q);
            if($r)
                return 1;
            else
                return 0;
        }
        
        public function logIn()
        {
            $e = $this->safer($this->post('email'));
            $p = $this->safer($this->post('pass'));
            $query = "SELECT * FROM users WHERE email='$e' AND password='$p'";
            $q = $this->query($query);
            $row = $this->getRows($q);
            if(isset($row['id']))
            {
                $_SESSION['userId'] = $row['id'];
                return true;
            }
            else
            {
                return false;
            }
        }

        public function isLogin()
        {
            if(isset($_SESSION['userId']))
                return true;
            else
                return false;
        }

        public function getProfile()
        {
            $id = $_SESSION['userId'];
            $q = "SELECT * From users where id = '$id'";
            $r = $this->query($q);
            return $this->getRows($r);
        }

        public function saveProfile()
        {
            $id = $_SESSION['userId'];
            $pass = $this->safer($this->post('pass'));
            $error = $_FILES['userImage']['error'];
            if($error == 0)
            {
                $name = $_FILES['userImage']['name'];
                $extention = pathinfo($name,PATHINFO_EXTENSION);
                if($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png')
                {
                    $tmpPath = $_FILES['userImage']['tmp_name'];
                    $newName = date('Y-m-d-h-i-s') . rand(0,5000) . '.' . $extention;
                    $move = move_uploaded_file($tmpPath,"images/$newName");
                }
            }

            
            $existProfImage = $this->getProfile();
            if($existProfImage['image_profile'] == '')
            {
                $imagePath = "images/$newName";
                $q = "UPDATE users SET image_profile = '$imagePath' ";
                if($pass != '' && $pass != $existProfImage['password'])
                {
                    $q .= ", password = '$pass'";
                }
            }
            else
            {
                $q = "UPDATE users SET ";
                if($pass != '' && $pass != $existProfImage['password'])
                {
                    $q .= "password = '$pass'";
                }       
            }

            
            $q .= " where id = '$id'";
            $this->query($q);
        }

        public function delProfImg()
        {
            $id = $_SESSION['userId'];
            $profile = $this->getProfile();
            if(file_exists($profile['image_profile']))
            {
                unlink($profile['image_profile']);
            }
            $q = "UPDATE users SET image_profile= '' where id = '$id'";
            $this->query($q);
        }

        public function logOut()
        {
            unset($_SESSION['userId']);
            session_destroy();
        }

        public function mobileExistense($mobile)
        {
            $query = "SELECT * from phone where mobile = '$mobile'";
            $r = $this->query($query);
            $row = $this->getRows($r);
            if(isset($row['id']))
                return false;
            else
                return true;
        }

        public function addPhone()
        {
            $id = $_SESSION['userId'];
            $fn = $this->safer($this->post('fn'));
            $ln = $this->safer($this->post('ln'));
            $tel = $this->safer($this->post('tel'));
            $mobile = $this->safer($this->post('mobile'));
            if($this->mobileExistense($mobile))
            {
                $q = "INSERT into phone VALUES (NULL,'$fn','$ln','$tel','$mobile','$id')";
                return $this->query($q);
            }
            else
                return false;
        }

        public function getPhone($id)
        {
            $user_id = $_SESSION['userId'];
            $q = "SELECT * FROM phone WHERE id = '$id' AND user_id = '$user_id'";
            $r = $this->query($q);
            return $this->getRows($r);
        }

        public function getPhoneList($f,$l,$t,$m)
        {
            $id = $_SESSION['userId'];
            $q = "SELECT * FROM phone WHERE user_id = '$id'";
            if($f != '')
            {
                $q .= " AND fn LIKE '%$f%'";
            }
            if($l != '')
            {
                $q .= " AND ln LIKE '%$l%'";
            }
            if($t != '')
            {
                $q .= " AND tel LIKE '%$t%'";
            }
            if($m != '')
            {
                $q .= " AND mobile LIKE '%$m%'";
            }
            $q .= " ORDER BY fn ASC";
            return $this->query($q);
        }

        public function phoneDel($id)
        {
            $user_id = $_SESSION['userId'];
            $q = "DELETE FROM phone WHERE id = '$id' AND user_id = '$user_id'";
            $r = $this->query($q);
            return $r;
        }

        public function editPhone($id)
        {
            $id = (int)$id;
            $user_id = $_SESSION['userId'];
            $fn = $this->safer($this->post('fn'));
            $ln = $this->safer($this->post('ln'));
            $tel = $this->safer($this->post('tel'));
            $newMobile = $this->safer($this->post('mobile'));
            $q = "UPDATE phone SET fn = '$fn' , ln  = '$ln' , tel = '$tel'";
            $m = $this->getPhone($id);
            if($newMobile != $m['mobile'])
            {
                $eMob = $this->mobileExistense($newMobile);
                if($eMob)
                {
                    $q .= " , mobile = '$newMobile'";
                }
                else
                    return -1;
            }
            $q .= " WHERE id = '$id' AND user_id = '$user_id'";
            $this->query($q);
        }
    }