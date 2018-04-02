<?php
/**
 * Created by PhpStorm.
 * User: Ed
 * Date: 3/24/18
 * Time: 7:31 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);


$tableTitle = "";
$tableHeader = "";
$tableData = "";

require_once("includes/initialize.php");
include("layouts/header.php");


// well need the user id too for all so add this later
if(isset($_GET['type'])){


    switch ($_GET['type']){

        case"recognitionReceived";

            $tableTitle = get_full_name($_GET['id']) . " Recognitions Received";





            $tableHeader = "<th >Date</th>
                <th >Action</th>
                <th >Detail</th>";

            //For loop here through rows of comments
            $allPostRec= getAllRecRecog($_GET['id']);
            foreach ($allPostRec as $thisPost) {

                //ToDo Link post
                $tableData .= "<tr><td >" . $thisPost->date_given . "</td>
                <td ><a>" . get_allReceiverAsNameLink($thisPost->receiver_id) . "</a>" . " received a Peer Recognition from ". "<a>" . get_full_name($thisPost->giver_id) . "</a></td>
                <td ><a>" . $thisPost->title . "</a><br> " . $thisPost->description . "</td></tr>";
            }

            break;

        case"postGiven":

            $tableTitle = get_full_name($_GET['id'] ). " Recognitions Given";


            $tableHeader = "<th >Date</th>
                <th >Action</th>
                <th >Detail</th>";

            $allPostGiven= getAllGivenRecog($_GET['id']);
            foreach ($allPostGiven as $thisPost) {

                //ToDo Link post
                $tableData .= "<tr><td >" . $thisPost->date_given . "</td>
                <td ><a>" . get_full_name($thisPost->giver_id) . "</a>" . " wrote a peer recognition post for ". "<a>" . get_allReceiverAsNameLink($thisPost->receiver_id) . "</a></td>
                <td ><a>" . $thisPost->title . "</a><br> " . $thisPost->description . "</td></tr>";
            }

            break;

        case"commentsWritten";

            $tableTitle = get_full_name($_GET['id']) . " Comments Made";


            $tableHeader = "<th >Date</th>
                <th >Action</th>
                <th >Detail</th>";

        //For loop here through rows of comments
        $allComments = getAllComments($_GET['id']);
        foreach ($allComments as $thisComment) {

            //ToDo Link post
            $tableData .= "<tr><td >" .$thisComment->date. "</td>
                <td ><a>".get_full_name($thisComment->user)."</a>"." Commented on a post" ."</td>
                <td ><a>".getAppreciation($thisComment->appreciationId)->title."</a><br> ".$thisComment->commentText. "</td></tr>";
        }

            break;




    }

}
?>


<div class=' col-md-10' style="margin-top: 10%">
    <h2> <?PHP ECHO $tableTitle ?> </h2><br>
    <table class="table table-striped">
         <thead>
            <tr>
                <?PHP ECHO $tableHeader ?>
            </tr>
         </thead>
            <tbody>
                <?PHP ECHO $tableData; ?>
             </tbody>
    </table>
</div>
        
        
        
        
        
        

















<?PHP include("layouts/footer.php"); ?>

