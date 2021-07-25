<section>
    <h2 class="table_title">Города</h2>
    <table class="table">
        <thead class="bg-primary">
        <tr class="headers">
            <th scope="col">№</th>
            <th scope="col">Название</th>
            <th scope="col">Страна</th>
            <th scope="col">Регион</th>
            <th scope="col">Год основания</th>
            <th scope="col">Численность населения</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cities as $city): ?>
            <tr class="table_rows">
                <td>
                    <strong>
                        <?php echo $city["id"] ?>
                    </strong>
                </td>
                <td><?php echo $city["title"] ?></td>
                <td><?php echo $city["country"] ?></td>
                <td><?php echo $city["region"] ?></td>
                <td><?php echo $city["year_of_foundation"] ?></td>
                <td><?php echo $city["population"] ?> человек</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button id="addButton" class="btn btn-success" type="button" data-toggle="modal"
            data-target="#addWindow">Добавить
    </button>

    <div class="modal fade" id="addWindow" tabIndex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Добавление города</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Название:</label>
                            <input
                                    type="text"
                                    class="form-control border-dark"
                                    name="title"
                                    placeholder="Воронеж"
                            />
                            <?php if ($errors["title"]) {
                                echo "<div class='alert alert-danger' role='alert'>{$errors["title"]}</div>";
                            } else {
                                echo "";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="country" class="form-control-label">Страна:</label>
                            <input
                                    type="text"
                                    class="form-control border-dark"
                                    name="country"
                                    placeholder="Россия"
                            />
                            <?php if ($errors["country"]) {
                                echo "<div class='alert alert-danger' role='alert'>{$errors["country"]}</div>";
                            } else {
                                echo "";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="region" class="form-control-label">Регион:</label>
                            <input
                                    type="text"
                                    class="form-control border-dark"
                                    name="region"
                                    placeholder="Воронежская область"
                            />
                            <?php if ($errors["region"]) {
                                echo "<div class='alert alert-danger' role='alert'>{$errors["region"]}</div>";
                            } else {
                                echo "";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="year_of_foundation" class="form-control-label">Год основания:</label>
                            <input
                                    type="text"
                                    class="form-control border-dark"
                                    name="year_of_foundation"
                                    placeholder="1586"
                            />
                            <?php if ($errors["year_of_foundation"]) {
                                echo "<div class='alert alert-danger' role='alert'>{$errors["year_of_foundation"]}</div>";
                            } else {
                                echo "";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="population" class="form-control-label">Численность населения:</label>
                            <input
                                    type="text"
                                    class="form-control border-dark"
                                    name="population"
                                    placeholder="997447"
                            />
                            <?php if ($errors["population"]) {
                                echo "<div class='alert alert-danger' role='alert'>{$errors["population"]}</div>";
                            } else {
                                echo "";
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success mr-auto">Сохранить</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



