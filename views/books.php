<div class="album text-muted">
    <div class="container">
        <div class="row">
            <?php if (isset($books) && !empty($books)): ?>
            <?php foreach($books as $book): ?>
                <div class="card">
                    <img src="http://placehold.it/356x258" alt="Alt text goes here">
                    <ul class="list-unstyled">
                        <li class="card-text"><a href="/book/<?php echo $book->getId() ?>"><strong>Title</strong>: <?php echo $book->getTitle() ?></a></li>
                        <li class="card-text"><strong>Author</strong>: <?php echo $book->getAuthor() ?></li>
                        <li class="card-text"><strong>In Stock</strong>: <?php echo $book->getStock() ?></li>
                    </ul>
                    <?php 
                        if ($book->getStock() === 0) {
                            $btn = '<button class="btn btn-lg btn-outline-secondary" disabled>Inte i lager</button>';
                        } else {
                            $btn = '<a href="/book/' . $book->getId() . '/borrow" class="btn btn-lg btn-success">Låna</a>';
                        }
                        echo $btn;
                    ?>
                </div>
            <?php endforeach ?>
            <?php else: ?>
                <section class="jumbotron text-center">
                    <div class="container">
                        <h1 class="jumbotron-heading">Hittade inga resultat :(</h1>
                        <p class="lead text-muted">Prova söka igen nedan.</p>
                        <form class="form-group" action="/books/search" method="post">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control" placeholder="Sök efter böcker (titel, författare, etc.)">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Sök!
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </section>
            <?php endif ?>
        </div>
    </div>
</div>