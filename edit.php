<?php
session_start();

if(isset($_POST['ubah'])){
    header("Location: oi.php");
    exit();
}

if(isset($_GET['edit'])){
    header("Location: oi.php");
    exit();
}



if (isset($_GET['edit'])) {
    if ($_POST["edit-nama"] != "" && $_POST["edit-nis"] != "" && $_POST['edit-rayon'] != "") {
        $_SESSION['dataSiswa'][$key] = array(
            "nama" => $_POST['nama'],
            "nis" => $_POST['nis'],
            "rayon" => $_POST['rayon']
        );
        header("Location: oi.php");
    } else {
        echo "
        <script>
            alert('Data gagal diubah');
            document.location.href = 'oi.php?key=$key';
        </script>
        ";
    }
}
if (isset($_GET['ubah'])) {
    $key = $_SESSION['edit_key'];
    $_SESSION['dataSiswa'][$key]['nama'] = $_POST['edit-nama'];
    $_SESSION['dataSiswa'][$key]['nis'] = $_POST['edit-nis'];
    $_SESSION['dataSiswa'][$key]['rayon'] = $_POST['edit-rayon'];
    unset($_SESSION['edit']);
    unset($_SESSION['edit_key']);
    header('Location: oi.php' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="container card mt-5 col-md-5 text-center no-print">
        <div class="card-body">
            <h1>DATA SISWA</h1>
            <form action="oi.php" method="GET" class="row d-flex align-items-center">
                <div class="mb-3">
                    <label for="nama" class="form-label d-flex">Nama Siswa</label>
                    <input type="text" id="nama" placeholder="masukan nama siswa" name="edit-nama" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nis" class="form-label d-flex">NIS Siswa</label>
                    <input type="number" id="nis" placeholder="masukan nis siswa" name="edit-nis" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="rayon" class="form-label d-flex">Rayon</label>
                    <input type="text" id="rayon" placeholder="masukan rayon siswa" name="edit-rayon" class="form-control">
                </div>
                <div class="col mt-3">
                    <button class="btn btn-success" type="submit" name="ubah">
                        Ubah
                    </button>
                </div>
            </form>
        </div>
</body>
</html>