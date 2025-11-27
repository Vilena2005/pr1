<h2>Редактировать абонента</h2>

<p class="message"><?= $message ?? ''; ?></p>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>

<?php //if (!empty($message)): ?>
<!--    <div class="alert alert-success">--><?php //= htmlspecialchars($message) ?><!--</div>-->
<?php //endif; ?>

<!--<form method="POST" action="/edit-abonent/--><?php //= $abonent->id ?><!--">-->
<!--    <label>Фамилия</label>-->
<!--    <input type="text" name="surname" value="--><?php //= htmlspecialchars($abonent->surname ?? '') ?><!--" required>-->
<!---->
<!--    <label>Имя</label>-->
<!--    <input type="text" name="name" value="--><?php //= htmlspecialchars($abonent->name ?? '') ?><!--" required>-->
<!---->
<!--    <label>Отчество</label>-->
<!--    <input type="text" name="patronym" value="--><?php //= htmlspecialchars($abonent->patronym ?? '') ?><!--">-->
<!---->
<!--    <label>Дата рождения</label>-->
<!--    <input type="date" name="birth_date" value="--><?php //= htmlspecialchars($abonent->birth_date ?? '') ?><!--" required>-->
<!---->
<!--    <label>Телефон</label>-->
<!--    <input type="text" name="phone" value="--><?php //= htmlspecialchars($abonent->phone ?? '') ?><!--" required>-->
<!---->
<!--    <label>Подразделение</label>-->
<!--    <select name="division_id">-->
<!--        <option value="">Без подразделения</option>-->
<!--        --><?php //foreach ($divisions as $division): ?>
<!--            <option value="--><?php //= $division->id ?><!--" --><?php //= ($abonent->division_id == $division->id) ? 'selected' : '' ?><!-->-->
<!--                --><?php //= htmlspecialchars($division->division_name) ?>
<!--            </option>-->
<!--        --><?php //endforeach; ?>
<!--    </select>-->
<!---->
<!--    <button type="submit">Сохранить изменения</button>-->
<!--</form>-->

<form method="POST" action="/edit-abonent/<?= $abonent->id ?>/delete"
      onsubmit="return confirm('Удалить абонента?')">
    <button type="submit">Удалить абонента</button>
</form>
