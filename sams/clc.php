<?php include('reusable_part/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h3>Dashbord</h3>
        <br><br>
        <?php

        if (isset($_SESSION['login'])) { //login session

            echo $_SESSION['login']; //display message
            unset($_SESSION['login']); //removing session message
        }
        ?>


        <div class="col-4 text-center">
            <?php

            $sql = "SELECT * FROM student";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);

            ?>
            <h4><?php echo $count; ?></h4>
            <br>
            student
        </div>



        <div class="col-4 text-center">
            <?php

            $sql2 = "SELECT * FROM users";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count the rows
            $count2 = mysqli_num_rows($res2);

            ?>
            <h4><?php echo $count2; ?></h4>
            <br>
            users
        </div>



        <div class="col-4 text-center">
            <?php

            $sql3 = "SELECT * FROM tbl_admin";
            //execute the query
            $res3 = mysqli_query($conn, $sql3);
            //count the rows
            $count3 = mysqli_num_rows($res3);

            ?>
            <h4><?php echo $count3; ?></h4>
            <br>
            admin
        </div>

        <div class="clear-fix"></div>

    </div>
</div>

<?php include('reusable_part/footer.php'); ?>