<h2>Добавить помещение</h2>

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

<form method="post" class="form-wrap">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <div class="add-item">
        <label class="add-title">Номер помещения</label>
        <input name="room_number" type="text" class="add-input-form" placeholder="100A" required>
    </div>

    <div class="add-item">
        <label class="add-title">Тип помещения</label>
        <input name="room_type" type="text" class="add-input-form" placeholder="Лаборатория" required>
    </div>

    <select name="division_id" class="select-form">
        <option value="">Без подразделения</option>
        <?php foreach ($divisions as $division): ?>
            <option value="<?= $division->id ?>">
                <?= htmlspecialchars($division->division_name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="form-button">Добавить</button>
</form>