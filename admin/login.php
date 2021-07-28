<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin</title>
</head>
<body style="background: beige;">
    <div class="container pt-5">
        <div class="box text-center py-5 px-3 mx-auto">
            <form class="px-5" id="login_form">
                <h1 class="pb-5 text-center">Admin Login</h1>
                <div class="row mb-3">
                    <label for="user_name" class="col-sm-3 col-form-label">User Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="user_name" required placeholder="Enter Your User Name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" required placeholder="Enter Your Password">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        document.getElementById('login_form').addEventListener('submit', function(e){
            e.preventDefault();
            var user_name = document.getElementById("user_name").value;
            var password = document.getElementById("password").value;
            console.log(user_name, password);
            $.ajax({
                type: "POST",
                url: "../db/start_sessioning.php",
                data: {user_name_admin:user_name, password_admin:password},
                success: function (data) {
                    var resp = $.parseJSON(data);
                    console.log(resp);
                    if(resp.error){
                        alert(resp.message);
                    }else{
                        location.href = "admin.php";
                    }
                }
            });
        });
    </script>

</body>
</html>