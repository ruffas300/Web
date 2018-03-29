<?php
/**
 * Created by PhpStorm.
 * User: Ed
 * Date: 3/24/18
 * Time: 7:31 PM
 */

require_once("includes/initialize.php");
include("layouts/header.php");


//TODO LIST PEOPLE HERE
if(isset($_GET['id'])) {

    $thisFeller = getUserById($_GET['id']);


}

?>
<div class="container-fluid">
    <div class="col-lg-1 col-lg-10" style="margin-top:  5%; width: 300px ">
        <img src="pictures/<?PHP echo $thisFeller->picture_id; ?> " style="height: 300px ;width: inherit; border-radius: 20%" >
        <br>
        <h1 style="text-align: center; width: inherit"><?PHP echo get_full_name($thisFeller->id)?></h1>
        <br>
        <h4 style="text-align: center">Recognitions</h4>

        <h4 style="text-align: right"><a href="activityHistory.php?type=postGiven&id=<?PHP echo $thisFeller->id?>" style="text-align:center;">Given</a>  -   <a href="activityHistory.php?type=recognitionReceived&id=<?PHP echo $thisFeller->id?>" style="text-align:center;">Received</a>  -  <a href="activityHistory.php?type=commentsWritten&id=<?PHP echo $thisFeller->id?>"style="text-align:center;">Comments</a></h4>

        <div><h4 style="text-align: left">E-mail: <a href="mailto:<?PHP echo $thisFeller->email_address?>" style="text-align:center;"><?PHP echo $thisFeller->email_address?></a></h4></div>
        <div><h4 style="text-align: left">Department: <?PHP echo get_department_name($thisFeller->department_id)?></h4></div>
        <div><h4 style="text-align: left">Location: <?PHP echo get_businessunit_name($thisFeller->business_unit_id)?></h4></div>
        <div><h4 style="text-align: left">Title:  <?PHP echo $thisFeller->job_title?></h4></div>
        <div><h4 style="text-align: left">Manager: <?PHP echo get_full_name_By_Employee_id($thisFeller->manager_id)?></h4></div>



    </div>

    <div class='col-lg-8 col-lg-10' style=' height: 400px' >
        <a></a>
    </div>


    <?php
            $live_feeds =getAllRecRecog($thisFeller->id);

            echo"
            <div class='col-lg-8 col-lg-10' style=' margin-left: 1% ' >

            
            ";
            foreach ($live_feeds as $live_feed) {
                $giver = get_full_name($live_feed->giver_id);
                $firstReciever = get_allReciverAsUser($live_feed->receiver_id);
                $picture = User::get_picture_id($firstReciever[0]->id);
                echo "
                   <div class=\"col-lg-12 activity-info\" style='margin-left: 2%' >
                    <h1><a href='view_appreciation.php?id=$live_feed->id'> <h2 style='position: relative; font-size: 22'>
                        " . $live_feed->title . "
                      </h2></a><p>
                      </h1>
                        <h4 style='font-size: 10'>Recognized by <a href='view_profile.php?id=$live_feed->giver_id'style='font-size: 12'>". $giver . "</a>!</h4>
                        <span style='margin-top: inherit; font-weight:normal; font-size: 14'>
                        " . $live_feed->description . "
                       </span><br>";

                $allCategorited =  get_allcategory_Objects($live_feed->id);
                foreach ( $allCategorited  as $cat) {

                    if($cat === $allCategorited[0]){
                        echo "<button class='btn-default btn-xs' style='color: #2e6da4'>$cat->category_name &nbsp</button>";

                    }else{
                        echo "<button class='btn-default btn-xs' style='color: #2e6da4; margin-left: 2px;'>$cat->category_name &nbsp</button>";

                    }
                }

                echo "<br><small style=\"margin-top: inherit; color: #808080; font-size: 14\">". date('F d, Y g:i A', strtotime($live_feed->date_approved)) . "</small><br>";

                //Comments from this appreciation
                $allComments = getAllCommentsForAppreciation($live_feed->id);
                for ($i = 0; $i < sizeof($allComments); $i++ ) {

                    $comment  = $allComments[$i];

                    $commentor = get_full_name($comment->user);
                    $date = date_create($comment->date);
                    $commentDate = date_format($date,'F d, Y');
                    $commentText = $comment->commentText;

                    //html for said comments
                    if($i < 4) {


                        echo "<li class=\"tu b ahx\">
                                    <img width='35px' height='35px' src=\"pictures/" . get_picture_id($comment->user) . "\" style='border-radius: 20%'><span>&nbsp</span>
                                        " . $commentor . ": " . $commentText . "
                                        <br>$commentDate</br>";

                        if($i == 3 && sizeof($allComments)>3){
                            echo "<li class=\"tu b ahx\" style='height: 1%'><a>Show all...</a></li>";
                        }

                        echo"</li>";



                    }else{

                        echo "<liclass=\"tu b ahx\" style='display:none' >
                                    <img width='35px' height='35px' src=\"pictures/" . get_picture_id($comment->user) . "\" style='border-radius: 20%'><span>&nbsp</span>
                                        " . $commentor . ": " . $commentText . "
                                        <br>$commentDate</br></li>";

                    }


                }


                echo"
                                    <li class=\"tu b ahx\" style=' height:60px'>
                                    <form id='commentForm' method=\"POST\" action=\"postComment.php\">



                                <input type = \"hidden\" id=\"appId\" name = \"appId\" value = ".$live_feed->id." />
                                <input type = \"hidden\" id =\"userId\" name = \"userId\" value = ". $session->userid. " />
                                <input type = \"hidden\" id=\"date\" name = \"date\" value =".date('Y-m-d H:i:s')." />
                                   
                                    
                                    
                                        
                                          <div style=\"float: left;\">
                                            <img width='35px' height='35px' src=\"pictures/" . get_picture_id($thisFeller->id) . "\" style=\"alignment:left; border-radius: 20%\">
                                                <div style='float: right'>
                                                  <textarea class=\"form-control\" id=\"comment\" name=\"comment\" rows=\"1\" cols=\"55\" required style='alignment: left'></textarea>
                                                        <input  type=\"submit\"class=\"btn btn-primary\" id=\"commentSubmit\"value=\"Comment\" name=\"submit\"  style='alignment: right; display: none;'/>
                                                </div>
                                          </div>
                                        </div>
                       
                                   
                                  </li>

        </form>";





            }


            echo"</div></div></div>"?>









<?PHP include("layouts/footer.php"); ?>
