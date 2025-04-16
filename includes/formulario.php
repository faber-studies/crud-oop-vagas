<main class="mt-3">

  <!-- Botão Voltar -->
  <section class="mb-4">
    <a href="index.php" class="btn btn-success">Voltar</a>
  </section>

  <!-- Título -->
  <h2 class="mb-4"><?= TITLE ?></h2>

  <!-- Formulário -->
  <form method="post">

    <!-- Título -->
    <div class="form-group mb-3">
      <label for="titulo">Título</label>
      <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $obVaga->titulo ?>">
    </div>

    <!-- Descrição -->
    <div class="form-group mb-3">
      <label for="descricao">Descrição</label>
      <textarea class="form-control" id="descricao" name="descricao" rows="5"><?= $obVaga->descricao ?></textarea>
    </div>

    <!-- Status -->
    <div class="form-group mb-4">
      <label>Status</label>
      <div>
        <div class="form-check form-check-inline">
          <input type="radio" class="form-check-input" name="ativo" id="ativo_sim" value="s" <?= $obVaga->ativo != 'n' ? 'checked' : '' ?>>
          <label class="form-check-label" for="ativo_sim">Ativo</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" class="form-check-input" name="ativo" id="ativo_nao" value="n" <?= $obVaga->ativo == 'n' ? 'checked' : '' ?>>
          <label class="form-check-label" for="ativo_nao">Inativo</label>
        </div>
      </div>
    </div>

    <!-- Botão -->
    <div class="form-group">
      <button type="submit" class="btn btn-success">Enviar</button>
    </div>

  </form>
</main>
