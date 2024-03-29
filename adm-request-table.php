<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Admin Request Table</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="request-table.css">
  <style>

#datatableid_paginate {
  margin-top: 10px;
}
.paginate_button .previous{
    border-radius: 3px;
}


#datatableid_paginate .paginate_button {
  display: inline-block;
  padding: 5px 10px;
  margin: 5px;
  margin-bottom: 50px;
  
  border-radius: 5%;
  background-color: #fff;
  color: #333;
  text-decoration: none;
  cursor: pointer;
  font-size:14px;
}

#datatableid_paginate .paginate_button.current {
  background-color: #325CC8;
  color: #fff;
}

#datatableid_paginate .paginate_button.disabled {
  pointer-events: none;
  opacity: 0.5;
}
#datatableid_length{
  background-color: #2A3650;
  padding-bottom: 15px;
  
  margin-top: 5px;
  width:25%;
  position:  absolute;
  /* border-radius: 100% 0% 0% 0%; */
  top: 180px;
  left: 350px;
}
#datatableid_filter {
  background-color: #2A3650;
  padding: 10px;
  padding-bottom: 15px;
  /* border-radius: 0% 100% 0% 0%; */
  margin-top: 5px;
  
  width:25%;
  /* margin-bottom: 20px; */
  position: absolute;
  top: 180px;
  right: 350px;
}
#datatableid_filter label,
#datatableid_length label {
  font-weight: Bold;
  color: #fff;
  font-size: 15px;
}

#datatableid_filter input[type="search"]{
  padding: 5px;
  border: 1px solid #333;
  margin-right: 50px;
  margin-left: 7px;
  margin-top: 0px;
  border-top: none;
  border-left: none;
  border-right: none;
  border-radius: 3px;
  width: 200px;
}
#datatableid_length select {
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-top: 5px;
  /* margin-left: 10px; */
  width: 70px;
}

#datatableid_info {
  margin-top: 10px;
  /* font-style: italic; */
  font-size: 15px;
}


   </style> 
</head>

<body>

  <div class="background-img-table">

    <header>
      <nav>
        <a href="admin-homepage.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>
    <div>
      <h2 class="list-head">Approval List</h2>
      <table id="datatableid" class="list-table">
        <thead>
          <tr>
            <th>Serial No</th>
            <th>Username</th>
            <th>Block No</th>
            <th>Flat No</th>
            <th>Request</th>
          </tr>
        </thead>
        <tbody id="requestBody">
            
        </tbody>
      </table>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script>



/////////This ajax fetch data from table when 1st time page loads///////////////
$(document).ready(function () {
      let displayedData = {};
      function fetchDataAndUpdate() {
        $.ajax({
          type: 'POST',
          url: 'request.php',
          dataType: 'json',
          success: function (data) {
            // data.empty();
            $.each(data.rows, function (index, booking) {
              displayedData[booking.flat_no] = true;
              console.log(data);
              if (booking.status == 'Pending' && displayedData[booking.flat_no]) {
                console.log('Adding row for pending booking:', booking);
                $('#requestBody').append('<tr class="data-row">' +
                  '<td>' + booking.id + '</td>' +
                  '<td>' + booking.username + '</td>' +
                  '<td>' + booking.block_no + '</td>' +
                  '<td>' + booking.flat_no + '</td>' +
                  '<td class="fix-last--td md-padding">' +
                  '<form class="approve-btn green-form">' +
                  '<input type="hidden" name="form_id" value="form1">' +
                  '<input type="hidden" name="username" value="' + booking.username + '">' +
                  '<input type="hidden" name="pass" value="' + booking.u_password + '">' +
                  '<input type="hidden" name="flat_no" value="' + booking.flat_no + '">' +
                  '<input type="hidden" name="block_no" value="' + booking.block_no + '">' +
                  '<button class="child-green" type="submit" value="Accepted"><ion-icon name="checkmark-sharp"></ion-icon></button> </form>' +
                  '<form class="approve-btn red-form">' +
                  '<input type="hidden" name="form_id" value="form2">' +
                  '<input type="hidden" name="username" value="' + booking.username + '">' +
                  '<input type="hidden" name="pass" value="' + booking.u_password + '">' +
                  '<input type="hidden" name="flat_no" value="' + booking.flat_no + '">' +
                  '<input type="hidden" name="block_no" value="' + booking.block_no + '">' +
                  '<button class="child-red" type="submit" value="Rejected"><ion-icon name="close"></ion-icon></button>' +
                  '</form></td>' +
                  '</tr>'
                );
               

                displayedData[booking.flat_no] = true;
                console.log(displayedData[booking.flat_no]);
              }
            });
            let dataTable = new DataTable('#datatableid');
          },
          error: function (xhr, status, error) {
            console.log('Error in getting data from PHP:');
            console.log('Status:', status);
            console.log('Error:', error);
            console.log('Response Text:', xhr.responseText);
          }
        });
      }
     

      // Event listener for form submission
      $(document).on('submit', '.approve-btn', function (e) {
        e.preventDefault();
       
        $.ajax({
          type: 'POST',
          url: 'approval and rejection.php',
          data: $(this).serialize(),
          success:function (data) {
            $('#requestBody').empty();
            rowNumber=1;
            fetchDataAndUpdate();
            location.reload();
          },
          error:function(xhr, status, error) {
            console.log('Error in getting data from PHP:');
            console.log('Status:', status);
            console.log('Error:', error);
            console.log('Response Text:', xhr.responseText);
          }
        })
      });
      fetchDataAndUpdate();
    });

    
   
 </script>
</body>

</html>

<?php
  }
  else if (!isset($_COOKIE["admin"])){
    header("Location: admin.php");
  exit();
}
?>