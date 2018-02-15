<?php
    $dataLayer = new \DataLayer\DataLayer();
?>

<p>
    This engine designed for SPA, but can be used as backend for different purposes. It's also suitable for big portals with simple js codes, mainly working on PHP7.
</p>

<p>
    This engine needs from you to know basics of php coding, it's totally none code free and needs to write a lot. But it's easy thing to do, because of the engine structure.
</p>

<h2>Basic information:</h2>

<p>
    In the root folder you can see your main directories.
    www - must be targeted as public root of your site, where main index.php(basic GET requests) and datapoint.php(basic ajax requests) file presented.
    Javascript, css and images placed here in media folder.
    Engine folder contains abstract classes of engine and class Tools with some useful static functions.
    Requests contains some basic request classes, that you need to obtain data from DataLayer. DataLayer presents your main core functions.
    DataLayer.php describes the functions, that you can access and the SecurityLayer.php, that controls the access to this data.
    Also, SecurityLayer class adds some extra information, like user info, if request class is implemented from user basic class.
    By the SecurityLayer you can get the current user data from session. Check <a href="\users">users page</a> for example.
    This user data can be used in your functions, that grouped in packs.
</p>

<p>
    There are 3 security levels in the engine. 0 level functions allowed for all users. 1 level functions allowed for all registered users. And 2 level functions allowed only for users with admin rights.
    To change the user access level you need to open your data base browser and in the users table change user type string from USR to ADM. Or you can manually call function "changeUserType" in the users package.
</p>

<p>
    Each folder in DataLayer presents some pack with different purposes. Note, that packs may use functions from another packs.
    The free packs with no dependencies is Templates and Misc.
    Other packs may use functions from Misc pack.
</p>

<p>
    You may notice, that DataLayer.php functions divided on the different sections. It's because DataPoint functions designed to be used with json post requests
    (jsonp for cross domain also usable). For this functions you need to point, which request will be create to store the ajax user data.
    On the other hand functions from default section may be used inside your templates, just by creating DataLayer instance there with no argument in the class constructor.
    index.php access only "render" function from default section. You cannot access other default functions from the browser. datapoint.php access all functions from the datapoint section.
    Use datapoint.php for all your json requests. For SPA you will use only datapoint.php for communication with backend.
</p>

<p>
    Settings for your project you may find in the init.php, user configuration section.
    To add full error displaying for your test server add environment variable with value "enabled" to your server settings. For ngingx it's will be "fastcgi_param DEV_SERVER enabled;"
</p>

<h2>Fast start instructions for creating your project:</h2>

<p>
    For the fast start of creating a new site, you need to create new package, that will store your own needed functions.
    For doing this you may just copy some existing package, like Misc and change the namespaces.
    Then, go to Templates package and change base.php and main.php in the Templates folder there. Base.php is the outer of all of your other pages.
    Main.php opens when other not requested.
</p>

<p>
    base.css and all.css must contains basic styles, but it is also page folder in the styles you may find.
    If you name there some file, for example, example.css, then, when you access /?example styles for example page will automatically loaded in the base.php.
</p>

<h2>Check the following pages to learn more (and check page sources in the templates):</h2>

<ul>
    <li>
        <a href="/?connection">DB connection and tables</a>
    </li>

    <li>
        <a href="/?users">Users package</a>
    </li>

    <li>
        <a href="/?gallery">Gallery package</a>
    </li>

    <li>
        <a href="/?slider">Slider package</a>
    </li>
</ul>

<script>
    $(document).ready(function(){

    });
</script>


































