<?php
$dataLayer = new \DataLayer\DataLayer();

$users = null;
$exception = null;

try {
    $users = $dataLayer->processRequest("getUsersList", new \Requests\Dummy())['data'];
}catch(\Exception $e){
    $exception = $e->getMessage();
}
?>



<?php if ($user): ?>
    <h2>Hello, <?=$user['Login']?></h2>
    <p>
        Login: <?=$user['Login']?><br/>
        Ip: <?=$user['Ip']?><br/>
        Type: <?=$user['Type']?>
    </p>
    <p>
        <button class="quit-user">Quit</button>
    </p>
<?else:?>
    <h2>Please, log in</h2>
    <p class="login">
        Login<br>
        <input class="user-login"/><br>
        Password<br>
        <input class="user-password"/><br>
        <button class="login-user">Login</button>
    </p>
<?endif?>


<?php if (!$exception): ?>
    <h2>Users list</h2>

    <?php if (count($users)): ?>
        <?php
            foreach ($users as $key => $value){
                echo '<p>'.$value['Id'].'. '.$value['Login'].' ('.$value['Type'].')</p>';
            }
        ?>
    <?else:?>
        <p>
            The user table is empty
        </p>
    <?endif?>

    <h2>Add new user</h2>
    <p class="add-user">
        Login<br>
        <input class="user-login"/><br>
        Password<br>
        <input class="user-password"/><br>
        <button class="add-user">Add user</button>
    </p>
<?else:?>
    <p>
        <a href="/?connection">Error. Please, check connection to the database and users table.</a>
    </p>
    <p>
        Exception: <?=$exception?>
    </p>
<?endif?>

<script>
    $(document).ready(function(){
        $(".add-user button.add-user").click(function(e){
            var login = $('.add-user .user-login').val();
            var password = $('.add-user .user-password').val();

            datapoint.call("addUser", {
                login: login,
                password: password
            }, function(data){
                location.reload();
            })
        });

        $(".login button.login-user").click(function(e){
            var login = $('.login .user-login').val();
            var password = $('.login .user-password').val();

            datapoint.call("login", {
                login: login,
                password: password
            }, function(data){
                location.reload();
            })
        });

        $("button.quit-user").click(function(e){
            datapoint.call("quit", {}, function(data){
                location.reload();
            })
        });
    });
</script>
