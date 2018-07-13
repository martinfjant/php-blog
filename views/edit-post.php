<article class="content">
      <h1>Redigera inlägg</h1>
      <form action="/editPost" method="post">
      <input type="hidden" name="id" value="<?php echo $post->getId() ?>">
<div class="field">
  <div class="control has-icons-left has-icons-right">
    <input class="input is-large" type="text" value="<?php echo $post->getTitle() ?>" name="rubrik">
    <span class="icon is-small is-left">
      <i class="fa fa-pencil"></i>
    </span>
  </div>
</div>
<div class="field">
  <div class="control has-icons-left has-icons-right">
      <textarea class="textarea" rows=15 name="text" placeholder=""><?php echo $post->getContent() ?></textarea>
      <span class="icon is-small is-left">
      <i class="fa fa-file-text"></i>
    </span>
  </div>
</div>
<h3 class="">Kategori</h3>
  <label> Personligt:
  <input type="radio" value="1" name="cat" <?php if ($post->getCatId() == 1):?>checked<?php endif?> >
  </label>
  <label>
    Opersonligt:  
  <input type="radio" value="2" name="cat" <?php if ($post->getCatId() == 2):?>checked<?php endif?> >
  </label>
<h3>Taggar</h3>
  <div id="taginput" class="input tagarea"></div>
  <div class="field is-grouped is-grouped-right">
  <p class="control">
    <button class="button is-primary" type="submit">
      Posta
    </a>
  </p>
  <p class="control">
    <button class="button is-light" type="reset">
      Rensa
    </a>
  </p>
  </form>
  <form action="/deletePost" method="post">
  <input type="hidden" name="id" value="<?php echo $post->getId() ?>">
  <p class="control">
    <button class="button is-light" type="submit">
      Ta bort
  </button>
  </p>
  <!-- <?php
        //  foreach ($post->getTags() as $key => $value)
        //  echo "<a href='/posts/tag/$key' class='tag is-dark'>$value</a>"
         ?> -->
         </div>
  </form>
</div>    
</article>
<script type="text/javascript">
        var taggle = new Taggle('taginput', {
            placeholder: 'Type your favorite type of juice... (hint: orange)',
            allowDuplicates: true,
            tags: [<?php
            foreach ($post->getTags() as $value)
            echo "'$value'"
         ?>]
        });
</script>