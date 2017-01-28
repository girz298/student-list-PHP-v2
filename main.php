<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'libs/functions.php';
require_once 'vendor/autoload.php';

use model\Student;

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    Student::dropTable();
    header("Location: /");
    die();
}
$action = '';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}

function testing()
{
    $firstStudent = Student::create(
        [
            'first_name' => 'Evgeniy',
            'surname' => 'Nikitin',
            'group_id' => '321',
            'score' => '400',
            'email' => 'nikitin@gmail.com'
        ]
    );

    $secondStudent = Student::create(
        [
            'first_name' => 'Sergey',
            'surname' => 'Rodionov',
            'group_id' => '321702',
            'score' => '270',
            'email' => 'girz298@gmail.com'
        ]
    );

    $secondStudent
        ->setName('Jora')
        ->setSurname('Kipuatok')
        ->update();

    $firstStudent
        ->setName('Robert')
        ->setScore('25')
        ->update();

    $studentJora = Student::getFirstByScore('25');
    var_dump($studentJora);
    echo $studentJora->getName();
}

switch ($action) {
    case 'add':
        if (count($_POST) === 6 && each_true($_POST, function ($arr, $key, $value) {
                return $value !== '' ? true : false;
            })
        ) {
            $student = Student::create(
                [
                    'first_name' => $_POST['name'],
                    'surname' => $_POST['surname'],
                    'group_id' => $_POST['group'],
                    'score' => $_POST['score'],
                    'email' => $_POST['email']
                ]
            );
            if ($student !== 0) {
                header('Location: /');
                die();
            }
        } else {
            echo 'Bad Request!';
        }
        break;
    case 'remove':
        if (isset($_GET['id'])) {
            $student = Student::getById($_GET['id']);
            if ($student) {
                $student->remove();
                header('Location: /');
            }
        }
}

$students = Student::getAll();