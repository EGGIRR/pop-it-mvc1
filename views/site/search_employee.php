<div class="search_employee_form">
    <form method="post">
        <fieldset>
            <pre><?= $message ?? ''; ?></pre>
            <h2>Поиск сотрудника</h2>
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>Имя <input type="text" name="employee[]"></label>
            <button>Поиск</button>
        </fieldset>
    </form>
    <h1>Список сотрудников</h1>
    <ol>
        <?php
        foreach ($employees as $employee) {
            echo '<p>Имя: ' . $employee->fname . '</p>';
            echo '<p>Фамилия: ' . $employee->lname . '</p>';
            echo '<p>Отчество: ' . $employee->patronymic . '</p>';
            echo '<p>Пол: ' . $employee->gender . '</p>';
            echo '<p>Дата рождения: ' . $employee->birthdate . '</p>';
            echo '<p>Адрес проживания: ' . $employee->address . '</p>';
            echo '<img style="width: 50px;" src="' . $employee->avatar . '" alt="Аватарка">';
            echo '<p>Должность: ' . $employee->post_id . '</p>';
            echo '<p>Отдел: ' . $employee->department_id . '</p>';
            echo '<p>Структура: ' . $employee->structure_id . '</p>';
            echo '<br><br><br>';
        }
        ?>
    </ol>
</div>
