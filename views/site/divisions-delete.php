<h2>Удаление подразделений</h2>

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

<?php if (empty($divisions)): ?>
    <p class="empty-text">Подразделений для удаления нет</p>
<?php else: ?>
    <form method="POST" action="<?= app()->route->getUrl('/divisions/delete-selected') ?>">
        <div class="table">
            <div class="list-wrap">
                <div class="list-items">

                    <div class="list-item-title">
                        <h3 class="main-title-checkbox">Выбрать</h3>
                        <h3 class="main-title-division-id">ID</h3>
                        <h3 class="main-title">Вид подразделения</h3>
                        <h3 class="main-title">Название</h3>
                    </div>

                    <?php foreach ($divisions as $division): ?>
                        <div class="list-item">
                            <label class="checkbox-wrap">
                                <input type="checkbox" name="ids[]" value="<?= $division->id ?>">
                            </label>
                            <p class="list-division-id"><?= $division->id ?></p>
                            <p class="list-division"><?=($division->division_name) ?></p>
                            <p class="list-division"><?=($division->division_type) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="admin-buttons">
            <button type="submit" class="button-delete">Удалить выбранных</button>
            <a href="<?= app()->route->getUrl('/division') ?>">Назад к списку</a>
        </div>
    </form>
<?php endif; ?>
