<div class = "mt-5" style = "height: 600px;overflow-y: auto;">
    <table class="table">
        <thead class="table-dark">
        <tr> <th>ID</th> <th>Name</th> <th>Address</th> <th>Date</th> <th>Consumtion</th> </tr>
        </thead>
        
        <?php

            $sql = "SELECT * FROM consumption";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while($row = mysqli_fetch_assoc($result)){
                $sql = "SELECT * FROM users WHERE id=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "i", $row['id']);
                mysqli_stmt_execute($stmt);
                $users = mysqli_stmt_get_result($stmt);
                $user_data = mysqli_fetch_assoc($users);


                $addr = $user_data['home'].", ".$user_data['road'].", ".$user_data['city'];
                $date = mb_substr($row['date'], 0, 2)."-".mb_substr($row['date'],2, 2)."-".mb_substr($row['date'], 4, 8);

                echo "<tr> <td>".$row['id']."</td> <td>".$user_data['name']."</td> <td>".$addr."</td> <td>".$date."</td> <td>".$row['consumption']."</td> </tr>";
            }
        ?>    

    </table>
</div>