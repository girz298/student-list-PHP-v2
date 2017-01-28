<?php

require_once('objects/base/Database/Database.php');
require_once('objects/base/ActiveRecordBase/ActiveRecordBase.php');
require_once('objects/model/Student.php');

Student::install();

echo 'Done!' . "\n";