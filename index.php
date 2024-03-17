<?php
$errors = [
    'name' => null,
    'email' => null,
    'password' => null,
    ];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<h1>POST</h1>';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    if (empty($name)) {
        $errors['name'] = 'обов\'язкове поле';
    } elseif ((strlen($name) < 3 || (strlen($name) > 255))) {
        $errors['name'] = 'і\'мя не може бути менше 3 символів і більше 255 символів';
    }

    if (empty($email)) {
        $errors['email'] = 'обов\'язкове поле';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'емейл не відповідає формату';
    } elseif ((strlen($email) < 3 || (strlen($email) > 255))) {
        $errors['email'] = 'емейл не може бути менше 3 символів і більше 255 символів';
    }

    if (empty($password)) {
        $errors['password'] = 'обов\'язкове поле';
    } elseif (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
        $errors['password'] = 'пароль повинен містити принаймні 8 символів, літери та цифри';
    }

    if (empty($checkbox)) {
        $errors['checkbox'] = 'обов\'язкове поле';
    }
    
    if (empty(array_filter($errors))) {
        $name = $email = $password = $checkbox = $gender = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #787777;
    }
</style>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <div class="form-group">
                    <label for="name">Ім'я</label>
                    <input type="text" class="form-control" id="name" placeholder="Введіть ваше ім'я" name="name"
                           value="<?= $name ?>">
                    <div style="color: cornsilk"><?= $errors['name'] ?></div>
                </div>
                <div class="form-group">
                    <label for="email">Емейл</label>
                    <input type="text" class="form-control" id="email" placeholder="Введіть ваш емейл" name="email"
                           value="<?= $email ?>">
                    <div style="color: cornsilk"><?= $errors['email'] ?></div>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" placeholder="Введіть ваш пароль" name="password">
                    <div style="color: cornsilk"><?= $errors['password'] ?></div>
                </div>
                <div class="form-group">
                    <label for="country">Країна</label>
                    <select class="form-control" id="country" name="country">
                        <option <?php if(isset($_POST['country']) && $_POST['country'] == 'Україна') echo 'selected'; ?>>Україна</option>
                        <option <?php if(isset($_POST['country']) && $_POST['country'] == 'США') echo 'selected'; ?>>США</option>
                        <option <?php if(isset($_POST['country']) && $_POST['country'] == 'Канада') echo 'selected'; ?>>Канада</option>
                        <option <?php if(isset($_POST['country']) && $_POST['country'] == 'Великобританія') echo 'selected'; ?>>Великобританія</option>
                        <option <?php if(isset($_POST['country']) && $_POST['country'] == 'Інша') echo 'selected'; ?>>Інша</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Гендер</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($gender === 'male') echo 'checked'; ?>>
                        <label class="form-check-label" for="male">
                            Чоловіча
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($gender === 'female') echo 'checked'; ?>>
                        <label class="form-check-label" for="female">
                            Жіноча
                        </label>
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="agree" name="checkbox" <?php if($checkbox) echo 'checked'; ?>>
                    <label class="form-check-label" for="agree">Погоджуюсь з умовами сайту</label>
                    <div style="color: cornsilk"><?= $errors['checkbox'] ?></div>
                </div>
                <button type="submit" class="btn btn-primary">Зареєструватись</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>


