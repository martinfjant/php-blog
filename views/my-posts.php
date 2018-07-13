<article class="content is-medium">
  <?php if ($_SESSION['loggedin'] == true): ?>
  <div class="box">
  Hej och välkommen <?php echo $posts[0]->getUserName(); ?>.
  Du är registrerad som <?php echo $posts[0]->getAuthor(); ?>
  med e-postadressen <?php echo $posts[0]->getEmail();?>.
  </div>
<?php else:?>
<h1>Inlägg av <?php echo $posts[0]->getAuthor();?></h1>
<?php endif?>
  <?php foreach ($posts as $post): ?>
    <div>
        <h2 class="title is-2">
          <a href="/post/<?php echo $post->getId() ?>">
          <?php echo $post->getTitle() ?>
          </a>
        </h2>
        <p class="subtitle is-5 has-text-grey-lighter">
          Från:
          <?php echo $post->getDate() ?>
          <?php if ($_SESSION['loggedin'] == true): ?>
          <a class="button is-small is-pulled-right" href="/post/<?php echo $post->getId() ?>/edit">
            Redigera
          </a>
          <?php endif?>
        </p>
    </div>
  <?php endforeach?>
  <div>
  <br>
  <?php if ($_SESSION['loggedin'] == true): ?>
  <a class="button is-small is-pulled-right" href="/user/post/create">
    Skapa nytt inlägg
  <?php endif?>  
  </a>
  </div>
</article>
