<div class="main-layout">

    <?php if (app()->auth::user()->isAdmin()): ?>
        <div class="admin-buttons">
            <a class="button-make" href="<?= app()->route->getUrl('/add-division') ?>">Создать</a>
        </div>
    <?php endif; ?>

    <div class="table">
        <div class="list-wrap">
            <?php if (empty($divisions)): ?>
                <p>Здесь пока ничего нет</p>
            <?php else: ?>
            <div class="list-items">
                <div class="list-item-title">
                    <h3 class="main-title-division-id">ID</h3>
                    <h3 class="main-title-division">Вид подразделения</h3>
                    <h3 class="main-title-division">Название</h3>
                </div>
                    <?php foreach ($divisions as $division): ?>
                        <div class="list-item">
                            <p class="list-division-id"><?=($division->id) ?></p>
                            <p class="list-division"><?=($division->division_name) ?></p>
                            <p class="list-division"><?=($division->division_type) ?></p>
                        </div>
                    <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>