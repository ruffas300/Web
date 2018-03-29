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





//User pw check & redirect!

 $currentPassword= getUserById($session->userid)->password;


if(password_verify("dunmore12", $currentPassword)){
    echo"<script> location.replace('mustReset.php'); </script>";


}


?>
    <img
            src="bus_unit_picture/logo.png"/>
    <div class="container-fluid">
        <div class="wrapper">
            <!-- left sidebar column -->
<!--            --><?php //include("layouts/user_sidebar.php"); ?>
            <!-- right main column -->



                        <?php
                        $live_feeds = Appreciation::find_for_livefeed(10);

                        foreach ($live_feeds as $live_feed) {
                            $giver = get_full_name($live_feed->giver_id);
                            //TODO add multiple recievers
                            $category = get_allcategory_names($live_feed->id);
                            $firstReciever = get_allReciverAsUser($live_feed->receiver_id);
                            $picture = User::get_picture_id($firstReciever[0]->id);
                            echo "
               <div class=\"hidden-xxs col-xs-2 col-md-1 no-padding\">
                 <img src=\"pictures/". $picture."\" align='left' class=\"circle\" style=\"height:85px; width: 85px;\"/>
               </div>
               <div class='row'>
                   <div class=\"col-xxs-12 col-xs-10 col-lg-10 activity-info\">

                    <h1><a href='view_appreciation.php?id=$live_feed->id'> <h2 style='position: relative; font-size: 22'>
                        " . $live_feed->title . "
                      </h2></a><p>
                      </h1>
                    
                        <h4 style='font-size: 10'>".get_allReceiverAsNameLink($live_feed->receiver_id)." recognized by <a href='view_profile.php?id=$live_feed->giver_id'style='font-size: 12'>". $giver . "</a></h4>
                     
                    
                      
                      
                     
                       <span style='margin-top: inherit; font-weight:normal; font-size: 14'>
                        " . $live_feed->description . "
                       </span><br>";
                            $commentLimit = 3;
                            $allCategorited =  get_allcategory_Objects($live_feed->id);
                            foreach ( $allCategorited  as $cat) {

                                if($cat === $allCategorited[0]){
                                    echo "<button class='btn-default btn-xs' style='color: #2e6da4; margin-top: 2px'>$cat->category_name &nbsp</button>";

                                }else{
                                    echo "<button class='btn-default btn-xs' style='color: #2e6da4; margin-left: 2px; margin-top: 2px'>$cat->category_name &nbsp</button>";

                                }
                            }

                            echo "<br><small style=\"margin-top: inherit; color: #808080; font-size: 14\">". date('F d, Y g:i A', strtotime($live_feed->date_approved)) . "</small><br><div id='shownComments'>";

                            //Comments from this appreciation
                            $allComments = $live_feed->get_all_comments();
                            for ($i = 0; $i < sizeof($allComments); $i++ ) {

                                $comment  = $allComments[$i];

                                $commentor = get_full_name($comment->user);
                                $date = date_create($comment->date);
                                $commentDate = date_format($date,'F d, Y');
                                $commentText = $comment->commentText;

                                //html for said comments
                                if($i < $commentLimit) {

                                    echo "<li class=\"tu b ahx\" >
                                    <img width='55px' height='55px' src=\"pictures/" . $comment->get_picture_id() . "\" style='border-radius: 20%'><span>&nbsp</span>
                                        <ul><li style=\"list-style-type: none;\"><a href='view_profile.php?id=$comment->user' style='font-size: 12'>" . $commentor ."</a><span>". ": " . $commentText . "</span></li>
                                        <li style='list-style-type: none'>$commentDate</li>";

                                          if($i == $commentLimit-1 && sizeof($allComments)){
//                                              echo "<li class=\"tu b ahx\" style='height: 1%'><a>Show all...</a></li>";
                                             echo"<li style='list-style-type: none'><a data-toggle=\"collapse\" href=\"#hiddenComms".$live_feed->id."\">Show More...</a></li>";

                                            }

                                            echo"</li></ul>";



                                }else{
                                    // if begininng of hidden comments only
                                    if($i==$commentLimit){
                                        echo"</div><div id=\"hiddenComms$live_feed->id\" class=\"accordion-body collapse\">";
                                    }




                                    if($i == sizeof($allComments)-1) {
                                        echo "<li class=\"tu b ahx\">
                                    <img width='55px' height='55px' src=\"pictures/" . $comment->get_picture_id() . "\" style='border-radius: 20%'><span>&nbsp</span>
                                       <ul><li style=\"list-style-type: none;\"><a href='view_profile.php?id=$comment->user' style='font-size: 12'>" . $commentor ."</a><span>". ": " . $commentText . "</span></li>
                                        <li style='list-style-type: none'>$commentDate</li>";

                                        echo"<li style='list-style-type: none'><a data-toggle=\"collapse\" href=\"#hiddenComms".$live_feed->id."\">Show Less...</a></li>";
                                    }else{
                                        echo "<li class=\"tu b ahx\">
                                    <img width='55px' height='55px' src=\"pictures/" . $comment->get_picture_id() . "\" style='border-radius: 20%'><span>&nbsp</span>
                                        <ul><li style=\"list-style -type: none;\"><a href='view_profile.php?id=$comment->user' style='font-size: 12'>" . $commentor ."</a><span>". ": " . $commentText . "</span></li>
                                        <li style='list-style-type: none'>$commentDate</li>";

                                    }





                                    echo "</li></ul>";


                                }


                            }


                                echo"
                                    </div><li class=\"tu b ahx\" style=' height:60px'>
                                    <form id='commentForm' method=\"POST\" action=\"postComment.php\">



                                <input type = \"hidden\" id=\"appId\" name = \"appId\" value = ".$live_feed->id." />
                                <input type = \"hidden\" id =\"userId\" name = \"userId\" value = ". $session->userid. " />
                                <input type = \"hidden\" id=\"date\" name = \"date\" value =".date('Y-m-d H:i:s')." />
                                   
                                    
                                    
                                        
                                          <div style=\"float: left;\">
                                            <img width='35px' height='35px' src=\"pictures/" . $picture_id . "\" style=\"alignment:left; border-radius: 20%\">
                                                <div style='float: right'>
                                                  <textarea class=\"form-control\" id=\"comment\" name=\"comment\" rows=\"1\" cols=\"55\" required style='alignment: left'></textarea>
                                                        <input  type=\"submit\"class=\"btn btn-primary\" id=\"commentSubmit\"value=\"Comment\" name=\"submit\"  style='alignment: right; display: none;'/>
                                                </div>
                                          </div>
                                        </div>
                        
                                   
                                  </li>

        </form>
        </div>
        </div>
        
        
        
";





                        }
                        ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3">
