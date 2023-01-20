<?PHP

session_start();

if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {

header ("Location: ../index.php");

}

?>

<!doctype html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

     <script>
        $(document).ready(function() {
            $('#dataTable_1').DataTable();
        });
    </script>
   
   
        <title>
            SAMS A
        </title>
        <nav class="navbar navbar-expand-lg" style="background-color: #ffbc05">
    <a class="navbar-brand" href="index.php"><strong style="color: #fff"><i class='fa fa-user-clock'></i> DAILY TIME RECORD</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link" href="late.php" style="color: #fff"><b><i class="fa fa-user"></i> LATE STUDENT TABLE </b></a>
            </li>

        </ul>

    </div>
    <div class="align-items-end"" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link" href="../logout.php" style="color: #fff"><b><i class="fa fa-user"></i> Logout </b></a>
            </li>

        </ul>

    </div>
</nav><br>
    </head>
    <body onload="startTime()"><br>

        <!-- Includes -->
        <?php 
            require 'Controllers/Fetch_data.php';
            
        ?>

<div class="container">
        <div class="row">
            <div class="col-md-4">
                <center>
                    <p style="border: 1px solid #ffbc05;background-color: #ffbc05;color: #fff"><i class="fas fa-qrcode"></i> TAP HERE</p>
                </center>
                 <video id="preview" width="100%"></video>
                 <?php include 'Controllers/StudentController.php';?>
                 <hr></hr>
            </div>

            <div class="col-md-8">
                <center>
                    <div id="clockdate" style="border: 1px solid #ffbc05;background-color: #ffbc05">
                        <div class="clockdate-wrapper">
                            <div id="clock" style="font-weight: bold; color: #fff;font-size: 40px"></div>
                            <div id="date" style="color: #fff"><i class="fas fa-calendar"></i> <?php echo date('l, F j, Y'); ?></div>
                        </div>
                    </div>
                </center>
                <form action="" method="POST" class="form-harizontal">

                    <label><b>SCAN QR CODE</b></label>
                    <input type="text" name="sindex" id="sindex" readonly="" placeholder="scan qrcode" class="form-control"> <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="in_out_status" id="in" value="in">
                        <label class="form-check-label" for="in">IN</label>
                       </div>
                       <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="in_out_status" id="out" value="out">
                        <label class="form-check-label" for="out">OUT</label>
                    </div>

                    <!-- </div> -->

                    <br>
                    <div class="btn_submit">
                        <input class="btn btn-primary" type="submit" value="Submit">
                        <!-- <input type="submit" value="submit" class="btn"> -->
                    </div>
                </form>
                <hr>
                </hr>
               <div class="table-responsive">
                <table id="dataTable_1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>Student ID</th>
                            <th>Record Time</th>
                            <th>Status</th>
                            <th>LOGDATE</th>

                        </tr>
                    </thead>
                    <tbody>    
                   <?php 
                      $all_data = get_attendence_today();
                    ?>
                    <?php foreach ($all_data as $row) { ?>
                        <tr align="center">
                            <td><?= htmlentities($row['At_id']); ?></td>
                            <td><?= htmlentities($row['id']); ?></td>
                            <td><?= htmlentities($row['record_time']); ?></td>
                            <td><?= htmlentities($row['out_or_in']); ?></td>
                            <td>  <?= htmlentities(date("M d, Y",strtotime($row['record_time']))); ?></td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
          </div>

      </div>
    </div>

    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }

        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('sindex').value = c;
            // document.forms[0].submit();
        });
    </script>

     <script type="text/javascript">
      document.oncontextmenu = document.body.oncontextmenu = function() {return false;}//disable right click
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    
</body>

</html>   