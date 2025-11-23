<h2 class="log-title">Вход</h2>
<h3 class="message"><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>

<?php if (!app()->auth::check()): ?>
    <form method="post" class="log-form">
        <label><input type="text" name="login" placeholder="Логин"></label>
        <?php if (!empty($errors['login'])): ?>
            <p class="error"><?= implode(', ', $errors['login']) ?></p>
        <?php endif; ?>
        <label><input type="password" name="password" placeholder="Пароль"></label>

        <button>Войти</button>
    </form>
<?php endif;
