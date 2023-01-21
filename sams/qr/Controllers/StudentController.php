<?php

include 'Models/Connection.php';
if(isset($_POST['sindex'])){
    date_default_timezone_set("asia/kolkata");
    $date = new DateTime();
    $time =  date('h:i:A', strtotime("+0 HOURS"));
    $formated_date = $date->format('Y-m-d H:i:s');
    $sindex = $_POST['sindex'];
    if($sindex == null){
        echo "<div class='alert alert-danger' role='alert' style='font-size:22px'><h4>  Scan First </b> </h4></div>";
        return;

    }
    $at_status = isset($_POST['in_out_status']);
    if($at_status == null){
        echo "<div class='alert alert-danger' role='alert' style='font-size:22px'><h4>  Choose In Or Out </b> </h4></div>";
        return;

    }


    // Get id From Name
    $sql = "SELECT id FROM student WHERE sindex = ?";
    $get_id = $conn->prepare($sql);
    $get_id->bind_param("s", $sindex);
   
    if ( $get_id->execute() === TRUE) {
        $data = $get_id->get_result();
        $id = $data->fetch_assoc();
        if($id == null){
            echo "<div class='alert alert-danger' role='alert' style='font-size:22px'><h4>  user not fount</b> </h4></div>";
            // print_r($id);
            return;
    
        }
        
    }
    if ( $get_id->execute() === TRUE) {
        $data = $get_id->get_result();
        $id = $data->fetch_assoc()['id'];
       
    } 

    
    
    if(isset($_POST['in_out_status'])){
        $at_status = $_POST['in_out_status'];
        $datetime_now = new DateTime();
        $date_only = $datetime_now->format('Y-m-d').'%';
        $sql = "SELECT * FROM att WHERE id =$id AND suspend='0'";
        $previous_outs = $conn->prepare($sql);
        if ( $previous_outs->execute() === TRUE) {
            $data = $previous_outs->get_result();
            $record = $data->fetch_assoc();
            if(isset($record)){
                $at_id = $record['At_id'];
                $rec_status = $record['out_or_in'];
                if(isset($rec_status)){

                    if($at_status == $rec_status){
                       
                        echo "<div class='alert alert-warning' role='alert' style='font-size:22px'><h4><i class='fa fa-clock'></i>  Already : </b> ".$at_status." </div>";
                        
                        return;
                       
                        
                    }else{
                    $update = "UPDATE att SET suspend = 1 WHERE at_id=$at_id";
                    $sttt = $conn->prepare($update);
                    $sttt->execute();
                    }
                }elseif($at_status == 'in'){
                    print_r('Operation Invalid');
                    return;
                  
                    
                }
                    
                
            }elseif($at_status == 'out' or $at_status == 'home'){
               
                echo "<div class='alert alert-success' role='alert' style='font-size:22px'><h4><i class='fa fa-clock'></i>  Already : </b> ".$at_status." </h4><b>Your Time : </b> ".$time."</div>";
                return;
              
                
            }
        }


        // Insert Data to db from scanner
        $sql = "insert into sameera.att (id, record_date,  record_time, out_or_in, suspend)
        values (? , ? , ? , ? , 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $id, $formated_date,  $formated_date, $at_status);

        if ( $stmt->execute() === TRUE) {
            
            echo "<div class='alert alert-success' role='alert' style='font-size:22px'><h4><i class='fa fa-clock'></i>  You Are : </b> ".$at_status." </h4><b>Your Time ".$at_status." Is :</b> ".$time."</div>";
    
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            // echo "messing";
        }
    }
   


    
    //     echo $_POST['sindex'];
    }
   
?>