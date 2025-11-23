<h2 class="log-title">Регистрация</h2>
<h3 class="message"><?= $message ?? ''; ?></h3>

<form method="post" class="log-form">
    <label><input type="text" name="name" placeholder="Имя"></label>
    <?php if (!empty($errors['name'])): ?>
        <p class="error"><?= implode(', ', $errors['name']) ?></p>
    <?php endif; ?>

    <label><input type="text" name="login" placeholder="Логин"></label>
    <?php if (!empty($errors['login'])): ?>
        <p class="error"><?= implode(', ', $errors['login']) ?></p>
    <?php endif; ?>

    <label><input type="password" name="password" placeholder="Пароль"></label>
    <?php if (!empty($errors['password'])): ?>
        <p class="error"><?= implode(', ', $errors['password']) ?></p>
    <?php endif; ?>
    <button>Зарегистрироваться</button>
</form>