<!--                --><?php //include("layouts/user_sidebar_right.php"); ?>
            </div>

        </div>
    </div>
</div>
        </body>
<?php include("layouts/footer.php"); ?>

<script type="text/JavaScript">
//
//    function showHiddenComments() {
//        $(this).closest("li").show();
//
//    }

    $(document).ready(function () {

        // $('li a').click(function () {
        //
        //     $(this).parent().siblings("li.tu.b.ahx:hidden").show()
        //     $(this).closest("li").hide();
        //
        //     var lastComment =  $(this).parent().siblings("li.tu.b.ahx").size();
        //     var commentText =  $(this).parent().siblings("li.tu.b.ahx:last");
        //
        //    $(this).parent().siblings("li.tu.b.ahx:last").after("<li class='tu b ahx' style='height: 1%'><a>Collapse...</a></li>");
        //
        //    //TODO Fix show more !!
        //     $(this).parent().siblings("li.tu.b.ahx").each(function(i, obj) {
        //
        //         $('a').click(function () {
        //
        //
        //             if (i > 3 && i != lastComment - 1) {
        //
        //                 console.log($(obj).siblings("li.tu.b.ahx"));
        //
        //                 // $(obj).siblings("li.tu.b.ahx")[i] = "<li class='tu b ahx' style='height: 1%'><a>Collapse...</a></li>";
        //                 $(obj).hide();
        //
        //
        //             }
        //         });
        //
        //     });
        //
        // });

        $('form').click(function() {
            console.log( $(this).closest('form').find('input'));

            $(this).closest('form').find('input').hide();

        });


        $('form textarea').on('keyup',function() {

            if(this.value.length) {
                $(this).closest('form').find('input').show();
                $(this).closest('li').attr({style:'height: 90px'});


            }else{
                $(this).closest('form').find('input').hide();
                $(this).closest('li').attr({style:'height: 60px'});


            }
        });



        $('input').click(function (e) {
            console.log($(this));
        });



    });


</script>
