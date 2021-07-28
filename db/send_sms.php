<?php
    $response = array();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        $response['error'] = true;
        $response['message'] = "Invalid Request method";
        echo json_encode($response);
		exit();
    }
    if( !isset($_POST['user_name']) || !isset($_POST['phone']) || !isset($_POST['admission_roll'])  ){
        $response['error'] = true;
        $response['message'] = "Required field missing!";
        echo json_encode($response);
		exit();
    }

    $base_path = dirname(__FILE__);
    require_once($base_path."/Database.php");

    $user_name = strip_tags($_POST['user_name']);
    $phone = strip_tags($_POST['phone']);
    $admission_roll = strip_tags($_POST['admission_roll']);

    $msg = "Dear Student ".$user_name." Admission Rolll ".$admission_roll. " Your Admission Form Receive Successfully. KGMC";

    $db = new Database();
    $dbcon = $db->db_connect();
  
    if(!$db->is_connected()){
      $response['error'] = true;
      $response['message'] = "Database is not connected!";
      echo json_encode($response);
      exit();
    }

    $username = "mehedi.khl";
    $hash = "78a085bf84b6e9e31663671af380b01f"; //generate token from the control panel
    $numbers = "$phone"; //Recipient Phone Number multiple number must be separated by comma
    $message = "$msg";

    $params = array('u'=>$username, 'h'=>$hash, 'op'=>'pv', 'to'=>$numbers, 'msg'=>$message);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://alphasms.biz/index.php?app=ws");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    curl_close ($ch);

    echo json_encode($response);
    $dbcon->close();

?>