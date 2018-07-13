<?php if(isset($tag)): ?>
    <article class="content is-medium">
        <h2 class="title is-1">Dina taggar</h2>
       <p> Klicka på en tagg för att ta bort den</p>
         <div class="tags">

 <?php
         foreach ($tag->getTags() as $key => $value){
         echo "<a href='/tags/delete/$key' class='tag is-dark'>$value</a>";
         }?>
                  
         </div>
     </article>
<?php endif; ?>
