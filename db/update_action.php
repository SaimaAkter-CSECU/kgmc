<?php
    $response = array();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        $response['error'] = true;
        $response['message'] = "Invalid Request method";
        echo json_encode($response);
		exit();
    }
    if( !isset($_POST['id'])  ){
        $response['error'] = true;
        $response['message'] = "Required field missing!";
        echo json_encode($response);
		exit();
    }

    $base_path = dirname(__FILE__);
    require_once($base_path."/Database.php");

    $id = (int) ($_POST['id']);

    $db = new Database();
    $dbcon = $db->db_connect();
  
    if(!$db->is_connected()){
      $response['error'] = true;
      $response['message'] = "Database is not connected!";
      echo json_encode($response);
      exit();
    }

    $result = updateStudentInfo($dbcon, $id); 
    if($result>0){
        
        $response['error'] = false;
        $response['message'] = "Action Updation is Successful";
        $response['data'] = $result;
    }
    else{
        $response['error'] = true;
        $response['message'] = "Sorry. Modification in Action Failed";
        // $response['data'] = $result;
    }

        
    echo json_encode($response);

    $dbcon->close();

    function updateStudentInfo($dbcon, $id){
        $sql = "UPDATE st_info SET action = 1 WHERE id=?"; 

        $stmt = $dbcon->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $results = $stmt->affected_rows;
        $stmt->close();

        return $results;

    }
?>
