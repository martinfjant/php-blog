<!-- <?php/*
    echo '<pre>';
        print_r($this->request->getPath());
    echo '</pre>';
    echo '<pre>';
        print_r($params);
    echo '</pre>';*/?> -->
<article class="content is-medium">
<?php foreach ($posts as $post): ?>
<div>
		<h2 class="title is-1">
			<a href="/post/<?php echo $post->getId() ?>">
			<?php echo $post->getTitle() ?>
			</a>
		</h2>
<p class="subtitle is-5 has-text-grey-lighter">
	Av: <i><?php echo $post->getAuthor() ?> </i>
	<?php echo $post->getDate() ?>
	<span class="tag">Tagg</span>
	<span class="tag">Tagg</span>
	<span class="tag">Tagg</span>
	<span class="tag">Tagg</span>
</p>

	</div>
<?php endforeach?>
	</article>
