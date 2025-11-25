<h2>Добавить подразделение</h2>

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
    <div class="add-item">
        <label class="add-title">Название подразделения</label>
        <input name="division_name" type="text" class="add-phone-input-form" placeholder="Сборочный цех" required>
    </div>

    <div class="add-item">
        <label class="add-title">Вид подразделения</label>
        <input name="division_type" type="text" class="add-phone-input-form" placeholder="Производственный отдел" required>
    </div>

    <button class="form-button">Добавить</button>
</form>
