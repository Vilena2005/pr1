<div class="main-layout">
    <a class="button-make" href="<?= app()->route->getUrl('/add-abonent') ?>">Создать</a>
    <div class="table">
        <div class="abonents-title">
            <div>
                <h2>Фамилия</h2>
                <p><?= app()->auth::user()->name ?></p>
            </div>
            <h2>Имя</h2>
            <h2>Отчество</h2>
            <h2>Дата рождения</h2>
            <h2>Подразделение</h2>
            <h2>Номер телефона</h2>
        </div>
    </div>
</div>

