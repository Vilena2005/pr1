<h2>Редактировать абонента</h2>

<p class="message"><?= $message ?? ''; ?></p>

<?php if (!empty($errors)): ?>
    <div class="errors-wrap">
        <ul class="errors">
            <?php foreach ($errors as $error): ?>
                <li class="error-item"><?= ($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" class="form-wrap" action="/abonents/edit/<?= $abonent->id ?>">
    <div class="add-item">
        <label class="add-title">Фамилия</label>
        <input name="surname" type="text" class="add-input-form" placeholder="Фамилия" value="<?= htmlspecialchars($abonent->surname ?? '') ?>" required>

    </div>

    <div class="add-item">
        <label class="add-title">Имя</label>
        <input name="name" type="text" class="add-input-form" placeholder="Имя" required>
    </div>

    <div class="add-item">
        <label class="add-title">Отчество</label>
        <input name="patronym" type="text" class="add-input-form" placeholder="Отчество">
    </div>

    <div class="add-item">
        <label class="add-title">Дата рождения</label>
        <input name="birth_date" type="date" class="add-input-form" required>
    </div>

    <div class="add-item">
        <label class="add-title">Телефон</label>
        <input name="phone" type="tel" class="add-input-form" placeholder="79008001100" required>
    </div>

    <select name="division_id" class="select-form">
        <option value="">Без подразделения</option>
        <?php foreach ($divisions as $division): ?>
            <option value="<?= $division->id ?>">
                <?= htmlspecialchars($division->division_name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="action" value="update">Редактировать</button>
    <button type="submit" name="action" value="delete" onclick="return confirm('Удалить этого абонента?')">Удалить</button>
</form>