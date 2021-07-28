<?php
//   $session_path = dirname(dirname(__FILE__));
//   $session_path .= '/admin/usersessioncheck.php';
//   include_once $session_path;
?>
<?php

    $response = array();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        $response['error'] = true;
        $response['message'] = "Invalid Request method";
        echo json_encode($response);
    exit();
    }

    $base_path = dirname(__FILE__);

    require_once($base_path."/Database.php");

    $db = new Database();
    $dbcon = $db->db_connect();

    if(!$db->is_connected()){
        $response['error'] = true;
        $response['message'] = "Database is not connected!";
        echo json_encode($response);
        exit();
    }

    $result = getAllStudentInfo($dbcon); 

    $studentdetails = array();
    if($result->num_rows>0){
        while($row=$result->fetch_array(MYSQLI_ASSOC)){

            $id = (int)$row['id'];
            $trx_id = (int)$row['rocket_trx_id'];
            $trx_Result = getPaymentStatus($dbcon, $trx_id);

            $status = 'Unpaid'; 
            if($trx_Result->num_rows == 1){
                $status = 'Paid';
            }
            else{
                $status = 'UnPaid';
            }

            $row['payment_status'] = $status;

            $studentdetails[] = $row;
        }
        $response['error'] = false;
        $response['data'] = $studentdetails;
    }
    else{
        $response['error'] = true;
        $response['message'] = "Student details not Found.";
    }

    echo json_encode($response);
    $dbcon->close();

    function getAllStudentInfo($dbcon){
        $sql = "SELECT * FROM st_info"; 
        $stmt = $dbcon->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        $stmt->close();

        return $results;
    }

    function getPaymentStatus($dbcon, $trx_id){
        $sql = "SELECT * FROM trx_match WHERE trx_no = ?"; 
        $stmt = $dbcon->prepare($sql);
        $stmt->bind_param("i", $trx_id);
        $stmt->execute();
        $results = $stmt->get_result();
        $stmt->close();

        return $results;
    }

?>
