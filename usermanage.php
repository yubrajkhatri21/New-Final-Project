<?php include('php/connector.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="css/usermanage.css">
    <link rel="stylesheet" href="view/app/adminmenu.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <div class="adminmain-container">
        <div class="menudiv"><?php include("view/app/adminmenu.php"); ?></div>

        <div class="dashdiv">
            <?php
            if (!isset($_SESSION['email'])) {
                header('location:login.php');
            }
            $semail = $_SESSION['email'];
            ?>

            <div class="sellerupper-container">
                <div class="seller-title">
                    <h2>User Management</h2>
                </div>
                <div class="selleraddbutton">
                    <a href="addusermanage.php" class="add-user-btn">+ Add User</a>
                </div>
            </div>

            <div class="sellermain-container">
                <main class="table">
                    <section>
                        <table>
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sn = 1; ?>
                                <?php
                                $sql = "SELECT * FROM userdetails";
                                $result = mysqli_query($con, $sql);
                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $data['user_id']; ?></td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['email']; ?></td>
                                        <td><?php echo $data['phone']; ?></td>
                                        <td><?php echo $data['address']; ?></td>
                                        <td><?php echo $data['gender']; ?></td>
                                        <td><?php echo $data['role']; ?></td>
                                        <td><img src="<?= $data['image']; ?>" alt="User Image"></td>
                                        <td class="actionbutton">
                                            <a class="bedit" href="usermanageedit.php?id=<?php echo $data['user_id']; ?>"><i class="fas fa-edit"></i></a>
                                            <a class="bdelete" onclick="show(<?php echo $data['user_id']; ?>);"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $sn++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </section>
                </main>
            </div>

            <div class="main-body-delete" id="maindiv">
                <div class="main-delete-container">
                    <div class="inner-delete-container">
                        <h2>Are you sure you want to delete this account?</h2>
                        <i class="fas fa-exclamation-circle"></i>
                        <div class="button">
                            <a href="#" id="cancel" onclick="hidden()" class="cancel">Cancel</a>
                            <a id="delete" class="delete">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function hidden() {
                    document.getElementById("maindiv").style.display = "none";
                }

                function show(id) {
                    document.getElementById("maindiv").style.display = "block";
                    document.getElementById("delete").href = "php/qdeleteuser.php?id=" + id;
                }
            </script>
        </div>
    </div>
</body>

</html>