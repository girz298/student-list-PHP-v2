<body>
<div class="container-fluid">
<div class="row" style="height: 20px"></div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php
        if ($action !== 'edit') {
            require_once('forms/add_student_form.php');
        } else {
            require_once('forms/edit_student_form.php');
        }
        ?>
        <a href="?action=delete" class="btn btn-danger btn-block">
            <b>
                Delete all records
            </b>
        </a>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row" style="height: 20px"></div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <table class="table table-striped" style="text-align: center">
            <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">Name</th>
                <th style="text-align: center">Surname</th>
                <th style="text-align: center">Group</th>
                <th style="text-align: center">Score</th>
                <th style="text-align: center">Email</th>
                <th style="text-align: center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td><?= $student->getId() ?></td>
                    <td><?= $student->getName() ?></td>
                    <td><?= $student->getSurname() ?></td>
                    <td><?= $student->getGroup() ?></td>
                    <td><?= $student->getScore() ?></td>
                    <td><?= $student->getEmail() ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="/?action=edit&id=<?=$student->getId();?>" class="btn btn-success" >
                                <span class="glyphicon glyphicon-pencil" ></span>
                            </a>
                            <a href="/?action=remove&id=<?=$student->getId();?>" class="btn btn-danger" >
                                <span class="glyphicon glyphicon-remove" ></span>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
    <div class="col-md-3"></div>
</div>
</div>
</body>