<?php
/**
 * Created by PhpStorm.
 * User: Ed
 * Date: 3/24/18
 * Time: 7:31 PM
 */

$tableTitle = "Associates";
$tableHeader = "";
$tableData = "";

require_once("includes/initialize.php");
include("layouts/header.php");


?>

<div class=' col-md-10' style="margin-top: 10%">
    <h2 style="margin-left: 1%"> <?PHP ECHO $tableTitle ?> </h2><br>
    <br>

    <?PHP

    $allUsers = getAllUsers();
    for ($x = 0; $x < sizeof($allUsers); $x++) {

        $thisUSer = $allUsers[$x];
        //Check if divisible by 4 IF it is we want to start a new row


        ECHO"

            <div class=\"col-xs-12 col-sm-4 col-lg-3 row-col\" style=\"margin-bottom: 25px; height: 64px;\">
                    <div class=\"col-xs-5 col-sm-3 col-xxs-4 xxs \">
                        <img src=\"pictures/". $thisUSer->picture_id."\" align='left' class=\"circle\" style=\"height:64px; width: 64px; border-radius: 20%\"/>
                    </div>
                    <div class=\"col-xs-7 col-sm-9 col-xxs-8 xxs\">
                        <a class=\"font-size-16\" style=\"cursor: pointer; margin-left: 2% white-space: nowrap\" href=\"view_profile.php?id=$thisUSer->id\" >".get_full_name($thisUSer->id)." </a>
                        <div class=\"font-size-12\" data-bind=\"if:CustomData\">
                            <span data-bind=\"html:CustomData\">".get_department_name($thisUSer->department_id)."</span>
                        </div>
                    </div>
                </div>



        
          
        
        
        
        ";

    }



    ?>
</div>











<script>
    // Get the elements with class="column"
    var elements = document.getElementsByClassName("column");

    // Declare a loop variable
    var i;

    // List View
    function listView() {
        for (i = 0; i < elements.length; i++) {
            elements[i].style.width = "100%";
        }
    }

    // Grid View
    function gridView() {
        for (i = 0; i < elements.length; i++) {
            elements[i].style.width = "50%";
        }
    }

    /* Optional: Add active class to the current button (highlight it) */
    var container = document.getElementById("btnContainer");
    var btns = container.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function(){
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>



<?PHP include("layouts/footer.php"); ?>


