<h2>Редактировать абонента</h2>

<p class="message"><?= $message ?? ''; ?></p>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>


<form method="POST" action="/edit-abonent/<?= $abonent->id ?>/delete"
      onsubmit="return confirm('Удалить абонента?')">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <button type="submit">Удалить абонента</button>
</form>
