<?php

//
//


error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("includes/initialize.php");

//check if logged in and redirect if not
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}


//check to see if password was changed, if so update
if (isset($_POST['changepassword'])) {
    if ($_POST['password'] == $_POST['confirm-password']) {
        $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        if (User::update_password($new_password, $session->userid)) {
            $session->set_message("Password changed successfully.", "success");
            redirect_to("my_profile.php");
        } else {
            $session->set_message("An error occured while changing password.", "warning");
            redirect_to("my_profile.php");
        }
    } else {
        $session->set_message("Your password did not match, try again.", "danger");
        redirect_to("my_profile.php");
    }
}


//get current logged in user and load their information
$user = User::find_by_id($session->userid);

?>

<?php include_root_layout_template("header.php"); ?>
<?php echo output_message($session->get_message(), $session->get_alert_type()); ?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-9">
                <div class="fk">
                    <ul class="ca bqf bqg agk ">

                        <li class="tu b ahx" style="list-style-type: none">
                            <h2 style="margin-top: 10%; margin-left: 10%">Reset Your Password</h2>
                            <h3 style="margin-left: 10%">You are required to create a new password</h3>
                        </li>

                        <li class="tu b ahx" style="list-style-type: none">
                            <form method="POST" enctype="multipart/form-data" action="my_profile.php">

                                <div class="form-group" style="margin: 10%; margin-top: 2%; margin-bottom: 1%">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password"><br>
                                    <input type="submit" class="btn btn-primary" value="Change Password" name="changepassword">
                                </div>
                                <div class="form-group">

                                    <img  style="margin: 10%; height: 275px; width: 275px;" src="pictures/stop.png">





                                </div>
                                <br>


            </div>

        </div>
    </div>
<?php include_root_layout_template("footer.php");


?>