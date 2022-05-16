<?php
require 'config.php';
require 'models/Auth.php';
require 'dao/PostDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'home';

$postDao = new PostDaoMysql($pdo);
$info = $postDao->getHomeFeed($userInfo->id);

$feed = $info['feed'];
$pages = $info['pages'];
$currentPage = $info['currentPage'];

require 'partials/header.php';
require 'partials/menu.php';
?>

<section class="feed mt-10">
   <div class="row">
      <div class="column pr-5">

         <?php require 'partials/feed-editor.php'; ?>

         <?php foreach($feed as $item): ?>
            <?php require 'partials/feed-item.php'; ?>
         <?php endforeach; ?>

         <div class="feed-pagination">
            <?php for($q=0;$q<$pages;$q++): ?>
               <a class="<?=($q+1==$currentPage)?'active':''?>" href="<?=$base?>/?p=<?=$q+1?>"><?=$q+1?></a>
            <?php endfor; ?>
         </div>
      </div>
      <div class="column side pl-5">
         <div class="box banners">
            <div class="box-header">
               <div class="box-header-text">Patrocinios</div>
               <div class="box-header-buttons">

               </div>
            </div>
            <div class="box-body">
               <a href=""><img src="https://alunos.b7web.com.br/media/courses/php-nivel-1.jpg" /></a>
               <a href=""><img src="https://alunos.b7web.com.br/media/courses/laravel-nivel-1.jpg" /></a>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
require 'partials/footer.php';
?>