<?php
global $database;
global $session;
$permissions = Role_Perm::get_role_perms($session->roleid);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>The Dunmore Difference</title>
    
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>

    
      <?php

      if(strpos($_SERVER['PHP_SELF'],"/admin/") !== false){


          echo "<script src=\"".include_admin_js("bootstrap.min.js")."\"></script>";
          echo "<script src=\"".include_admin_js("selectize.min.js")."\"></script>";
          echo "<link href=\"".include_admin_css("bootstrap.min.css")."\" rel=\"stylesheet\">";


          echo "<link href=\"".include_admin_css("admin-css.css")."\" rel=\"stylesheet\">";
          echo "<link href=\"".include_admin_css("footer")."\" rel=\"stylesheet\">";
          echo "<link href=\"".include_admin_css("selectize.min.css")."\" rel=\"stylesheet\">";
          echo "<link href=\"".include_admin_css("admin-css.css")."\" rel=\"stylesheet\">";
          echo "<link href=\"".include_admin_css("selectize.bootstrap.css")."\" rel=\"stylesheet\">";
          echo "<link href=\"".include_admin_css("footer.css")."\" rel=\"stylesheet\">";


      }else{


          echo "<script src=\"".include_js("bootstrap.min.js")."\"></script>";
          echo "<script src=\"".include_js("selectize.min.js")."\"></script>";
          echo "<link href=\"".include_css("bootstrap.min.css")."\" rel=\"stylesheet\">";


          echo "<link href=\"".include_css("footer.css")."\" rel=\"stylesheet\">";

          if (strcmp(basename($_SERVER['PHP_SELF']),"main.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"recognize.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"reward.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"my_profile.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"my_configuration.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"my_appreciation.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"view_pending.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"help.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"release_notes.php")==0) { echo "<link href=\"".include_css("main.css")."\" rel=\"stylesheet\">"; }

            if (strcmp(basename($_SERVER['PHP_SELF']),"login.php")==0) { echo "<link href=\"".include_css("signin.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"recognize.php")==0) { echo "<link href=\"".include_css("selectize.min.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"recognize.php")==0) { echo "<link href=\"".include_css("selectize.bootstrap.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"reward.php")==0) { echo "<link href=\"".include_css("selectize.min.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"reward.php")==0) { echo "<link href=\"".include_css("selectize.bootstrap.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"edit_appreciation.php")==0) { echo "<link href=\"".include_css("selectize.min.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"edit_appreciation.php")==0) { echo "<link href=\"".include_css("selectize.bootstrap.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"my_profile.php")==0) { echo "<link href=\"".include_css("selectize.min.css")."\" rel=\"stylesheet\">"; }
            if (strcmp(basename($_SERVER['PHP_SELF']),"my_profile.php")==0) { echo "<link href=\"".include_css("selectize.bootstrap.css")."\" rel=\"stylesheet\">"; }


      }




          ?>


      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php if(strpos($_SERVER['PHP_SELF'],"/admin/")){ echo '../main.php';}else{ echo 'main.php';} ?>">The Dunmore Difference</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if ($permissions->permissions['Give Appreciation']){ ?>
            <li><a href="<?php if(strpos($_SERVER['PHP_SELF'],"/admin/")){ echo '../recognize.php';}else{echo 'recognize.php';} ?>">Recognize Someone</a></li>
            <?php } ?>
<!--            --><?php //if ($permissions->permissions['Request Rewards']){ ?>
<!--            <li class="dropdown">-->
<!--              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Request Rewards <span class="caret"></span></a>-->
<!--              <ul class="dropdown-menu">-->
<!--                --><?php //
//                        $sql = "SELECT DISTINCT category.id, category.category_name FROM user JOIN user_role ON user_role.user_id = user.id JOIN category_perm_bu ON category_perm_bu.bu_id = user.business_unit_id JOIN category_perm_role ON category_perm_role.role_id = user_role.role_id JOIN category ON category.id = category_perm_role.category_id WHERE user.id = ".$session->userid." AND category.is_reward = 1";
//                        $query = $database->query($sql);
//                        while($row = $database->fetch_array($query)) {
//                          $id = $row['id'];
//                          $name = $row['category_name'];
//
//                          echo "<li><a href=\"reward.php?id=".$id."\">".$name."</a></li>";
//                        }
//                ?>
<!--              </ul>-->
<!--            </li>-->
<!--            --><?php //} ?>
            <?php
            if ($permissions->has_perm('Admin Menu')){ ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'index.php';}else{echo 'admin'.DS.'index.php';} ?>">Dashboard</a></li>
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'user_management.php';}else{echo 'admin'.DS.'user_management.php';} ?>">Users</a></li>
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'businessunit_management.php';}else{echo 'admin'.DS.'businessunit_management.php';} ?>">Business Units</a></li>
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'department_management.php';}else{echo 'admin'.DS.'department_management.php';} ?>">Departments</a></li>
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'category_management.php';}else{echo 'admin'.DS.'category_management.php';} ?>">Recognition Categories</a></li>
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'role_management.php';}else{echo 'admin'.DS.'role_management.php';} ?>">Roles</a></li>
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'approval_management.php';}else{echo 'admin'.DS.'approval_management.php';} ?>">Approvals</a></li>
                <li><a href="<?php  if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo 'report_management.php';}else{echo 'admin'.DS.'report_management.php';} ?>">Reports</a></li>
              </ul>
            <?php }
            ?>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo get_full_name($session->userid); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo '../my_profile.php';}else{echo 'my_profile.php';}  ?>">My Profile</a></li>
                  <li><a href="<?php if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo '../my_appreciation.php';}else{echo 'my_appreciation.php';}; ?>">My Recognition/Rewards</a></li>
                  <li><a href="<?php if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo '../view_pending.php';}else{echo 'view_pending.php';} ?>">View Pending</a></li>
                  <li><a href="<?php if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo '../my_configuration.php';}else{echo 'my_configuration.php';} ?>">Configuration</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?php if(strpos($_SERVER['PHP_SELF'],"/admin/")){echo '../logout.php';}else{echo 'logout.php';} ?>">Log Out</a></li>
                </ul>
              </li>
          </ul>
        </div>
      </div>
    </nav>