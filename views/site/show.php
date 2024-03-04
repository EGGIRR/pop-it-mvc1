<div class="show_buttons">
    <button><a href="<?= app()->route->getUrl('/employee_show') ?>">Просмотр списка сотрудников по отделам</a></button>
    <button><a href="<?= app()->route->getUrl('/employee_structure') ?>">Просмотр списка сотрудников по составу</a></button>
    <button><a href="<?= app()->route->getUrl('/search_employee') ?>">Поиск сотрудника по имени</a></button>
</div>