<?php
    $dataLayer = new \DataLayer\DataLayer();
?>

<p>
    This framework has been designed for SPA, but can be also used as backend for different purposes. It's also suitable for big projects.
</p>

<?=(DEV_SERVER ? '<p class="green">You\'re on the develop server</p>' : '<p class="red">DEV_SERVER constant not found. Please, add DEV_SERVER constant to your server for turning on the develop mode</p>')?>

<h2>Basic information:</h2>

<p>
    In the root folder you can see your main directories, that you will work with.
    www - must be targeted as public root of your site, where main index.php (basic GET requests) and datapoint.php (basic ajax requests) file presented.
    Javascript, css and images placed here in the media folder.
    Engine folder contains abstract classes of framework, his core.
    Requests contains some basic request classes, that you need to obtain data from DataLayer. DataLayer presents your main user functions.
    DataLayer.php describes the functions, that you can access and the SecurityLayer.php, that controls the access to this data.
    Also, SecurityLayer class adds some extra information to requests, like user info, if request class is implemented from user basic class.
    By the SecurityLayer you can get the current user data from session. Check <a href="\users">users page</a> for example.
    This user data can be used in your functions, that grouped in packs.
</p>

<p>The full way of data can be shown like this: <i>index page -> datalayer -> package -> specific function -> output</i></p>

<p>
    There are 3 security levels in the engine (you're also can add come more). 0 level functions allowed for all users.
    1 level functions allowed for all registered users. And 2 level functions allowed only for users with admin rights.
    To change the user access level you need to open your data base browser and in the users table change user type string from USR to ADM.
    Or you can manually call function "changeUserType" in the users package.
    First user in system will be always created as admin user.
</p>

<p>
    Each folder in the DataLayer presents some pack with different purposes. Note, that packs may use functions from another packs.
</p>

<p>
    Settings for your project you may find in the init.php, user configuration section.
    To add full error displaying for your test server add environment variable DEV_SERVER to your server settings. For ngingx it's will be "fastcgi_param DEV_SERVER enabled;"
</p>

<h2>Fast start instructions for creating your project:</h2>

<p>
    For the fast start of creating a new site, you better to create new package, that will store your own functions, but you can use existing package Main.
    The architecture in your package will be always similar to Main package, just don't forget to change namespaces.
</p>

<p>
    base.css and all.css must contain basic styles, but it is also page folder in the styles you may find.
    If you name there some file, for example, example.css, then, when you access /?example styles for example page will automatically loaded in the base.php.
</p>

<h2>Check the following pages to learn more about specific packages (and check page sources in the templates):</h2>

<ul>
    <li>
        <a href="/?connection">DB connection and tables</a>
    </li>

    <li>
        <a href="/?api">Generated API reference</a>
    </li>

    <li>
        <a href="/?users">Users package</a>
    </li>

    <li>
        <a href="/?gallery">Gallery package</a>
    </li>

    <li>
        <a href="/?news">News package</a>
    </li>

    <li>
        <a href="/?slider">Slider package</a>
    </li>

    <li>
        <a href="/?csv">CSV package</a>
    </li>
</ul>

<script>
    $(document).ready(function(){

    });
</script>


































