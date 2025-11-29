<div class="main-layout">
    <h2>Удаление абонентов</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (!empty($errors ?? [])): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (empty($abonents)): ?>
        <p>Абонентов для удаления нет</p>
        <a href="/abonent" class="button-back">← Назад к списку</a>
    <?php else: ?>
        <form method="POST" action="<?= app()->route->getUrl('/abonents/delete-selected') ?>">
            <div class="table">
                <div class="list-wrap">
                    <div class="list-items">

                        <div class="list-item-title">
                            <h3 class="main-title-checkbox">Выбрать</h3>
                            <h3 class="main-title-division-id">ID</h3>
                            <h3 class="main-title">Фамилия</h3>
                            <h3 class="main-title">Имя</h3>
                            <h3 class="main-title">Подразделение</h3>
                        </div>


                        <?php foreach ($abonents as $abonent): ?>
                            <div class="list-item">
                                <label class="checkbox-wrap">
                                    <input type="checkbox" name="ids[]" value="<?= $abonent->id ?>">
                                </label>
                                <p class="list-division-id"><?= $abonent->id ?></p>
                                <p class="list"><?= htmlspecialchars($abonent->surname) ?></p>
                                <p class="list"><?= htmlspecialchars($abonent->name) ?></p>
                                <p class="list"><?= htmlspecialchars($abonent->division->division_name ?? 'Без подразделения') ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="admin-buttons">
                <button type="submit" class="button-delete">Удалить выбранных</button>
                <a href="<?= app()->route->getUrl('/abonent') ?>">Назад к списку</a>
            </div>
        </form>
    <?php endif; ?>
</div>