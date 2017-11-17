<article class="content is-medium">
<?php foreach ($posts as $post): ?>
<div>
		<h2 class="title is-1">
			<a href="/post/<?php echo $post->getId() ?>">
			<?php echo $post->getTitle() ?>
			</a>
		</h2>
<p class="subtitle is-5 has-text-grey-lighter">
	Av: <a href="/user/<?php echo $post->getUserId() ?>"><?php echo $post->getAuthor() ?>
           </a>
	<?php echo $post->getDate() ?>
<span style="float: right">
	<span class="tag">Tagg</span>
	<span class="tag">Tagg</span>
	<span class="tag">Tagg</span>
	<span class="tag">Tagg</span>
</span>
</p>

	</div>
<?php endforeach?>
	</article>
