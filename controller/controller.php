<?php

include(__DIR__ . "/../model/model.php");
session_start();

if (!isset($_SESSION['employeelist'])) {
    $_SESSION['employeelist'] = array();
}
if (!isset($_SESSION['officelist'])) {
    $_SESSION['officelist'] = array();
}
if (!isset($_SESSION['relationlist'])) {
    $_SESSION['relationlist'] = array();
}


function createEmployee(){
    $employee = new Model_Employee();
    $employee->nama = $_POST['inputNama'];
    $employee->jabatan = $_POST['inputJabatan'];
    $employee->usia = $_POST['inputUsia'];
    array_push($_SESSION['employeelist'], $employee);
}

function deleteEmployee($employeeIndex){
    unset($_SESSION['employeelist'][$employeeIndex]);
    foreach ($_SESSION['relationlist'] as $relationIndex => $relation) {
        if ($relation->employeeIndex == $employeeIndex) {
            unset($_SESSION['relationlist'][$relationIndex]);
        }
    }
}

function getAllEmployee(){
    return $_SESSION['employeelist'];
}

function createOffice(){
    $office = new Model_Office();
    $office->namaKantor = $_POST['inputNamaKantor'];
    $office->alamat = $_POST['inputAlamat'];
    $office->kota = $_POST['inputKota'];
    $office->telepon = $_POST['inputTelepon'];
    array_push($_SESSION['officelist'], $office);
}

function deleteOffice($officeIndex){
    unset($_SESSION['officelist'][$officeIndex]);
    foreach ($_SESSION['relationlist'] as $relationIndex => $relation) {
        if ($relation->officeIndex == $officeIndex) {
            unset($_SESSION['relationlist'][$relationIndex]);
        }
    }
}

function getAllOffice(){
    return $_SESSION['officelist'];
}


function createRelation(){
    $relation = new Model_OfficeEmployee();
    $relation->employeeIndex = $_POST['inputEmployee'];
    $relation->officeIndex = $_POST['inputOffice'];
    array_push($_SESSION['relationlist'], $relation);
}

function deleteRelation($relationIndex){
    unset($_SESSION['relationlist'][$relationIndex]);
}

function getAllRelation(){
    return $_SESSION['relationlist'];
}

if (isset($_POST['button_submit'])){
    createEmployee();
    header("Location: ../view/viewEmployee.php");
    exit;
}

if (isset($_POST['button_submit_office'])){
    createOffice();
    header("Location: ../view/viewOffice.php");
    exit;
}

if (isset($_POST['button_submit_relation'])){
    createRelation();
    header("Location: ../view/viewRelation.php");
    exit;
}

if (isset($_GET['deleteID'])){
    deleteEmployee($_GET['deleteID']);
    header("Location: ../view/viewEmployee.php");
    exit;
}

if (isset($_GET['deleteOfficeID'])){
    deleteOffice($_GET['deleteOfficeID']);
    header("Location: ../view/viewOffice.php");
    exit;
}

if (isset($_GET['deleteRelationID'])){
    deleteRelation($_GET['deleteRelationID']);
    header("Location: ../view/viewRelation.php");
    exit;
}
?>
