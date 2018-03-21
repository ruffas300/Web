<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/New_York');

require_once("includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
?>
    <body style="background-color: #ffffff">
    
<?php include("layouts/header.php"); ?>
<?php echo output_message($session->get_message(), $session->get_alert_type()); ?>
    <img
            src="https://www.dunmore.com/dunDifference/bus_unit_picture/logo.png"/>
    <div class="container-fluid">
        <div class="row">
            <!-- left sidebar column -->
            <?php include("layouts/user_sidebar.php"); ?>
            <!-- right main column -->
            <div class="col-md-6">
                <div class="fk">

                    <ul class="ca bqf bqg agk">

                        <li class="tu b ahx">
                            <h3 class="agd">Recent Appreciation</h3>
                        </li>

                        <?php
                        $live_feeds = Appreciation::find_for_livefeed(10);

                        foreach ($live_feeds as $live_feed) {
                            $giver = get_full_name($live_feed->giver_id);
                            $receiver = get_full_name($live_feed->receiver_id);
                            $category = get_allcategory_names($live_feed->id);
                            $picture = User::get_picture_id($live_feed->receiver_id);
                            echo "
                <li class=\"tu b ahx\">
                  <div class=\"tv\">
                    <img class=\"round\" src=\"pictures/". $picture."\" align='left'/>
                     <div class=\"bqm\">
                      <div class=\"bqk\">
                         <h1><a href='view_appreciation.php?id=$live_feed->id'> <h2>
                        " . $live_feed->title . "
                      </h2></a>
                      </h1>
                        <h4><strong>" . $receiver . "</strong> recognized by <strong>". $giver . "</strong>!</h4>
                        <p>
                      </div>
                     
                    
                      
                      
                     
                       <p>
                        " . $live_feed->description . "
                      </p>";

                            $allCategorited =  get_allcategory_Objects($live_feed->id);
                            foreach ( $allCategorited  as $cat) {

                                echo "<button>$cat->category_name &nbsp</button>";
                            }

                            echo "<br><small class=\"aec axr\">". date('m/d/Y g:i a', strtotime($live_feed->date_approved)) . "</small class=\"aec axr\"><br>";

                            if(!empty($live_feed->get_all_comments())){
                                echo "<ul>";
                            }
                            //Comments from this appreciation
                            foreach ($live_feed->get_all_comments() as $comment) {
                                $commentor = get_full_name($comment->user);

                                $date = date_create($comment->date);
                                $commentDate = date_format($date,'F d, Y');

                                $commentText = $comment->commentText;

                                //html for said comments
                                echo "
                                    
                                    <li class=\"tu b ahx\">
                                    <img width='35px' height='35px' src=\"pictures/" . $picture . "\"><span>&nbsp</span>
                                        ". $commentor. ": " . $commentText ."
                                        <br>$commentDate</br>
                                    </li>
                          ";


                            }

                            echo"<form method=\"POST\" action=\"recognize.php\">
                        <div class=\"form-group\">
                            <img width='35px' height='35px' src=\"pictures/" . $picture . "\"><span>&nbsp</span>
                            <textarea class=\"form-control\" id=\"comment\" name=\"comment\" rows=\"1\" cols=\"40\" required></textarea>
                        </div>
                        
                        <br><a href=\"main.php\"><button type=\"button\" class=\"btn btn-danger\">Cancel</button></a>  <input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\" name=\"submit\">
        </form>
";

                            if(!empty($live_feed->get_all_comments())){
                                echo "</ul>";
                            }
                            echo" </div>
                  </div></li>";




                        }
                        ?>
                    </ul>

                </div>

            </div>

            <div class="col-md-3">
                <?php include("layouts/user_sidebar_right.php"); ?>
            </div>

        </div>
    </div>
        </body>
<?php include("layouts/footer.php"); ?>