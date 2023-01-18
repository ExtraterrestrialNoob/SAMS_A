<html>
    <head>
        <title>
            SAMS A
        </title>

        <link rel="stylesheet" href="assets/style.css">

    </head>
    <body>

        <!-- Includes -->
        <?php 
            require 'Controllers/Fetch_data.php'
        ?>

        <div class="nav-bar">
            <ul class="menu-list">
                <li><a href="">HOME</a></li>
                <li><a href="late.php">LATE</a></li>
                <li><a href="">LOGIN</a></li>
            </ul>
        </div>
        <div class="container-all">
            <div class="camera">

            </div>
            <div class="input-form">
                <form action="" method="post">
                    <label for="qr">SCAN QR</label>
                    <input type="text" placeholder="QR" id="qr" name="qr">

                    <div class="radio_section">
                        <input type="radio" id="in" name="in_or_out"> IN
                        <input type="radio" id="out" name="in_or_out"> OUT
                    </div>
                    <input type="submit" value="SUBMIT" id="submitbtn">
                </form>
            </div>
        </div>
        <div class="Table">
            <table>
            <thead>
                <tr>
                    <th>Record ID</th>
                    <th>Student ID</th>
                    <th>Record Time</th>
                    <th>Status</th>
                    <th>LOGDATE</th>
                </tr>
            </thead>
            <?php

            $all_data = get_late_today();
            print_r($all_data);
            ?>
            <tbody>
                <?php foreach ($all_data as $row) { ?>
                    <tr align="center">
                        <td><?= htmlentities($row['At_id']); ?></td>
                        <td><?= htmlentities($row['stu_id']); ?></td>
                        <td><?= htmlentities($row['record_time']); ?></td>
                        <td><?= htmlentities($row['out_or_in']); ?></td>
                        <td><?= htmlentities(date("M d, Y",strtotime($row['record_date']))); ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </body>
</html>