<?php 

include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['v_id'])) {

    $v_id = $_POST['v_id'] ?? "hi";
    $status = $_POST['verification'];

    $query = "UPDATE ams_visitorpass SET v_status = '$status' WHERE V_ID = '$v_id' ";

    $con->query($query);

    header("location: scanner.html");
    exit();
}else if ($_SERVER["REQUEST_METHOD"] == "GET") {


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS-Visitor_Pass</title>
    <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat&family=Overpass:wght@400;600;800&family=Roboto&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="card_container">
        <header>
            <nav>
                <a href="security-homepage.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
            </nav>
        </header>
        <div class="card1">
            <h1 class="card-head">Visitor Pass</h1>
            <div class="section1">

                    <div class="pass-status">
                        <div>
                        <label class="pass-label">Status</label> <br>
                        <p class="pass-input v_status">Pending</p>
                        </div> 
                    </div>

                <div>
                    <label class="pass-label" for="visitorName">Name</label>
                    <p class="pass-input v_name">Jency</p>
                </div>

                <div class="date">
                    <div>
                        <label class="pass-label">From</label>
                        <p class="pass-input f_date">07-01-2024</p>
                    </div>
                    <div>
                        <label class="pass-label">To</label>
                        <p class="pass-input to_date">10-01-2024</p>
                    </div>
                </div>
                <div class="locate">
                    <div>
                        <label class="pass-label" for="blockNo">Block No.</label>
                        <p class="pass-input b_no">A</p>
                    </div>
                    <div>
                        <label class="pass-label" for="flatNo">Flat No.</label>
                        <p class="pass-input f_no">A1</p>
                    </div>

                </div>
                <button class="pass-btn" onclick="showNextCard()">
                    <ion-icon class="pass-icon" name="caret-down-outline"></ion-icon>
                </button>
            </div>

            <div class="section2">
                <div>
                    <label class="pass-label">No.of Visitor</label>
                    <p class="pass-input count">3</p>
                </div>

                <div class="date">
                    <div>
                        <label class="pass-label">Gender</label>
                        <p class="pass-input gender">Male</p>
                    </div>
                    <div>
                        <label class="pass-label">Age</label>
                        <p class="pass-input age">34</p>
                    </div>
                </div>

                <div class="locate alt-locate">
                    <div>
                        <label class="pass-label">Visiting Time</label>
                        <p class="pass-input time">A</p>
                    </div>
                </div>

                <div>
                    <img class="user-img" src="" alt="visitor_Proof">
                </div>

            <div class="user-status-form">
                <form action="visitor_pass.php" method="post">
                <input class="v_id" name="v_id" hidden value="">
                <select class="pass-input status" name="verification" id="verify" required>
                <option  value="" disabled selected>Status</option>
                <option  value="Pending">PENDING</option>
                <option  value="Verified">VERIFIED</option>
                </select>
                <button class="status-btn" type="submit">Submit</button>
                </form>
            </div>
                <div>
                    <button class="pass-btn" onclick="showPrevCard()">
                    <ion-icon class="pass-icon" name="caret-up-outline"></ion-icon>
                    </button>
                </div>
            </div>

        </div>



  
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function showNextCard() {
            $('.section1').slideUp();
            $('.section2').slideDown();
        }

        function showPrevCard() {
            $('.section2').slideUp();
            $('.section1').slideDown();
        }

        function printNewPassDetails(data1,data2,data3,data4,data5,data6,data7,data8,data9,data10,data11,data12,data13) {
            console.log(data1,data2,data3,data4,data5,data6,data7,data8,data9,data11,data12);
            $('.card-head').text(data1);
            $('.b_no').text(data2);
            $('.f_no').text(data3);
            $('.f_date').text(data4);
            $('.to_date').text(data5);
            $('.v_name').text(data6);
            $('.gender').text(data7);
            $('.age').text(data8);
            $('.time').text(data9);
            $('.status').val(data12);
            $('.v_status').text(data12);
            $('.v_id').val(data13);
            $('.user-img').attr('src', 'data:image/jpeg;base64,' + data10);
            $('.count').text(data11);

            if(data1 == "Regular pass") {
                $('.card1').css('border', '5px solid #6998E8');
                $('.card1').css('box-shadow', '20px 20px 0 #6998E8');
                $('.card-head').css('background-color', '#6998E8');
                $('.v_status').css('border','2px solid #6998E8');
                $('.pass-input').css('color', '#6998E8');
                $('.pass-btn').css('background-color', '#6998E8');
                $('.pass-btn').on('mouseenter', function() {
                $(this).css('color', '#6998E8');
                $(this).css('background-color', '#fff');
                $(this).css('border', '2px solid #6998E8');
                });
                $('.pass-btn').on('mouseleave', function() {
                    $(this).css('color', '#fff');
                $(this).css('background-color', '#6998E8');
                $(this).css('border', 'none');
                });
                $('.status-btn').css('background-color', '#6998E8');
                $('.download-btn').css('background-color', '#6998E8');
            } 

        }

        $(document).ready(function () {
            $.ajax({
                type:'GET',
                url: 'vp_processor_backend.php',
                datatype: 'json',
                success: function (response) {

                    let pass_type = response.pass_type;
                    let b_no = response.block_no;
                    let f_no = response.flat_no;
                    let f_date = response.from;
                    let to_date = response.to;
                    let v_name = response.visitor_name;
                    let gender = response.gender;
                    let age = response.age;
                    let contact = response.contact;
                    let no_of_visitor = response.visitor_count;
                    let time = response.time;
                    let proof = response.proof;
                    let v_status = response.v_status;
                    let v_id = response.v_id;

                    printNewPassDetails(pass_type,b_no,f_no,f_date,to_date,v_name,gender,age,time,proof,no_of_visitor,v_status,v_id);
                    
                },
                error: function (response) {
                    console.error('Error: '+response);
                }

            })
        })
    </script>
</body>
</html>
<?php
  }
  else {
    header("Location: security.php");
exit;
}
?>