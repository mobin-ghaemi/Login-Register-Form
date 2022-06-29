<?php
function check_tel($tel)
{
    if (strlen($tel) < 11 || strlen($tel) > 11 && $tel[0] == 0) 
    {
        $json=array('status'=>FALSE , 'data'=>"شماره تلفن حتما باید 11 رقم باشد و با صفر شروع شود");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_pass($password)
{
    if (strlen($password) < 8) 
    {
        $json=array('status'=>FALSE , 'data'=>"رمز عبور باید حداقل شامل 8 کاراکتر باشد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_fname($fname)
{
    if (strlen($fname) <=3) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام نمیتواند کمتر از 3 حروف باشد");
        $out=json_encode($json, JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strstr($fname,"$") || strstr($fname,"_" ) || strstr($fname,"@") || strstr($fname , "*")  ||  strstr($fname , "%") || strstr($fname , "!")) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام را صحیح وارد کنید");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_lname($lname)
{
    if (strlen($lname) <=3) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام خانوادگی نمیتواند کمتر از 3 حروف باشد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
    if (strstr($lname , "$") || strstr($lname , "_" ) || strstr($lname , "@") || strstr($lname , "*")  ||  strstr($lname , "%") || strstr($lname , "!")) 
    {
        $json=array('status'=>FALSE , 'data'=>"نام خانوادگی را صحیح وارد کنید");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function check_email($email)
{
    if (strstr($email , "$") || strstr($email , "_" )  || strstr($email , "*")  ||  strstr($email , "%") || strstr($email , "!")) 
    {
        $json=array('status'=>FALSE , 'data'=>"ایمیل را صحیح وارد کنید");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
        exit;
    }
}
function insert($password , $fname , $lname , $email , $connection , $tel)
{
    $pass=password_hash($password , PASSWORD_DEFAULT );
                
    $sql = "INSERT INTO register (`fname` , `lname` , `email` , `tel` , `password`) VALUES ('$fname' , '$lname' , '$email' , '$tel' , '$pass')";

    if (mysqli_query($connection, $sql)) 
    {
        $json=array('status'=>TRUE , 'data'=>"اطلاعات کاربری شما با موفقیت ثبت شد");
        $out=json_encode($json , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $out;
    } 
}
function check_email_tel($result , $email , $tel)
{
    foreach ($result as $o) 
    {
        $email1=$o['email'];
        $tel1=$o['tel'];

        if($email1 == $email) 
        {
            $messagg=array('status'=>FALSE , 'data'=>"ایمیل شما تکراری است");
            $ppaya=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $ppaya;
            return;
        }
        if($tel1 == $tel) 
        {
            $messagg=array('status'=>FALSE , 'data'=>"شماره تلفن شما تکراری است");
            $paya=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $paya;
            return;
        }
    }
}
    //_______________________________________________________________________LOGIN_______________________________________________________________________
function passverify($connection , $password , $sql)
{
    $result=mysqli_query($connection,$sql);

    if (mysqli_num_rows($result) > 0) 
    {
        $data=mysqli_fetch_assoc($result);

        if (password_verify($password , $data['password'])) 
        {
            $messagg=array('status'=>TRUE , 'data'=>"شما وارد شدید");
            $payaa=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $payaa;
        }
        else 
        {
            $messagg=array('status'=>FALSE , 'data'=>"رمز عبور نادرست است");
            $payaa=json_encode($messagg , JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            echo $payaa;
        }
    }
    else 
    {
        $messagg=array('status'=>FALSE , 'data'=>"کاربر با این مشخصات وجود ندارد");
        $payaa=json_encode($messagg, JSON_PRESERVE_ZERO_FRACTION|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        echo $payaa;
    } 
}
    // _______________________________________________________________________Forgetpass_______________________________________________________________________

    // function


?>