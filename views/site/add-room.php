<h2>Добавить помещение</h2>

<h3 class="message"><?= $message ?? ''; ?></h3>

<form method="post" class="form">
    <label>Номер помещения
        <input name="room_number" type="text">
    </label>
    <label>Тип помещения
        <input name="room_type" type="text">
    </label>

    <select name="division_id">
        <option value="">Без подразделения</option>
        <?php foreach ($divisions as $division): ?>
            <option value="<?= $division->id ?>">
                <?= htmlspecialchars($division->division_name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="form-button">Добавить</button>
</form>