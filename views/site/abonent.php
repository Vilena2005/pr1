<div class="main-layout">

    <?php if (app()->auth::user()->isAdmin()): ?>
    <div class="admin-buttons">
        <a class="button-make" href="<?= app()->route->getUrl('/add-abonent') ?>">Создать</a>
        <a class="button-make" href="<?= app()->route->getUrl('/abonents-delete') ?>">Удалить</a>
    </div>

    <?php endif; ?>

    <div class="table">
        <?php if (empty($abonents)): ?>
            <p>Здесь пока нет абонентов</p>
        <?php else: ?>
        <div class="list-wrap">
                <div class="list-items">
                    <div class="list-item-title">
                        <h3 class="main-title-division-id">ID</h3>
                        <h3 class="main-title">Фамилия</h3>
                        <h3 class="main-title">Имя</h3>
                        <h3 class="main-title">Отчество</h3>
                        <h3 class="main-title">Дата рождения</h3>
                        <h3 class="main-title">Подразделение</h3>
                        <h3 class="main-title">Телефон</h3>
                    </div>
                    <?php foreach ($abonents as $abonent): ?>
                        <div class="list-item">
                            <p class="list-division-id"> <?=($abonent->id) ?></p>
                            <p class="list"><?=($abonent->surname) ?></p>
                            <p class="list"><?=($abonent->name) ?></p>
                            <p class="list"><?=($abonent->patronym) ?></p>
                            <p class="list"><?=($abonent->birth_date) ?></p>
                            <p class="list"><?=($abonent->division->division_name ?? 'Без подразделения') ?></p>
                            <p class="list"><?=($abonent->phone) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
        <?php endif; ?>

        </div>
    </div>
</div>

