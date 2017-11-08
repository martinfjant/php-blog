<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong> <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Välkommen till Bookstore</h1>
        <p class="lead text-muted">Här skriver vi någon beskrivande text om innehållet nedan så att användaren känner för att använda webbsidan.</p>
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