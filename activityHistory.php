<?php
/**
 * Created by PhpStorm.
 * User: Ed
 * Date: 3/24/18
 * Time: 7:31 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

$tableHeader = "";
$tableData = "";

require_once("includes/initialize.php");
include("layouts/header.php");


// well need the user id too for all so add this later
if(isset($_GET['type'])){


    switch ($_GET['type']){

        case"recognitionReceived";
            $tableHeader = "<th >Date</th>
                <th >Action</th>
                <th >Detail</th>";

            //For loop here through rows of comments
            $tableData = "<tr><td >Dxcxcate</td>
                <td >Actercdccion</td>
                <td >rere</td></tr>";
        break;

        case"postGiven";
            $tableHeader = "<th >Date</th>
                <th >Action</th>
                <th >Detail</th>";

            //For loop here through rows of comments
            $tableData = "<tr><td >Dxcxcate</td>
                <td >Actercdccion</td>
                <td >rere</td></tr>";
            break;

        case"commentsWritten";

        $tableHeader = "<th >Date</th>
                <th >Action</th>
                <th >Detail</th>";

        //For loop here through rows of comments
        $tableData = "<tr><td >Dxcxcate</td>
                <td >Actercdccion</td>
                <td >rere</td></tr>";
            break;




    }

}
?>


<div class=' col-md-10' style="margin-top: 10%">
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

