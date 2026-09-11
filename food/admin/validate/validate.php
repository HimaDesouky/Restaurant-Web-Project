<?php
require(__DIR__ . '/../connection/connection.php');

    function validate_input($input){
        $input=trim($input);
        $input=stripslashes($input);
        $input=strip_tags($input);
        $input=htmlspecialchars($input);
        return $input;
    }
    function validatephone($phone){
        if(!isset($phone)||empty($phone)){
            return false;
        }
        $p_pattern="/^(011|010|012|015)\d{8}$/";
        return preg_match($p_pattern,$phone)==1;
    }
    function validateemail($email) {
        return filter_var($email,FILTER_VALIDATE_EMAIL);
        
    }
    // function validate_city($city) {
    //     $pattern="/^(1|2|3)$/";
    //     return preg_match($pattern,$city)==1;
    // }
    // function validate_gender($gender) {
    //     $pattern="/^(m|f)$/";
    //     return preg_match($pattern,$gender)==1;
    // }
    function validate_u_name($name){
        if(empty($name) || strlen($name)<3){
        return false;
        }else{$pattern="/^[a-zA-Z]+[\w]+$/";
        $cleaned = str_replace(' ', '', $name);
        return (strlen($name)>2) && preg_match($pattern,$cleaned);}
    }
    function vid($id){
    if(empty($id) || strlen($id)<3){
        return false;
    }
    return true;
}

// is admin 

function check_unique($col,$table,$value){
    global $connect;
    $repp=$connect->query("SELECT $col FROM $table where $col='$value'");
    $count=$repp->rowCount();
    return $count;
}
    // }
    function isFloat($input) {
        return is_numeric($input);
    }
?>