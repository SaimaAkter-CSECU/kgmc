<?php
    $response = array();
    if($_SERVER['REQUEST_METHOD']!='POST'){
      $response['error'] = true;
      $response['message'] = "Invalid Request method";
      echo json_encode($response);
      exit();
    }

    if(!isset($_POST['user_name_admin']) || !isset($_POST['password_admin'])){
      $response['error'] = true;
      $response['message'] = "Error! Required fields are missing!";
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

    $user_name_admin = strip_tags($_POST['user_name_admin']);
    $password_admin = strip_tags($_POST['password_admin']);

    $user_result = check_user($dbcon, $user_name_admin, $password_admin);

    if($user_result->num_rows <= 0)
    {
      $response['error'] = true;
      $response['message'] = 'Invalid user.';
    }
    else {
      session_start();
      $user = $user_result->fetch_array(MYSQLI_ASSOC);
      $_SESSION['id'] = $user['id'];
      $_SESSION['user'] = $user['user_name_admin'];

      $response['error'] = false;
      $response['message'] = "Login is Successful";
      $response['data'] = $_SESSION['id'] ;
    }

    echo json_encode($response);
    $dbcon->close();

    function check_user($dbcon, $user_name_admin, $password_admin){
      $sql = "SELECT * FROM `nu_admin` WHERE `user_name_admin`=? AND `password_admin`=?"; 
      $stmt = $dbcon->prepare($sql);
      $stmt->bind_param("ss", $user_name_admin, $password_admin);
      $stmt->execute();
      $results = $stmt->get_result();
      $stmt->close();

      return $results;

    }
?>
