<?php if(isset($post)): ?>
    <article class="content is-medium">
        <h2 class="title is-1"><?php echo $post->getTitle() ?></h2>
        <h4 class="subtitle is-5 has-text-grey-lighter">
           Av:  <a href="/user/<?php echo $post->getUserId() ?>"><?php echo $post->getAuthor() ?>
           </a>
           <?php echo $post->getDate() ?>
           <?php echo $post->getUserId() ?>
         </h4>
         <?php echo $post->getContent() ?>
     </article>
<?php endif; ?>
