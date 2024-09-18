<?php include_once __DIR__ . '/../header.php' ?>

<div class="profile-form">
    <h3>Персональные данные</h3>
    <div class="form-group">
        <label for="name">Имя профиля</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->getNickname()) ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email">Адрес электронной почты</label>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" readonly>
    </div>
    <div class="form-group">
        <label for="activation">Подтвержден ли аккаунт</label>
        <input type="text" id="activation" name="activation"
               value="<?= $user->getConfirmed() ? 'Да, аккаунт подтвержден' : 'Нет, проверьте свою почту для подтверждения аккаунта' ?>"
               readonly>
    </div>
    <br>
    <a style="width: 300px" href="#"
       class="btn btn-primary">Изменить пароль</a>
</div>

<?php include_once __DIR__ . '/../footer.php' ?>

