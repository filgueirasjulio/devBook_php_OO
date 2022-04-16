<?php
require 'config.php';
require 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'settings';

$userDao = new UserDaoMysql($pdo);

require 'partials/header.php';
require 'partials/menu.php';
?>
<section class="feed mt-10">
    <h1>Configurações</h1>

    <form method="POST" class="config-form" enctype="multipart/form-data"  action="settings_action.php">
        <label>
            Novo Avatar:</br>
            <input type="file" name="avatar"><br/>

            <img class="mini" src="<?=$base;?>/media/avatars/<?=$userInfo->avatar ?? 'default.jpg';?>" alt="avatar">
        </label>

        <label>
            Nova Capa:</br>
            <input type="file" name="cover" /><br/>

            <img class="mini" src="<?=$base;?>/media/covers/<?=$userInfo->avatar ?? 'cover.jpg';?>" alt="cover">
        </label>

        <hr/>
        <?php if(!empty($_SESSION['flash']) && isset($_SESSION['flash']['message'])): ?>
            <h4  style="color:red;background-color:#ffcdd2;padding:5px 10px;">       
                <?= $_SESSION['flash']['message']; ?>         
            </h4>
        <?php elseif(!empty($_SESSION['flash']) && isset($_SESSION['flash']['success'])): ?>
            <h4  style="color:green;background-color:#a5d6a7 ;padding:5px 10px;">       
                <?= $_SESSION['flash']['success']; ?>         
            </h4>
        <?php endif; ?>  
        <label>
            Nome Completo:<br/>
            <input type="text" name="name" value="<?=$userInfo->name?>"/>
        </label>

        <label>
            E-mail:<br/>
            <input type="email" name="email" value="<?=$userInfo->email?>"/>
        </label>

        <label>
            Data de Nascimento:<br/>
            <input type="text" id="birthdate" name="birthdate" value="<?=date('d/m/Y', strtotime($userInfo->birthdate))?>"/>
        </label>

        <label>
            Cidade:<br/>
            <input type="text" name="city" value="<?=$userInfo->city?>"/>
        </label>

        <label>
            Trabalho:<br/>
            <input type="text" name="work" value="<?=$userInfo->work?>" />
        </label>

        <hr/>

        <label>
            Nova Senha:<br/>
            <input type="password" name="password" />
        </label>

        <label>
            Confirmar Nova Senha:<br/>
            <input type="password" name="password_confirmation" />
        </label>

        <button class="button">Salvar</button>
    </form>
</section>
<script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById("birthdate"),
            {mask:'00/00/0000'}
        );
    </script>
    <?php 
        unset($_SESSION['form']); 
        unset($_SESSION['flash']);         
    ?>
<?php
require 'partials/footer.php';
?>