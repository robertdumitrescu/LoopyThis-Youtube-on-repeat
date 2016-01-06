<?php
/**
 * Created by PhpStorm.
 * User: robert.dumitrescu
 * Date: 3/20/2015
 * Time: 7:07 PM
 */

$index_route = "http://" . $_SERVER["SERVER_NAME"] . "/AppYoutube/aplicatieYoutube/index.php";
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

        <a class="navbar-brand" href="<?php echo $index_route; ?>">Home</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li class="active"></li>
        </ul>
        <ul class="nav navbar-nav navbar-right custom-navbar-right">
            <li><a href="javascript:void(0)">Privacy Policy</a></li>
        </ul>
    </div>
</div>


<div class="container custom-wrapper">
    <h2 class="custom-h2">1. Short-terms</h2>
    <p>
        By accessing this web site(<?php echo $current_link; ?>), you are agreeing to be bound by these web site Privacy Policy
    </p>
    <p>
    Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how
    we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy
    policy.
    </p>
    <h2 class="custom-h2">2. Major lines</h2>
    <p>
    We will protect personal information by reasonable security safeguards against loss or theft, as well as
    unauthorized access, disclosure, copying, use or modification.
    We will make readily available to customers information about our policies and practices relating to the management
    of personal information.
    </p>

        <h2 class="custom-h2">3. Cookies: How we use Cookies</h2>
    <p>
    <?php echo $current_link; ?> does use cookies to record user-specific information on which pages the user access or visit,
    customize Web page content based on visitors browser type or other information that the visitor sends via their
    browser and to store information about visitors preferences. Cookies are necessary and enhance your browsing
    experience. Without cookies, you would have to reenter all of your information every time you revisited a site. A
    cookie will simply remember your information on the website to save you time. UseFacts wants to deliver the best
    user experience.
    </p>
            <h2 class="custom-h2">4. Site Terms of Use Modifications</h2>
    <p>
    UseFacts may revise these terms of use for its web site at any time without notice. By using this web
    site(<?php echo $current_link; ?>) you are agreeing to be bound by the then current version of these Privacy Policy rules.
    </p>
    <p>
    Privacy Policy - Last updated: July 28, 2014 at 12:54 pm. You think we should update? Write a short e-mail to us.
    </p>
</div>

<?php // include("footer.php"); ?>

</body>


</html>
