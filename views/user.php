<article>
<h1><?php echo $post->getUser() ?></h1>
<h2><?php echo $post->getName() ?></h2>
<p>
E-post: <?php echo $post->getEmail() ?>
</p>
<p>
<a class="button" href="/posts/user/<?php echo $post->getUserId() ?>">
  Se alla dina inlägg
</a>
</article>
