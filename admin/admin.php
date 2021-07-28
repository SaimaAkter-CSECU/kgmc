<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['id']))
    {
        session_destroy();
        header("Location: login.php");  
        exit();   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Admin DashBoard</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand m-auto">Admin DashBoard</a>
            <button class="btn btn-outline-success text-light" id="user_logout_button">Logout</button>
        </div>
    </nav>

    <section class="my-5">
        <div class="container">
            <div id="sucess-div" class="position-relative">
                <div id="success-toast" class="toast align-items-center text-white bg-success border-0 position-absolute top-0 right-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Amount Received.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <h1 class="py-5 text-center section_header">Student Information</h1>
            <table id="student_table" class="table table-striped table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Student Name</th>
                        <th>Mobile No</th>
                        <th>Admission Roll</th>
                        <th>Transaction ID No</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="student_table_body">                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>SL No</th>
                        <th>Student Name</th>
                        <th>Mobile No</th>
                        <th>Admission Roll</th>
                        <th>Transaction ID No</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    

    <script type="text/javascript">
        $(document).ready(function() {
            $('#student_table').DataTable();
        } );

        var table_body = document.getElementById("student_table_body");
        table_body.innerHTML = ``; 

        $.ajax({
            url: "../db/get_all_student_data.php",
            type: 'POST',
            async: false,
            success: function(resp){
                resp = $.parseJSON(resp);
                var data = resp.data;
                if(!resp.error){
                    console.log(data);
                    for(i in data){
                        table_body.innerHTML += `<tr id="student_${data[i].id}">
                                                    <td>${data[i].id}</td>
                                                    <td id="name_${data[i].id}">${data[i].student_name}</td>
                                                    <td id="phone_${data[i].id}">${data[i].student_phn}</td>
                                                    <td id="roll_${data[i].id}">${data[i].nu_roll}</td>
                                                    <td>${data[i].rocket_trx_id}</td>
                                                    <td>${data[i].payment_status}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-dark" id="receiveBtn_${data[i].id}" onclick="getSMS(${data[i].id})" >Receive Amount</button>
                                                    </td>
                                                </tr>`;
                        if(`${data[i].action}` == '1'){
                            document.getElementById(`receiveBtn_${data[i].id}`).disabled = true;
                        }
                    }
                }
            }
        });

        document.getElementById('user_logout_button').addEventListener('click',function(){
            if(confirm('Are you sure to logout?'))
            {
                $.ajax({
                    url: '../db/logout.php',
                    type: 'POST',
                    success: function(resp){
                        location.href = "login.php"; 
                    }
                });
            }
        });

        function getSMS(id){
            console.log("ok", id); 
            var user_name = document.getElementById(`name_${id}`).innerText;
            var phone = document.getElementById(`phone_${id}`).innerText;
            var admission_roll = document.getElementById(`roll_${id}`).innerText;
            console.log("User: " + user_name + " " + admission_roll + " " + phone); 

            $.ajax({
                type: "POST",
                url: "../db/send_sms.php",
                data: {user_name:user_name, admission_roll: admission_roll, phone:phone},
                success: function (data) {
                    var resp = $.parseJSON(data);
                    console.log(resp);
                    if(resp.error){
                        alert(resp.message);
                    }else{
                        updateAction(id); 
                        document.getElementById(`receiveBtn_${id}`).disabled = true;
                        toasty();
                    }
                }
            });
        }

        function toasty(){
            var option = {
                animation: true, 
                delay: 8000
            };
            var toastHTMLElement = document.getElementById('success-toast'); 
            var toastElement = new bootstrap.Toast(toastHTMLElement, option);
            toastElement.show();
        }

        function updateAction(id){
            $.ajax({
                type: "POST",
                url: "../db/update_action.php",
                data: {id:id},
                success: function (data) {
                    var resp = $.parseJSON(data);
                    console.log(resp);
                    if(resp.error){
                        console.log(resp.message);
                    }else{
                        console.log('Action Done'); 
                    }
                }
            });
        }

    </script>
</body>
</html>