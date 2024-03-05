<div class="post_form">
    <form method="post">
        <fieldset>
            <pre><?= $message ?? ''; ?></pre>
            <h2>Добавление должности</h2>
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>Название <input type="text" name="name"></label>
            <button>Добавить</button>
        </fieldset>
    </form>
</div>
