<article class="content">
      <h1>Skriv inlägg</h1>
      <form action="/createPost" method="post">
<div class="field">
  <div class="control has-icons-left has-icons-right">
    <input class="input is-large" type="text" placeholder="Rubrik" name="rubrik">
    <span class="icon is-small is-left">
      <i class="fa fa-pencil"></i>
    </span>
  </div>
</div>
<div class="field">
  <div class="control has-icons-left has-icons-right">
      <textarea class="textarea" rows=15 name="text"></textarea>
      <span class="icon is-small is-left">
      <i class="fa fa-file-text"></i>
    </span>
  </div>
  <h3 class="">Kategori</h3>
  <label> Personligt:
  <input type="radio" value="1" name="cat" checked>
  </label>
  <label>
    Opersonligt:  
  <input type="radio" value="2" name="cat">
  </label>
  <h3>Taggar</h3>
  <div id="taginput" class="input tagarea"></div>

</div>
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
</div>
      </form>
</article>
<script type="text/javascript">
        var taggle = new Taggle('taginput', {
            placeholder: 'Skriv in en eller flera taggar separerade med kommatecken',
            allowDuplicates: true,
        });
</script>