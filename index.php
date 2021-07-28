<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Registration</title>
</head>
<body style="background: beige;">
    <div class="container pt-5">
        <div id="welcome-div">
            <div class="box text-center py-5 px-3 mx-auto">
                <h1>Welcome to Hon's Admission Panel</h1>
                <h2>Powered by: KGMC</h2>
                <button class="btn btn-success mt-5" onclick="nextPage();">Click Here to Register</button>
            </div>
        </div>

        <div id="registration-div" style="display: none;">
            <div class="box text-center py-5 px-3 mx-auto">
                <form class="px-5" id="registration_form">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Student Name</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" required placeholder="Enter Your Name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ad_roll" class="col-sm-3 col-form-label">Admission Roll</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="ad_roll" required placeholder="Enter Admission Roll">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Student Mobile No</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="phone" required placeholder="Enter Your Mobile No">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="trx_id" class="col-sm-3 col-form-label">TrxId no (Rocket)</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="trx_id" required placeholder="Enter Your Transaction ID">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Confirm &amp; Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        function nextPage(){
            document.getElementById("welcome-div").style.display = "none";
            document.getElementById("registration-div").style.display = "block"; 
        }

        document.getElementById('registration_form').addEventListener('submit', function(e){
            e.preventDefault();
            var name = document.getElementById("name").value;
            var ad_roll = document.getElementById("ad_roll").value;
            var phone = document.getElementById("phone").value;
            var trx_id = document.getElementById("trx_id").value;

            console.log("Register "+ name+ " "+ ad_roll + " "+ phone + " "+ trx_id); 

            $.ajax({
                type: "POST",
                url: "db/add_registration.php",
                data: {name: name, ad_roll:ad_roll, phone: phone, trx_id: trx_id}, 
                success: function (resp) {
                    console.log(resp);
                    var resp = $.parseJSON(resp);
                    //   console.log(resp);
                    if(resp.error){
                        alert("Your Registration is not Completed. Please try again.");
                    }
                    else{
                        swal({
                            title: "Congratulations!",
                            text: "Your Registration is Successful!",
                            icon: "success",
                            button: "Ok!"
                        }
                        )
                        .then(() => {
                            location.reload();
                        });
                        
                    }
                }
            });
        });
    </script>

</body>
</html>