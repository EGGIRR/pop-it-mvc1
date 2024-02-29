<div class="employee_form">
    <form method="post">
        <fieldset>
            <h2>Добавление сотрудника</h2>
            <label>Имя <input type="text" name="fname"></label>
            <label>Фамилия <input type="text" name="lname"></label>
            <label>Отчество <input type="text" name="patronymic"></label>
            <label>Пол
                <select name="gender">
                    <option value="0">Женщина</option>
                    <option value="1">Мужчина</option>
                </select>
            </label>
            <label>Дата рождения <input type="date" name="birthdate"></label>
            <label>Адрес прописки <input type="text" name="address"></label>
            <label>Должность
                <select name="post_id">
                    <?php foreach($posts as $post)
                    {
                        ?>
                        <option value="<?php echo $post->id; ?>"><?php echo $post->name; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Отдел
                <select name="department_id">
                    <?php foreach($departments as $department)
                    {
                        ?>
                        <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Структура
                <select name="structure_id">
                    <?php foreach($structures as $structure)
                    {
                        ?>
                        <option value="<?php echo $structure->id; ?>"><?php echo $structure->name; ?></option>
                    <?php } ?>
                </select>
            </label>
            <button>Добавить</button>
        </fieldset>
    </form>
</div>
