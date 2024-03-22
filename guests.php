<?php
include 'env.php';
    $connected = false;
    try {
        // Start the session
        session_start();

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $connected = true;
        
        if(isset($_POST['method'])) {
            if ($_POST['method'] == 'toAdd' && isset($_SESSION['user'])) {
                $guest1 = isset($_POST['guest1']) ? $_POST['guest1'] : '';
                $guest2 = isset($_POST['guest2']) ? $_POST['guest2'] : '';
                $guest3 = isset($_POST['guest3']) ? $_POST['guest3'] : '';
                $guestCount = isset($_POST['guestCount']) ? $_POST['guestCount'] : '';
                $kidsCount = isset($_POST['kidsCount']) ? $_POST['kidsCount'] : 0;
                $willAttend = isset($_POST['willAttend']) ? $_POST['willAttend']: 0;
                $responded = isset($_POST['responded']) ? $_POST['responded']: 0;
                $sql = "INSERT INTO attendees
                    (guest_one, guest_two, guest_three, kids_count, willattend, guest_count, responded)
                    VALUES
                    ('".$guest1."', '".$guest2."', '".$guest3."', '".$kidsCount."', '".$willAttend."', '".$guestCount."', '".$responded."')";
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }   else if ($_POST['method'] == 'toDelete' && isset($_POST['deleteId']) && isset($_SESSION['user'])) {
                echo 'Here';
                $id = $_POST['deleteId'];
                $sqlToDelete = 'DELETE FROM attendees WHERE id = '. $id;
    
                if (mysqli_query($conn, $sqlToDelete)) {
                    echo "Deleted record successfully";
                } else {
                    echo "Error: " . $sqlToDelete . "<br>" . mysqli_error($conn);
                }
            } else if ($_POST['method'] == 'toLogin') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                if ($username == '102123' && $password == '102123') {
                    $_SESSION['user'] = 'admin';
                }
            }
        }
    } catch (Exception $e) {
        echo 'No Connection has been made: '.$e;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guests</title>
    <script src="jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <style>
        .actionColumn {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <?php if (!isset($_SESSION['user'])):?>
            <div class="row flex justify-center">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="guests.php" method="POST">
                                <input type="text" name="method" value="toLogin" hidden>
                                <input type="text" name="username" placeholder="Username" class="form-control"/>
                                <br>
                                <input type="password" name="password" placeholder="Password" class="form-control"/>
                                <br>
                                <button type='submit' class='btn btn-success'>Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="guests.php" method="POST">
                                <input type="text" name="method" value="toAdd" hidden>
                                <br>
                                <label for="guest1">Guest 1</label>
                                <input type="text" name="guest1" placeholder="Enter Guest 1" class="form-control" />
                                <br>
                                <label for="guest2">Guest 2</label>
                                <input type="text" name="guest2" placeholder="Enter Guest 2" class="form-control" />
                                <br>
                                <label for="guest3">Guest 3</label>
                                <input type="text" name="guest3" placeholder="Enter Guest 3" class="form-control" />
                                <br>
                                <label for="kidsCount">Kids Count</label>
                                <input type="number" name="kidsCount" placeholder="Enter Kids Count" class="form-control" />
                                <br>
                                <label for="willAttend">Will Attend</label>
                                <input type="number" name="willAttend" placeholder="Will Attend" class="form-control" />
                                <br>
                                <label for="guestCount">Guest Count</label>
                                <input type="number" name="guestCount" placeholder="Guests Count" class="form-control" />
                                <br>
                                <button type='submit' class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Guest 1</th>
                                <th>Guest 2</th>
                                <th>Guest 3</th>
                                <th>Kids Count</th>
                                <th>Will attend</th>
                                <th>Guests Count</th>
                                <th>Responded</th>
                                <th style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($connected) {
                                $sqlData = "SELECT * FROM attendees";
                                $data = [];
                                $result = mysqli_query($conn, $sqlData);
                                $html = '';
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $html .= '<tr>';
                                        $html .= '<td>'.$row['id'].'</td>';
                                        $html .= '<td>'.$row['guest_one'].'</td>';
                                        $html .= '<td>'.$row['guest_two'].'</td>';
                                        $html .= '<td>'.$row['guest_three'].'</td>';
                                        $html .= '<td>'.$row['kids_count'].'</td>';
                                        $html .= '<td>'.($row['willattend'] ? 'Attend' : 'Declined').'</td>';
                                        $html .= '<td>'.$row['guest_count'].'</td>';
                                        $html .= '<td>'.($row['responded'] ? 'Yes' : 'No').'</td>';
                                        $html .= '<td class="actionColumn"><form action="guests.php" method="POST"><input hidden name="method" value="toDelete" /><input name="deleteId" value="'.$row['id'].'" hidden/><button type="submit" class="btn btn-danger">Delete</button></form><a href="'.$link.''.$row['id'].'" target="_blank" class="btn btn-warning">Visit Link</a></td>';
                                        $html .= '</tr>';
                                    }
                                }
                                echo $html;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif ?>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            $('.copy-link').on('click', function () {
                let toCopy = $(this).data('link');
                // Copy the text inside the text field
                navigator.clipboard.writeText(toCopy);

                // Alert the copied text
                alert("Copied the link: " + toCopy);
            })

        })
    </script>
</body>
</html>