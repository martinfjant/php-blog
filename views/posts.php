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
	 i <em><?php echo $post->getCat();?></em>
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
	<nav class="pagination" role="navigation" aria-label="pagination">
<a 	class="pagination-previous"
	 <?php if ($currentPage < 2):?> title="Detta är första sidan" disabled 
<?php else:?>
	 href="/posts/<?php echo $currentPage - 1?>"<?php endif;?>	
 >Föregående</a>
  <a class="pagination-next"
  <?php if ($currentPage == $lastPage):?> title="Detta är första sidan" disabled
<?php else:?>
  href="/posts/<?php echo $currentPage + 1?>"
<?php endif;?>>
  Nästa</a>
  <ul class="pagination-list">
  <?php for ($x = 1; $x <= $lastPageNum; $x++):?>

    <li>
<a 	class="pagination-link
	<?php if($x == $currentPage):?>is-current<?php endif;?>"
	href="/posts/<?php echo $x;?>">
	<?php echo $x;?></a>
	</li>
	<?php endfor;?>

  </ul>
</nav>
