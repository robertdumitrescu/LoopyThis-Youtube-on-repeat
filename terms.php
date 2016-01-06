<?php
/**
 * Created by PhpStorm.
 * User: robert.dumitrescu
 * Date: 3/20/2015
 * Time: 7:07 PM
 */


$current_link = "<a href=\"http://" . $_SERVER["SERVER_NAME"] . "/AppYoutube/aplicatieYoutube/index.php\">" . "http://" . $_SERVER["SERVER_NAME"] . "</a>";

?>


<html>
<head>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap-material/css/material-wfont.min.css" rel="stylesheet">
    <link href="public/css/main.css" rel="stylesheet">
    <link href="public/css/skins.css" rel="stylesheet">
</head>

<body>
<?php include_once("analytics_tracking.php") ?>

<div class="navbar navbar-inverse custom-navbar skin-1-navbar navbar-fixed-top">
    <div class="navbar-header">

        <a class="navbar-brand" href="javascript:void(0)">Home</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li class="active"></li>
        </ul>
        <ul class="nav navbar-nav navbar-right custom-navbar-right">
            <li><a href="javascript:void(0)">Terms and Conditions of Use</a></li>
        </ul>
    </div>
</div>



<div class="container custom-wrapper">
<h2 class="custom-h2">1. Use License </h2>

<p>
    We do not own any exclusive rights for the facts displayed on this site.
</p>

<p>
    Permission is granted to temporarily download one copy of the materials (information or software) on
    <?php echo $current_link; ?>
    web site for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of
    title,
    and under this license you may not:
    modify or copy the materials;
    use the materials for any commercial purpose, or for any public display (commercial or non-commercial);
    attempt to decompile or reverse engineer any software contained on <?php echo $current_link; ?> web site;
    remove any copyright or other proprietary notations from the materials; or
    transfer the materials to another person or “mirror” the materials on any other server.
    This license shall automatically terminate if you violate any of these restrictions and may be terminated by
    <?php echo $current_link; ?> at any time. Upon terminating your viewing of these materials or upon the termination of this
    license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
</p>

<h2 class="custom-h2">2. Limitations</h2>

<p>
    In no event shall <?php echo $current_link; ?> or its suppliers be liable for any damages (including, without limitation,
    damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the
    materials on <?php echo $current_link; ?> Internet site, even if <?php echo $current_link; ?> or a <?php echo $current_link; ?> authorized
    representative has been notified orally or in writing of the possibility of such damage.
</p>

<h2 class="custom-h2">3. Revisions and Errata</h2>

<p>
    The materials appearing on <?php echo $current_link; ?> web site could include technical, typographical, or photographic
    errors. <?php echo $current_link; ?> does not warrant that any of the materials on its web site are accurate, complete,
    or current. <?php echo $current_link; ?> may make changes to the materials contained on its web site at any time without
    notice. <?php echo $current_link; ?> does not, however, make any commitment to update the materials.
</p>

<h2 class="custom-h2">4. Links</h2>

<p>
    <?php echo $current_link; ?> has not reviewed all of the sites linked to its Internet web site and is not responsible
    for the contents of any such linked site. The inclusion of any link does not imply endorsement by
    <?php echo $current_link; ?> of the site. Use of any such linked web site is at the user’s own risk.
</p>

<h2 class="custom-h2">5. Consent</h2>

<p>
    By using our website(<?php echo $current_link; ?>), you hereby consent to our disclaimer and agree to its terms.
    We reserve the right to modify or terminate the <?php echo $current_link; ?> service for any reason, without
    notice at any time.
</p>

<p>
    Terms and Conditions of Use - Last updated: August 2, 2014 at 20:09 pm. You think we should update?
    Write a short e-mail to us.
</p>
</div>



<?php include("footer.php"); ?>

</body>


</html>
