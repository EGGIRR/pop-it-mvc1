<div class="department_form">
    <form method="post">
        <fieldset>
            <pre><?= $message ?? ''; ?></pre>
            <h2>Добавление отдела</h2>
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>Название <input type="text" name="name"></label>
            <label>Тип
                <select name="type">
                    <option value="Внутренний">Внутренний</option>
                    <option value="Обособленный">Обособленный</option>
                </select>
            </label>
            <button>Добавить</button>
        </fieldset>
    </form>
</div>
