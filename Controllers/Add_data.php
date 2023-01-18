<?php 
include 'Models/Connection.php';

if(isset($_POST['qr'])){
    date_default_timezone_set("asia/kolkata");
    $date = new DateTime();
    $formated_date = $date->format('Y-m-d H:i:s');
    $qr = $_POST['qr'];


    // Get id From Name
    $sql = "SELECT id FROM student WHERE sindex = ?";
    $get_id = $conn->prepare($sql);
    $get_id->bind_param("s", $qr);
    if ( $get_id->execute() === TRUE) {
        $data = $get_id->get_result();
        $id = $data->fetch_assoc()['id'];
        print_r($id);
        // print($_POST['in_out_status']);
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
                        print_r('Operation Invalid');
                        exit();
                    }else{
                    $update = "UPDATE att SET suspend = 1 WHERE at_id=$at_id";
                    $sttt = $conn->prepare($update);
                    $sttt->execute();
                    }
                }elseif($at_status == 'in'){
                    print_r('Operation Invalid');
                    exit();
                }
                    
                
            }elseif($at_status == 'out'){
                print('record not found');
                exit();
            }
        }


        // Insert Data to db from scanner
        $sql = "INSERT INTO att (id, record_date, record_time, out_or_in, suspend)
        VALUES ($id, $formated_date , $formated_date , $at_status , 0)";
        $naahh = $conn->prepare($sql);
        // $stmt->bind_param("ssss", $id, $formated_date, $formated_date, $at_status);
        print_r($naahh);
        
        if ( $naahh->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    print_r('Status Not Selected');

    //     echo $_POST['qr'];
    }


?>