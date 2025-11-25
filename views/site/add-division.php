<div class="main-layout">
    <h2>Добавить подразделение</h2>

    <p class="message"><?= $message ?? ''; ?></p>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" class="form">
        <label>Название подразделения
            <input type="text" name="division_name"></label>
        <label>Вид подразделения
            <input type="text" name="division_type"></label>

        <button class="form-button">Добавить</button>
    </form>

</div>