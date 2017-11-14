<?php if(isset($post)): ?>
    <article class="content is-medium">
        <h2 class="title is-1"><?php echo $post->getTitle() ?></h2>
        <h4 class="subtitle is-5 has-text-grey-lighter">
           Av: <i><?php echo $post->getAuthor() ?> </i>
           <?php echo $post->getDate() ?>
         </h4>
         <?php echo $post->getContent() ?>
     </article>
<?php endif; ?>
