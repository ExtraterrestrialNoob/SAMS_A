<?php include('reusable_part/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h3>Update Student</h3>
        <br><br>

        <?php
        //get the id of selected admin
        $id = $_GET['id'];

        //create sql query to get the details from selected admin
        $sql = "SELECT *FROM student WHERE id=$id";

        //Execute query
        $res = mysqli_query($conn, $sql);


        //check wheter query executed  or not
        if ($res == true) {

            //check whether the data is available or not
            $count = mysqli_num_rows($res);

            //check whether we have admin data or not
            if ($count == 1) {

                //get the details
                // echo "  Admin Available<br><br>";
                $row = mysqli_fetch_assoc($res);
                $index= $row['sindex'];
                $name = $row['name'];
                $batch = $row['batch'];
                $email= $row['email'];
                

            } else {

                //we will direct manage admin page
                header("location:" . SITEURL . 'admin/manage-student.php');
            }
        }

        ?>

        <form action="" method="post">
            <table class="tbl-30">
            <tr>
                    <td>index :</td>
                    <td><input type="text" name="index" value="<?php echo $index; ?>"></td>
                </tr>
               
                <tr>
                    <td>Name :</td>
                    <td><input type="text" name="username" value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td>batch :</td>
                    <td><input type="text" name="batch" value="<?php echo $batch; ?>"></td>
                </tr>

                <tr>
                    <td>email :</td>
                    <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
                </tr>
                

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" class="btn-secondary" value="Update Student">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php
//check whether submit btn click or not
if (isset($_POST['submit'])) {
    // echo "btn clicked";
    //get all the value from the form

    $id = $_POST['id'];
    $index = $_POST['index'];
    $name = $_POST['username'];
    $batch = $_POST['batch'];
    $email = $_POST['email'];
    

    //create sql query to update admin
    $sql = "UPDATE student SET  
           sindex= '$index',
           name= '$name',
           batch= '$batch',
           email= '$email'
           
           WHERE id=$id
    ";

    //execute query
    $res = mysqli_query($conn, $sql);

    //check whether query executed or not

    if ($res == true) {

        //query executed
        $_SESSION['update'] = "<div class='success' >Admin Updated Successfully</div>";

        //Redirect to manage admin page
        header("location:" . SITEURL . 'admin/manage-student.php');
    } else {

        //fail to update
        $_SESSION['update'] = "<div class='success' >Admin Updated UnSuccessfully</div>";

        //Redirect to manage admin page
        header("location:" . SITEURL . 'admin/manage-student.php');
    }
} else {
}


?>

<?php include('reusable_part/footer.php'); ?>