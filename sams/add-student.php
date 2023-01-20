<?php include('reusable_part/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h3>Add student</h3>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) { //checking whether session is set or not
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
            <tr>
                    <td>id :</td>
                    <td><input type="text" name="id" id="" placeholder="Enter Your id"></td>
                </tr>
            <tr>
                    <td>Index :</td>
                    <td><input type="text" name="index" id="" placeholder="Enter Your index "></td>
                </tr>
                <tr>
                    <td>Name :</td>
                    <td><input type="text" name="name" id="" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Batch :</td>
                    <td><input type="text" name="batch" id="" placeholder="Enter Your batch"></td>
                </tr>
                <tr>
                    <td>E-mail :</td>
                    <td><input type="text" name="email" id="" placeholder="Enter Your email"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Student" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('reusable_part/footer.php'); ?>

<?php
//process the value and save it database 
//check submit or not
if (isset($_POST['submit'])) {


    //button click
    //get the data form
    $sid = $_POST['id'];
    $sindex = $_POST['index'];
    $sname = $_POST['name'];
    $sbatch = $_POST['batch'];
    $semail = $_POST['email']; //password encrypt with md5 



    //sql query save the data in database
    $sql = "INSERT INTO student SET
             id='$sid',
             sindex='$sindex',
             name='$sname', 
             batch='$sbatch',
             email='$semail'
             ";

    //execute query and save data in database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //check wether the query is executed or not data is inerted or not and display appropriate message
    if ($res == true) {


        //Data inserted
        //echo "Data is inserted";
        //create session variable to display message
        $_SESSION['add'] = " <div class='success'>Admin added successfully</div>";
        //redirect page TO MANAGER ADMIN
        header("location:" . SITEURL . 'admin/manage-student.php');
    } else {


        //fail to inserted data
        //echo "Data is not inserted";
        //create session variable to display message
        $_SESSION['add'] = " <div class='error'>Admin added unsuccessfully</div> ";
        //redirect page TO MANAGER ADMIN
        header("location:" . SITEURL . 'admin/add-admin-student.php');
    }
} else {
    //buttton not click

}
?>