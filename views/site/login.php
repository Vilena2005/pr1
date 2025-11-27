<h2 class="log-title">Вход</h2>
<h3 class="message"><?= $message ?? ''; ?></h3>


<?php if (!app()->auth::check()): ?>
    <form method="post" class="log-form">

        <div class="add-item">
            <label>Логин</label>
            <input type="text" name="login" class="add-input-form" placeholder="Введите логин">
        </div>

        <?php if (!empty($errors['login'])): ?>
            <p class="error"><?= implode(', ', $errors['login']) ?></p>
        <?php endif; ?>

        <div class="add-item">
            <label>Пароль</label>
            <input type="password" name="password" class="add-input-form" placeholder="Введите пароль">
        </div>

        <button>Войти</button>
    </form>
<?php endif;
