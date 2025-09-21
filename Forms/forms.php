<?php
class forms {
    public function signup($conf, $ObjFncs){
        $err = $ObjFncs->getMsg('errors');
        print $ObjFncs->getMsg('msg');

        if (isset($_POST['signup'])) {
            $fullname = trim($_POST['fullname']);
            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);

            // basic validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err['mailFormat_error'] = "Invalid email format.";
            } elseif (strlen($password) < 6) {
                $err['password_error'] = "Password must be at least 6 characters.";
            } else {
                // hash password
                $hashed = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conf->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $fullname, $email, $hashed);

                if ($stmt->execute()) {
                    $ObjFncs->setMsg("msg", "Signup successful! <a href='signin.php'>Login here</a>.");
                } else {
                    $err['mailDomain_error'] = "Email already registered.";
                }
            }
        }
?>
<h2>Sign Up Here</h2>
<form action="" method="post" autocomplete="off">
  <div class="mb-3">
    <label for="fullname" class="form-label">Fullname</label>
    <input type="text" class="form-control" id="fullname" name="fullname" maxlength="50"
      placeholder="Enter your fullname"
      value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>" required>
    <?php if(isset($err['fullname_error'])) { ?>
      <div class="alert alert-danger"><?php echo $err['fullname_error']; ?></div>
    <?php } ?>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" maxlength="100"
      placeholder="Enter your email"
      value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
    <?php if(isset($err['mailFormat_error'])) { ?>
      <div class="alert alert-danger"><?php echo $err['mailFormat_error']; ?></div>
    <?php } ?>
    <?php if(isset($err['mailDomain_error'])) { ?>
      <div class="alert alert-danger"><?php echo $err['mailDomain_error']; ?></div>
    <?php } ?>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password"
      placeholder="Enter your password" required>
    <?php if(isset($err['password_error'])) { ?>
      <div class="alert alert-danger"><?php echo $err['password_error']; ?></div>
    <?php } ?>
  </div>

  <?php $this->submit_button('Sign Up', 'signup'); ?> 
  <a href='signin.php'>Already have an account? Login</a>
</form>
<?php
    }

    private function submit_button($value, $name){
?>
        <button type='submit' class="btn btn-primary" name='<?php echo $name; ?>'><?php echo $value; ?></button>
<?php
    }

    public function signin($conf, $ObjFncs){
        $err = [];
        $msg = "";

        if (isset($_POST['signin'])) {
            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);

            $stmt = $conf->prepare("SELECT id, fullname, password FROM users WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $fullname, $hashedPassword);
                $stmt->fetch();

                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['user_id'] = $id;
                    $_SESSION['fullname'] = $fullname;
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $msg = "Invalid password.";
                }
            } else {
                $msg = "No account found with that email.";
            }
        }
?>
<h2>Sign In Here</h2>
<p style="color:red;"><?php echo $msg; ?></p>
<form method="post" autocomplete="off">
  <div class="mb-3">
    <label for="signin_email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="signin_email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="signin_password" class="form-label">Password</label>
    <input type="password" class="form-control" id="signin_password" name="password" required>
  </div>
  <?php $this->submit_button('Sign In', 'signin'); ?> 
  <a href='signup.php'>Don't have an account? Sign Up</a>
</form>
<?php
    }
}
