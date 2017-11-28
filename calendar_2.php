<?php snippet('header') ?>

  <main class="main" role="main">

    <header class="wrap">
      <h1><?= $page->title()->html() ?></h1>
      <div class="intro text">
        <?= $page->text()->kirbytext() ?>
      </div>
      <hr />
    </header>
      
    <div class="wrap wide">
        <div style="color: #333"><?php foreach(page('ggg/year-2017/day-2017-11-27')->events()->toStructure() as $event){
    echo $event->hour()->html();
} ?></div>



    </div>

  </main>

<?php snippet('footer') ?>