<?php

require_once("includes/initialize.php");
include("layouts/header.php");


?>
<script type="text/javascript">
    var image1 = new Image()
    image1.src = "image/1.jpg"
    var image2 = new Image()
    image2.src = "image/2.jpg"
</script>
<div class="col-lg-12" style="alignment:center; margin-top: 2%; background-image: url('image/bg.jpg')">
    <p><img src="image/1.jpg" width="500" height="250" name="slide_it" style="margin-left: 30%;"/></p>
    <br><img src="bus_unit_picture/Dunmore_Logo.jpg" name="" style="margin-left: 30%;" /></br>
    <p><img src="image/1.jpg" width="500" height="300" name="slide"style="margin-left: 30%;" /></p>
<script type="text/javascript">
    var step=1;
    function slideit()
    {
        document.images.slide_it.src = eval("image"+step+".src");
        document.images.slide.src = eval("image"+step+".src");
        if(step<2)
            step++;
        else
            step=1;
        setTimeout("slideit()",2500);
    }
    slideit();
</script>

</div>
<?php
include("layouts/footer.php");

?>

