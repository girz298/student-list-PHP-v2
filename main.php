<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'libs/functions.php';
require_once __DIR__ . '/vendor/autoload.php';

use model\Student;

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
        break;
    case 'delete':
        Student::dropTable();
        header("Location: /");
        die('Redirected to index');
        break;
    case 'edit':
        if (isset($_GET['id'])) {
            $studentToEdit = Student::getById($_GET['id']);
            if (!$studentToEdit) {
                break;
            }
            if (count($_POST) === 6 && each_true($_POST, function ($arr, $key, $value) {
                    return $value !== '' ? true : false;
                }))
            {
                $studentToEdit
                    ->setName($_POST['name'])
                    ->setSurname($_POST['surname'])
                    ->setScore($_POST['score'])
                    ->setGroup($_POST['group'])
                    ->setEmail($_POST['email'])
                    ->update();
                header("Location: /");
                die('Redirected to index');
                break;
            }
        }
        break;
}

$students = Student::getAll();