<?php

include "function.php";
include "config.php";


header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
  header("Access-Control-Allow-Credentials: true");
 header("Content-Type:application/json");
header('Content-Type: text/html; charset=utf-8');




$email1 = $tel1 = [0];
foreach ($_REQUEST as $key => $value) 
{
    if ($key =="register") 
    {
        $registerdata=$value;
        $registerdata=json_decode($registerdata,TRUE);
        if (is_array($registerdata) || is_object($registerdata)) 
        {
            foreach ($registerdata as $r) 
            {
                if ($r['name'] == "fname") 
                {
                    $fname=$r['value'];
                    $fname = preg_replace("/(?<!\s);(?!\s)/", "" , $fname);
                    // $fname = preg_replace('/[0-9]+/', '', $fname);  
                    // $fname = preg_replace("/[^A-Za-z0-9_\?\-\(\)\! \ا\ب\پ\ت\ث\ج\چ\ح\خ\د\ذ\ر\ز\ژ\س\ش\ص\ض\ط\ظ\ع\غ\ف\ق\ک\گ\ل\م\ن\و\ه\ی\ك\آ\ي\ئ]/", "", $fname);
                }
                if ($r['name'] == "lname") 
                {
                    $lname=$r['value'];
                    $lname = preg_replace("/(?<!\s);(?!\s)/", "", $lname);
                    // $lname = preg_replace('/[0-9]+/', '', $lname);
                    // $lname = preg_replace("/[^A-Za-z0-9_\?\-\(\)\! \ا\ب\پ\ت\ث\ج\چ\ح\خ\د\ذ\ر\ز\ژ\س\ش\ص\ض\ط\ظ\ع\غ\ف\ق\ک\گ\ل\م\ن\و\ه\ی\ك\آ\ي\ئ]/", "", $lname);
                }
                if ($r['name'] == "email") 
                {
                    $email=$r['value'];
                    $email = preg_replace("/(?<!\s);(?!\s)/", "", $email);
                }
                if ($r['name'] == "tel") 
                {
                    $tel=$r['value'];
                    $tel = preg_replace("/(?<!\s);(?!\s)/", "", $tel);
                }
                if ($r['name'] == "password") 
                {
                    $password=$r['value'];
                    $password = preg_replace("/(?<!\s);(?!\s)/", "", $password);
                }
            }
        }

        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($tel)  && !empty($password))
        {
            check_fname($fname);
            check_lname($lname);
            check_email($email);
            check_tel($tel);
            check_pass($password);

            $query = "SELECT * FROM register WHERE `tel`='$tel' || `email`='$email'";
            $result = mysqli_query($connection, $query);
    
            if (mysqli_num_rows($result)  ===  0) 
            {
                insert($password , $fname , $lname , $email , $connection , $tel);
            }
            else
            {
                $sql1 = " SELECT  `tel`,`email` FROM register";
            
                $result=mysqli_query($connection,$sql1);
        
                if (mysqli_num_rows($result) != 0 ) 
                {
                    $result=mysqli_fetch_all($result , MYSQLI_ASSOC);
                    check_email_tel($result , $email , $tel);  
                }
            } 
        }
        else 
        {
            $json=array('status'=>FALSE , 'data'=>"فیلد ها نمیتواند خالی باشد");
            $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $out;
        }
    }
}

?>