<h2 class="log-title">Регистрация</h2>
<h3 class="message"><?= $message ?? ''; ?></h3>

<form method="post" class="log-form">
    <div class="add-item">
        <label>Логин</label>
        <input type="text" name="name" class="add-input-form" placeholder="Введите имя">
    </div>

    <?php if (!empty($errors['name'])): ?>
        <p class="error"><?= implode(', ', $errors['name']) ?></p>
    <?php endif; ?>

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

    <?php if (!empty($errors['password'])): ?>
        <p class="error"><?= implode(', ', $errors['password']) ?></p>
    <?php endif; ?>

    <button>Зарегистрироваться</button>
</form>
