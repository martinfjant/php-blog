<article class="content is-medium">
  Hej och välkommen <?php echo $posts[0]->getUserName(); ?>.
  Du är registrerad som <?php echo $posts[0]->getAuthor(); ?>
  med e-postadressen <?php echo $posts[0]->getEmail();?>.
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
          <a class="button is-small is-pulled-right" href="/post/<?php echo $post->getId() ?>/edit">
            Redigera
          </a>
        </p>
    </div>
  <?php endforeach?>
  <a class="button is-small is-pulled-right" href="/user/post/create">
    Skapa nytt inlägg
  </a>
</article>
