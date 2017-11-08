<!-- <?php/*
    echo '<pre>';
        print_r($this->request->getPath());
    echo '</pre>';
    echo '<pre>';
        print_r($params);
    echo '</pre>';*/?> -->
		
<?php foreach ($posts as $post): ?>
        <article>
<h2><?php echo $post->getTitle() ?></h2>
<hr>
<h4>Av: <?php echo $post->getAuthor() ?>
	&nbsp;
	<?php echo $post->getDate() ?>
	<hr>
	
<?php echo $post->getContent() ?>
               
<?php endforeach?>
