<h2 class="log-title" >Регистрация</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post" class="log-form">
    <label><input type="text" name="name" placeholder="Имя"></label>
    <label><input type="text" name="login" placeholder="Логин"></label>
    <label><input type="password" name="password" placeholder="Пароль"></label>
    <button>Зарегистрироваться</button>
</form>
