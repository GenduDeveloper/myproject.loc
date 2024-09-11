<?php include_once __DIR__ . '/../header.php' ?>

<div class="register-form">
    <?php if (!empty($error)): ?>
        <div class="error-container">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <form action="/users/register" method="post">
        <div class="form-group">
            <label for="nickname">Имя профиля</label>
            <input type="text" class="form-control" placeholder="Имя профиля" id="nickname" name="nickname"
                   value="<?= $_POST['nickname'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="email">Адрес электронной почты</label>
            <input type="email" class="form-control" placeholder="Адрес электронной почты" id="email" name="email"
                   value="<?= $_POST['email'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" placeholder="Пароль" id="password" name="password"
                   value="<?= $_POST['password'] ?? '' ?>">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
        <p class="account-link">Уже есть аккаунт? <a href="#">Войти</a></p>
    </form>
</div>

<?php include_once __DIR__ . '/../footer.php' ?>
