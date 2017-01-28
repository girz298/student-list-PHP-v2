<form class="form-horizontal" method="post" action="<?=isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'/'?>">
    <input type="hidden" name="action" value="edit">

    <div class="form-group">
        <label class="control-label col-md-3" for="name">Name:</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="name" value="<?=$studentToEdit->getName()?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="surname">Surname:</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="surname" name="surname" value="<?=$studentToEdit->getSurname()?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="group">Group number:</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="group" name="group" value="<?=$studentToEdit->getGroup()?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="score">Score:</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="score" name="score" value="<?=$studentToEdit->getScore()?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="email">Email:</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email" name="email" value="<?=$studentToEdit->getEmail()?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <button type="submit" class="btn btn-default btn-block"><b>Submit</b></button>
        </div>
    </div>
</form>