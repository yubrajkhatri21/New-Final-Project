<?php
include('php/connector.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email']) || !isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('location:login.php');
    exit;
}

$userid = $_SESSION['user_id'];
$email = $_SESSION['email'];

// Handle password change securely
if (isset($_POST['changepass'])) {
    $oldpass = $_POST['oldpass'];
    $newpass1 = $_POST['newpass1'];
    $newpass2 = $_POST['newpass2'];

    // Use prepared statement for security
    $stmt = $con->prepare("SELECT password FROM userdetails WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($haspassword);
    if ($stmt->fetch()) {
        if (password_verify($oldpass, $haspassword)) {
            if ($newpass1 === $newpass2) {
                $hashedPassword = password_hash($newpass1, PASSWORD_BCRYPT);
                $stmt->close();
                $stmt2 = $con->prepare("UPDATE userdetails SET password = ? WHERE email = ? AND user_id = ?");
                $stmt2->bind_param("ssi", $hashedPassword, $email, $userid);
                if ($stmt2->execute()) {
                    $_SESSION['success'] = 'Password changed successfully.';
                } else {
                    $_SESSION['error'] = 'Unable to change password.';
                }
                $stmt2->close();
            } else {
                $_SESSION['error'] = 'Passwords do not match.';
            }
        } else {
            $_SESSION['error'] = 'Incorrect old password.';
        }
    } else {
        $_SESSION['error'] = 'User not found.';
    }
    $stmt->close();
    header("Location: profile.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/userafterlogin.css">
    <style>
body {
  background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
  min-height: 100vh;
  font-family: 'Roboto', 'Lato', 'Barlow', 'Ubuntu', sans-serif;
  margin: 0;
}
.adminmain-container {
  display: flex;
  max-width: 100%;
  flex-wrap: wrap;
}
.dashdiv {
  flex: 1;
  margin-left: 65px;
  background: rgba(255,255,255,0.95);
  border-radius: 1.2rem;
  box-shadow: 0 8px 32px rgba(0,0,0,0.12);
  margin: 32px 24px 24px 24px;
  padding: 2rem 1.5rem;
  min-width: 0;
}
.profile-title h2 {
  color: #185a9d;
  font-size: 2.2rem;
  background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 18px;
  text-align: center;
}
.profileimage {
  display: flex;
  justify-content: center;
  margin-bottom: 18px;
}
.profileimage img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #43cea2;
  box-shadow: 0 2px 8px #43cea244;
  background: #fff;
}
.main-container-profile {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 24px;
}
.profileinfo {
  flex: 1 1 260px;
  min-width: 220px;
  background: linear-gradient(135deg, #f7f8fa 80%, #a8edea 100%);
  border-radius: 1rem;
  padding: 18px 24px;
  box-sizing: border-box;
  box-shadow: 0 2px 8px rgba(24,90,157,0.09);
}
.inner-profileinfo {
  margin-bottom: 12px;
  font-size: 1.1rem;
  color: #185a9d;
  word-break: break-word;
}
.inner-profileinfo label {
  font-weight: 600;
  color: #ff5722;
}
.inner-profileinfo span {
  color: #333;
  font-weight: 500;
  margin-left: 8px;
}
.bankdetails {
  width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  min-width: 120px;
}
.bankdetails img {
  width: 90px;
  height: auto;
  border-radius: 1rem;
  background: #fff8e1;
  box-shadow: 0 2px 8px #ffb34744;
  border: 2px solid #ffb347;
  max-width: 100%;
}
.changepass-profile {
  margin: 32px auto 0 auto;
  max-width: 420px;
  background: #fff;
  border-radius: 1.2rem;
  box-shadow: 0 4px 18px #185a9d22;
  padding: 2rem 1.5rem;
  box-sizing: border-box;
}
.changepass-profile h2 {
  color: #185a9d;
  font-size: 1.5rem;
  margin-bottom: 18px;
  text-align: center;
}
.passdiv {
  margin-bottom: 18px;
}
.passdiv label {
  display: block;
  margin-bottom: 6px;
  color: #43cea2;
  font-weight: 600;
}
.passdiv input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1.5px solid #43cea2;
  border-radius: 7px;
  font-size: 1rem;
  background: #f7f8fa;
  transition: border 0.2s;
  box-sizing: border-box;
}
.passdiv input[type="password"]:focus {
  border: 1.5px solid #185a9d;
  outline: none;
}
.passdiv-button {
  text-align: center;
}
.passdiv-button input[type="submit"] {
  background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
  color: #fff;
  border: none;
  padding: 12px 36px;
  border-radius: 24px;
  font-size: 1.1rem;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 2px 8px #185a9d22;
}
.passdiv-button input[type="submit"]:hover {
  background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
  color: #185a9d;
  transform: scale(1.05);
}
.editbtn {
  text-align: center;
  margin-top: 24px;
}
.editbtn a {
  background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
  color: #185a9d;
  padding: 12px 32px;
  border-radius: 24px;
  font-size: 1.1rem;
  font-weight: 700;
  text-decoration: none;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 2px 8px #ffb34744;
  display: inline-block;
}
.editbtn a:hover {
  background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
  color: #fff;
  transform: scale(1.05);
}
.success-message,
.error-message {
  max-width: 90vw;
  word-break: break-word;
  z-index: 2000;
}

.success-message {
  background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
  color: #fff;
  padding: 18px 32px;
  position: fixed;
  top: 18px;
  right: 18px;
  text-align: center;
  font-size: 1.2rem;
  font-weight: bold;
  border-radius: 10px;
  box-shadow: 0 2px 8px #43cea244;
}

.error-message {
  background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
  color: #fff;
  padding: 18px 32px;
  position: fixed;
  top: 70px;
  right: 18px;
  text-align: center;
  font-size: 1.2rem;
  font-weight: bold;
  border-radius: 10px;
  box-shadow: 0 2px 8px #ffb34744;
}

@media (max-width: 900px) {
  .adminmain-container {
    flex-direction: column;
  }

  .dashdiv {
    margin: 16px 2vw;
    padding: 1rem 2vw;
  }

  .main-container-profile {
    flex-direction: column;
    gap: 12px;
  }

  .bankdetails {
    width: 100%;
    justify-content: flex-start;
  }
}

@media (max-width: 600px) {
  .dashdiv {
    margin: 8px 0;
    padding: 0.5rem 1vw;
  }

  .main-container-profile {
    flex-direction: column;
    gap: 8px;
  }

  .profileinfo,
  .bankdetails {
    width: 100%;
  }

  .changepass-profile {
    padding: 1rem 0.5rem;
  }

  .profileimage img {
    width: 80px;
    height: 80px;
  }

  .bankdetails img {
    width: 60px;
  }
}
    </style>
    <script type="text/javascript">
      function showMessage(message, className) {
        var messageElement = document.createElement('div');
        messageElement.className = className;
        messageElement.innerText = message;
        document.body.appendChild(messageElement);
        setTimeout(function() {
          messageElement.remove();
        }, 5000);
      }
    </script>
</head>

<body>
  <div class="adminmain-container" style="max-width:100%;">
    <div class="menudiv"><?php include("view/app/usermenu.php") ?></div>
    <?php
    $semail = $_SESSION['email'];
    $stmt = $con->prepare("SELECT * FROM userdetails WHERE email = ?");
    $stmt->bind_param("s", $semail);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($data = $result->fetch_assoc()) {
    ?>
      <div class="dashdiv">
        <div class="profile-title">
          <h2>Profile</h2>
        </div>
        <div class="profileimage">
          <img src="<?= htmlspecialchars($data['image']) ?>" alt="Profile Image">
        </div>
        <div class="main-container-profile">
          <div class="profileinfo">
            <div class="inner-profileinfo">
              <label>User ID: <span><?= htmlspecialchars($data['user_id']); ?></span></label>
            </div>
            <div class="inner-profileinfo">
              <label>Name: <span><?= htmlspecialchars($data['name']); ?></span></label>
            </div>
            <div class="inner-profileinfo">
              <label>Email: <span><?= htmlspecialchars($data['email']); ?></span></label>
            </div>
            <div class="inner-profileinfo">
              <label>Address: <span><?= htmlspecialchars($data['address']); ?></span></label>
            </div>
            <div class="inner-profileinfo">
              <label>Phone No: <span><?= htmlspecialchars($data['phone']); ?></span></label>
            </div>
            <div class="inner-profileinfo">
              <label>Gender: <span><?= htmlspecialchars($data['gender']); ?></span></label>
            </div>
          </div>
          <div class="bankdetails">
            <img src="photo/profile.png" alt="Profile Icon">
          </div>
        </div>
      <?php } $stmt->close(); ?>
      <div class="changepass-profile">
        <h2>Change Password</h2>
        <form action="profile.php" method="POST" autocomplete="off">
          <div class="passdiv">
            <label>Old Password</label>
            <input type="password" name="oldpass" required placeholder="Enter old Password" autocomplete="current-password">
          </div>
          <div class="passdiv">
            <label>New Password</label>
            <input type="password" name="newpass1" required placeholder="Enter new Password" autocomplete="new-password">
          </div>
          <div class="passdiv">
            <label>Confirm Password</label>
            <input type="password" name="newpass2" required placeholder="Confirm Password" autocomplete="new-password">
          </div>
          <div class="passdiv-button">
            <input type="submit" value="Change Password" name="changepass">
          </div>
        </form>
      </div>
      <div class="editbtn">
        <a href="profileedit.php?id=<?= $userid ?>">Edit Profile</a>
      </div>
      </div>
  </div>
  <?php if (isset($_SESSION['success'])) { ?>
    <script type="text/javascript">
        showMessage('<?php echo addslashes($_SESSION['success']); ?>', 'success-message');
    </script>
    <?php unset($_SESSION['success']); ?>
  <?php } ?>
  <?php if (isset($_SESSION['error'])) { ?>
    <script type="text/javascript">
        showMessage('<?php echo addslashes($_SESSION['error']); ?>', 'error-message');
    </script>
    <?php unset($_SESSION['error']); ?>
  <?php } ?>
</body>
</html>