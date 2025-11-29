<div class="main-layout">

<?php if (app()->auth::user()->isAdmin()): ?>
    <div class="admin-buttons">
        <a class="button-make" href="<?= app()->route->getUrl('/add-room') ?>">Создать</a>
        <a class="button-make" href="<?= app()->route->getUrl('/rooms-delete') ?>">Удалить</a>
    </div>
<?php endif; ?>

<div class="table">
    <div class="list-wrap">
        <?php if (empty($rooms)): ?>
            <p>Здесь пока ничего нет</p>
        <?php else: ?>
        <div class="list-items">
            <div class="list-item-title">
                <h3 class="main-title">Номер помещения</h3>
                <h3 class="main-title">Тип помещения</h3>
                <h3 class="main-title">Подразделение</h3>
            </div>
            <?php foreach ($rooms as $room): ?>
                <div class="list-item">
                    <p class="list"><?=($room->room_number) ?></p>
                    <p class="list"><?=($room->room_type) ?></p>
                    <p class="list"><?=($room->division->division_name ?? 'Без подразделения') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</div>

