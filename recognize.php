<?php
require_once("includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

//load role permissions and check if they have access
$permissions = Role_Perm::get_role_perms($session->roleid);
if (!$permissions->permissions['Give Appreciation']){
    $session->set_message("You do not have access to give appreciation.", "danger");
    redirect_to("main.php");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['receiver_id'])) {
        $session->set_message("You must select a user to appreciate.", "danger");
        redirect_to("recognize.php");
    }
        $appreciation = new Appreciation();

        $receiverList = "";
        foreach ($_POST['receiver_id'] as $rec_id) {
            $receiverList .= $rec_id.",";

        }
        //Categories saved as text in db as csv
        $categoryList= "";
        foreach($_POST['category_id'] as $cat_id){
            $categoryList .= $cat_id.",";
        }
        $appreciation->category_id = $categoryList;


        if(isset($_POST['category_points'])){
        $category_points = $database->escape_value($_POST['category_points']);
        $explode_category_points = explode('|', $category_points);
        }else{
            $explode_category_points = [];
        }
        $appreciation->receiver_id = $receiverList;
//        $appreciation->receiver_history_id = current_user_history($rec_id);
        $appreciation->giver_id = $session->userid;
        $appreciation->giver_history_id = current_user_history($session->userid);
        $appreciation->date_given = date('Y-m-d H:i:s');
        if(!empty($explode_category_points)){
            $appreciation->category_id = $explode_category_points[0];

        }


        if (isset($_POST['give_points']) && $_POST['give_points'] == 1) {
            $appreciation->point_value = $explode_category_points[1];
            $appreciation->paid_out = 0;
        } else {
            $appreciation->point_value = 0;
            $appreciation->paid_out = 1;
        }

        if(isset($_POST['is_public'])) {
            $appreciation->is_public = $database->escape_value($_POST['is_public']);
            $appreciation->status_id = 3;
        }else{
            $appreciation->status_id = 3;
            $appreciation->is_public = 1;
        }

        $appreciation->description = $database->escape_value($_POST['description']);
        $appreciation->title = $database->escape_value($_POST['app_title']);


        if ($appreciation->create()) {
            $successful_result = true;
        } else {
            $session->set_message("An error has occured adding the recognition to the database.", "danger");
            redirect_to("recognize.php");
        }

    
    if($successful_result) {
        $session->set_message("Appreciation sucessfully submitted.", "success");
        redirect_to("recognize.php");  
    }
    
}
?>

<?php include_root_layout_template("header.php"); ?>
<?php echo output_message($session->get_message(), $session->get_alert_type()); ?>
<div class="container-fluid">
<div class="row">
<!-- left sidebar column -->
<?php //include_root_layout_template("user_sidebar.php"); ?>

<!-- right main column -->
    <div class="col-md-6">
        <div class="fk">
            <ul class="ca bqf bqg agk">
                
                <li class="tu b ahx">
                    
                    <h2>Recognize Someone</h2>
                </li>
                
                <div class="tu b ahx">

            <form method="POST" action="recognize.php">
                <div class="form-group">
                    <label for="receiver_id">Who do you want to recognize:</label>
                        <select id="receiver_id" name="receiver_id[]" multiple class="form-control" placeholder="Start typing to select a recipient..." required>
                        	<option value="">Select a user...</option>
                            <?php 
                            $sql = "SELECT * FROM user WHERE status_id=1 AND employee_id != {$session->userid} ORDER BY first_name";
                            $query = $database->query($sql);
                            while($row = $database->fetch_array($query)) {
                                $user_id = $row['id'];
                                $first_name = $row['first_name'];
                                $last_name = $row['last_name'];
                                echo "<option value=\"".$user_id."\">".$first_name." ".$last_name."</option>";
                            }
                            ?>
                        </select>
                        <script>
                        	$('#receiver_id').selectize({
                        	    plugins: ['remove_button'],
                        	    delimiter: ',',
                        	    persist: false
                        	});
                        </script>



                    <div class="form-group">
                        <label for="category_id">Choose Categories:</label>
                        <select id="category_id" name="category_id[]" multiple class="form-control" placeholder="Start typing to select a category..." required>
                            <option value="">Select a category...</option>
                            <?php
                            $sql = "SELECT * FROM category WHERE status_id=1 ORDER BY category_name";
                            $query = $database->query($sql);
                            while($row = $database->fetch_array($query)) {
                                $category_id = $row['id'];
                                $category_name = $row['category_name'];
                                echo "<option value=\"".$category_id."\">".$category_name."</option>";
                            }
                            ?>
                        </select>

                        <script>
                            $('#category_id').selectize({
                                plugins: ['remove_button'],
                                delimiter: ',',
                                persist: false
                            });
                        </script>

                        <div class="form-group">
                            <label for="app_title">Title:</label>
                            <textarea class="form-control" id="app_title" name="app_title" rows="1" cols="40" required></textarea>
                        </div>

                        <div class="form-group">
                    <label for="description">What do you want to say?</label>
                    <textarea class="form-control" id="description" name="description" rows="5" cols="40" required></textarea>
                </div>
                <br><a href="main.php"><button type="button" class="btn btn-danger">Cancel</button></a>  <input type="submit" class="btn btn-primary" value="Submit" name="submit">
        </form>
                </div>
        </li>
        </ul>
        </div>
    </div>

    <div class="col-md-3">
        <div class="fh">
            <div class="rp agk ayf">
                <div class="rq">
                    <h4 class="agd">Category Description</h4>
                    <ul class="bqf bqg">
                        <li class="tu afw">
                            <div class="tv" id="responsecontainer">Choose a category to view the description.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<?php include_root_layout_template("footer.php"); ?>