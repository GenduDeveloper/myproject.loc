<?php include_once __DIR__ . '/../header.php' ?>

    <div class="profile-edit-form">
        <h2>Редактирование профиля</h2><br>

        <?php if (!empty($error)): ?>
            <div class="error-container">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php elseif (!empty($successfully)): ?>
            <div class="successfully-container">
                <?= htmlspecialchars($successfully) ?>
            </div>
        <?php endif; ?>

        <form action="/users/profile/edit/name" method="post">
            <div class="form-group">
                <label for="nickname">Текущее имя профиля</label>
                <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($user->getNickname()) ?>"
                       readonly>
            </div>
            <div class="form-group">
                <label for="new_nickname">Новое имя профиля</label>
                <input type="text" id="new_nickname" name="new_nickname"
                       value="<?= htmlspecialchars($_POST['new_nickname'] ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Изменить имя</button>
        </form>

        <br>

        <h3 style="text-align: center">Изменить пароль</h3><br>
        <form action="/users/profile/edit/password" method="post">
            <div class="form-group">
                <label for="password">Введите текущий пароль</label>
                <input type="password" id="password" name="password"
                       value="<?= $_POST['password'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="new_password">Новый пароль</label>
                <input type="password" id="new_password" name="new_password"
                       value="<?= $_POST['new_password'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="new_password_repeat">Повторите новый пароль</label>
                <input type="password" id="new_password_repeat" name="new_password_repeat"
                       value="<?= $_POST['new_password_repeat'] ?? '' ?>">
            </div>
            <button type="submit" class="btn btn-primary">Изменить пароль</button>
        </form>
    </div>

<?php include_once __DIR__ . '/../footer.php' ?>