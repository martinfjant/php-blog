<?php
    if (isset($books) && !empty($books)) {
        $uniqueBooks = array_unique($books, SORT_REGULAR);
        $isMyBooks ? $books = $uniqueBooks : $books = $books;
    }
?>

<div class="album text-muted">
    <div class="container">
        <div class="row">
            <?php if (isset($books) && !empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="card">
                    <img src="http://placehold.it/356x258" alt="Alt text goes here">
                    <ul class="list-unstyled">
                        <li class="card-text"><strong>Title</strong>: <?php echo $book->getTitle() ?></li>
                        <li class="card-text"><strong>Author</strong>: <?php echo $book->getAuthor() ?></li>
                        <li class="card-text"><strong>In Stock</strong>: <?php echo $book->getStock() ?></li>
                    </ul>
                    <form action="">
                    <?php 
                        if ($book->getStock() === 0) {
                            $btn = '<button class="btn btn-lg btn-outline-secondary" disabled>Inte i lager</button>';
                        } else {
                            $btn = '<a href="/book/' . $book->getId() . '/return" class="btn btn-lg btn-secondary">Lämna tillbaka</a>';
                        }
                        echo $btn;
                    ?>
                    </form>
                </div>
            <?php endforeach ?>
            <?php else: ?>
                <section class="jumbotron">
                    <div class="container">
                        <h3 class="text-center">Du har inga utlånade böcker, <?php echo $customer->getFullName(); ?></h3>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <p>För att låna böcker gå till listan över våra böcker.</p>
                                <a href="/books" class="btn btn-lg btn-primary">Visa böcker</a>
                            </div>
                        </div>
                        <hr />
                        <h4>Nedan hittar du din historik för utlånade böcker</h4>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Borrowed</th>
                                        <th>Returned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($returnedBooks as $book): ?>
                                        <tr>
                                            <td><?php echo $book->getTitle() ?></td>
                                            <td><?php echo $book->getAuthor() ?></td>
                                            <td><?php echo $book->getStartDate() ?></td>
                                            <td><?php echo $book->getEndDate() ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            <?php endif ?>
        </div>
    </div>
</div>