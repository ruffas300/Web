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
<?php echo output_message($session->get_message(), $session->get_alert_type());
$picture_id = User::get_picture_id($session->userid);


?>
    <img
            src="bus_unit_picture/logo.png"/>
    <div class="container-fluid">
        <div class="row">
            <!-- left sidebar column -->
<!--            --><?php //include("layouts/user_sidebar.php"); ?>
            <!-- right main column -->
            <div class="col-lg-12">
                <div class="fk">

                    <ul class="ca bqf bqg agk">

                        <?php
                        $live_feeds = Appreciation::find_for_livefeed(10);

                        foreach ($live_feeds as $live_feed) {
                            $giver = get_full_name($live_feed->giver_id);
                            $receiver = get_full_name($live_feed->receiver_id);
                            $category = get_allcategory_names($live_feed->id);
                            $picture = User::get_picture_id($live_feed->receiver_id);
                            echo "
                <li class=\"\" style='width: 90%' >
                  <div class=\"tv\">
                    <img src=\"pictures/". $picture."\" align='left' class=\"circle\" style=\"height:100px; width: 100px;\"/>
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

                                echo "<button class='btn-default btn-xs'>$cat->category_name &nbsp</button>";
                            }

                            echo "<p></p><br><small class=\"\" >". date('m/d/Y g:i a', strtotime($live_feed->date_approved)) . "</small class=\"aec axr\" ><br>";

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
                                    
                                    <li class=\"tu b ahx\" style='margin-left: 100px'>
                                    <img width='35px' height='35px' src=\"pictures/" . $comment->get_picture_id() . "\"><span>&nbsp</span>
                                        ". $commentor. ": " . $commentText ."
                                        <br>$commentDate</br>
                                    </li>
                          ";


                            }

                            echo"<form id='commentForm' method=\"POST\" action=\"postComment.php\">



                                <input type = \"hidden\" id=\"appId\" name = \"appId\" value = ".$live_feed->id." />
                                <input type = \"hidden\" id =\"userId\" name = \"userId\" value = ". $session->userid. " />
                                <input type = \"hidden\" id=\"date\" name = \"date\" value =".date("y/m/d")." />
                                   <li class=\"tu b ahx\" style='margin-left: 100px'>
                                    <div class=\"form-group\">
                                    
                                    
                                        <div style=\"position:absolute;\">
                                          <div style=\"float: left;\">
                                            <img width='35px' height='35px' src=\"pictures/" . $picture_id . "\" style=\"alignment:left;\">
                                                <div style='float: right'>
                                                  <textarea class=\"form-control\" id=\"comment\" name=\"comment\" rows=\"1\" cols=\"55\" required style='alignment: left'></textarea>
                                                        <input  type=\"submit\"class=\"btn btn-primary\" id=\"commentSubmit\"value=\"Submit\" name=\"submit\"  style='alignment: right; display: none;'/>
                                                </div>
                                          </div>
                                        </div>
                        
                                    <br>
                                   
                                  </li>

        </form>
        
        
        
        
";

                            if(!empty($live_feed->get_all_comments())){
                                echo "</ul>";
                            }
                            echo" </div>
                  </div>";




                        }
                        ?>
                    </ul>

                </div>

            </div>

            <div class="col-md-3">
<!--                --><?php //include("layouts/user_sidebar_right.php"); ?>
            </div>

        </div>
    </div>
        </body>
<?php include("layouts/footer.php"); ?>

<script type="text/JavaScript">

    $(document).ready(function () {

        $('form').click(function() {
            console.log( $(this).closest('form').find('input'));

            $(this).closest('form').find('input').hide();

        });


        $('form textarea').on('keyup',function() {

            if(this.value.length) {
                $(this).closest('form').find('input').show();
                $(this).closest('li').attr({style: 'height: 105px'});


            }else{
                $(this).closest('form').find('input').hide();
                $(this).closest('li').attr({style: 'height: 60px'});


            }
        });



        $('input').click(function (e) {
            console.log($(this));
        });



    });


</script>
