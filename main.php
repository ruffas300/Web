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
                            $category = get_category_name($live_feed->category_id);
                            $picture = User::get_picture_id($live_feed->receiver_id);
                            print_r($live_feed->get_all_comments());
                            echo "
                <li class=\"tu b ahx\">
                  <img
                    class=\"bqb wp yy agc\"
                    src=\"pictures/" . $picture . "\">
                  <div class=\"tv\">
                    <div class=\"bqm\">
                      <div class=\"bqk\">
                        <small class=\"aec axr\">". date('m/d/Y g:i a', strtotime($live_feed->date_approved)) . ".</small>
                         <h2>
                        <a href='view_appreciation.php?id=$live_feed->id'> <h2>
                        " . $live_feed->title . "
                      </h2></a>
                      </h2>
                        <h6><strong>" . $receiver . "</strong> was recognized for <strong>" . $category . " By " . $giver . "</strong>!</h6>
                      </div>
                     
                       <p>
                        " . $live_feed->description . "
                      </p>
                    </div>
                  </div>
                </li>";
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