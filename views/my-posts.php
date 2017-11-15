
<article class="content is-medium">
<?php foreach ($posts as $post): ?>
<div>
		<h2 class="title is-1">
			<a href="/post/<?php echo $post->getId() ?>">
			<?php echo $post->getTitle() ?>
			</a>
		</h2>
<p class="subtitle is-5 has-text-grey-lighter">
	Från:
	<?php echo $post->getDate() ?>
  <a class="button" href="/edit/<?php echo $post->getId() ?>">
    Redigera
  </a>
</p>

	</div>
<?php endforeach?>
	</article>
