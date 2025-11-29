<h2>Удаление абонентов</h2>

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

<?php if (empty($rooms)): ?>
    <p class="empty-text">Помещений для удаления нет</p>
<?php else: ?>
    <form method="POST" action="<?= app()->route->getUrl('/rooms/delete-selected') ?>">
        <div class="table">
            <div class="list-wrap">
                <div class="list-items">
                    <div class="list-item-title">
                        <h3 class="main-title-checkbox">Выбрать</h3>
                        <h3 class="main-title-division-id">ID</h3>
                        <h3 class="main-title">Номер помещения</h3>
                        <h3 class="main-title">Тип помещения</h3>
                        <h3 class="main-title">Подразделение</h3>
                    </div>

                    <?php foreach ($rooms as $room): ?>
                        <div class="list-item">
                            <label class="checkbox-wrap">
                                <input type="checkbox" name="ids[]" value="<?= $room->id ?>">
                            </label>
                            <p class="list-division-id"><?=($room->id) ?></p>
                            <p class="list"><?=($room->room_number) ?></p>
                            <p class="list"><?=($room->room_type) ?></p>
                            <p class="list"><?=($room->division->division_name ?? 'Без подразделения') ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="admin-buttons">
            <button type="submit" class="button-delete">Удалить выбранных</button>
            <a href="<?= app()->route->getUrl('/room') ?>">Назад к списку</a>
        </div>
    </form>
<?php endif; ?>
