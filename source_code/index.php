<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");


$tp = new TampilPasien();

if(isset($_GET['action']))
{
    if($_GET['action'] == "hapus")
    {
        $tp->delete($_GET['id']);
    }
    elseif($_GET['action'] == "add")
    {
        $tp->form($_GET['id']);
    }
}
elseif(isset($_POST['action']))
{
    if($_POST['action'] == "addPasien")
    {
        $tp->addData($_POST['nik'], $_POST['nama'], $_POST['tempat'], $_POST['tl'], $_POST['gender'], $_POST['email'], $_POST['telp']);
    }
    elseif($_POST['action'] == "editPasien")
    {
        $tp->editData($_POST['id'], $_POST['nik'], $_POST['nama'], $_POST['tempat'], $_POST['tl'], $_POST['gender'], $_POST['email'], $_POST['telp']);
    }
}
else
{
    $tp->tampil();
}
