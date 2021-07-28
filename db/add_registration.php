<?php
    $response = array();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        $response['error'] = true;
        $response['message'] = "Invalid Request method";
        echo json_encode($response);
		exit();
    }
    if( !isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['ad_roll']) || !isset($_POST['trx_id'])  ){
        $response['error'] = true;
        $response['message'] = "Required field missing!";
        echo json_encode($response);
		exit();
    }

    $base_path = dirname(__FILE__);
    require_once($base_path."/Database.php");

    $name = strip_tags($_POST['name']);
    $phone = strip_tags($_POST['phone']);
    $ad_roll = strip_tags($_POST['ad_roll']);
    $trx_id = strip_tags($_POST['trx_id']); 

    $db = new Database();
    $dbcon = $db->db_connect();
  
    if(!$db->is_connected()){
      $response['error'] = true;
      $response['message'] = "Database is not connected!";
      echo json_encode($response);
      exit();
    }

    $result = addStudentInfo($dbcon, $name, $phone, $ad_roll, $trx_id); 
    if($result>0){
        
        $response['error'] = false;
        $response['message'] = "Registration is Successful";
        $response['data'] = $result;
    }
    else{
        $response['error'] = true;
        $response['message'] = "Sorry. Registration Failed";
        // $response['data'] = $result;
    }

        
    echo json_encode($response);

    $dbcon->close();

    function addStudentInfo($dbcon, $name, $phone, $ad_roll, $trx_id){
        $sql = "INSERT INTO st_info(student_name, student_phn, nu_roll, rocket_trx_id, action) VALUES (?,?,?,?,0)"; 

        $stmt = $dbcon->prepare($sql);
        $stmt->bind_param("sssi", $name, $phone, $ad_roll, $trx_id);
        $stmt->execute();
        $results = $stmt->affected_rows;
        $stmt->close();

        return $results;

    }
?>
