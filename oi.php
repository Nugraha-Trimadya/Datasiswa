<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>DataSiswa</title>
    <style>
        a {
            text-decoration: none;
            color: white;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container card mt-5 col-md-5 text-center no-print">
        <div class="card-body">
            <h1>DATA SISWA</h1>
            <form action="" method="POST" class="row d-flex align-items-center">
                <div class="mb-3">
                    <label for="nama" class="form-label d-flex">Nama Siswa</label>
                    <input type="text" id="nama" placeholder="masukan nama siswa" name="nama" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nis" class="form-label d-flex">NIS Siswa</label>
                    <input type="number" id="nis" placeholder="masukan nis siswa" name="nis" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="rayon" class="form-label d-flex">Rayon</label>
                    <input type="text" id="rayon" placeholder="masukan rayon siswa" name="rayon" class="form-control">
                </div>
                <div class="col mt-3">
                    <button class="btn btn-success" type="submit" name="kirim">
                        <i class='bx bx-plus'></i> Tambah
                    </button>
                    <button class="btn btn-primary" type="button" onclick="window.print()">
                        Print
                    </button>
                    <button class="btn btn-secondary" type="submit" name="reset">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    

    <!-- Table Output -->
    <div class="container print-section mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 col-md-12 m-auto">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>NIS Siswa</th>
                            <th>Rayon</th>
                            <th class="no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        session_start();

                        // jika belum ada session dataSiswa, buat session dataSiswa sebagai array kosong
                        if (!isset($_SESSION['dataSiswa'])) {
                            $_SESSION['dataSiswa'] = array();
                        }

                        if (isset($_POST["kirim"])) {
                            if ($_POST['nama'] == "" || $_POST['nis'] == "" || $_POST['rayon'] == "") {
                                echo "data kosong <br>";
                            } else {
                                $siswa = array(
                                    "nama" => $_POST['nama'],
                                    "nis" => $_POST['nis'],
                                    "rayon" => $_POST['rayon']
                                );
                                $sama = false;
                                foreach($_SESSION['dataSiswa'] as $ds){
                                    if($ds['nama'] == $siswa['nama'] && $ds['nis'] == $siswa['nis'] && $ds['rayon'] == $siswa['rayon']){
                                        $sama = true;
                                        break;
                                    }
                                   }
                                   if ($sama) {
                                    echo "Data ini sudah ada, tulis data lain";
                                } else {
                                    array_push($_SESSION['dataSiswa'], $siswa);
                                     }
                                 }
                            }
                        

                        if (isset($_POST["reset"])) {
                            unset($_SESSION['dataSiswa']);

                            header('location: ' . $_SERVER['PHP_SELF']);
                            exit;
                        }

                        if (!empty($_SESSION['dataSiswa'])) {
                            foreach ($_SESSION['dataSiswa'] as $key => $value) {
                                echo "<tr>";
                                echo "<td>" . $value["nama"] . "</td>";
                                echo "<td>" . $value["nis"] . "</td>";
                                echo "<td>" . $value["rayon"] . "</td>";
                                echo "<td class='no-print'><a href='?hapus=" . $key . "' class=\"btn btn-danger\">Hapus</a>
                                <a href='?edit=" . $key . "' class=\"btn btn-primary name='edit'\">edit</a></td>";
                                echo "</tr>";
                            }
                        }

                        if (isset($_GET['hapus'])) {
                            $key = $_GET['hapus'];
                            unset($_SESSION['dataSiswa'][$key]);

                            header('location: ' . $_SERVER['PHP_SELF']);
                            exit;
                        }

                        if (isset($_GET['edit'])) {
                            $key = $_GET['edit'];
                            $_POST['edit-nama'] = $_SESSION['dataSiswa'][$key]['nama'];
                            $_POST['edit-nis'] = $_SESSION['dataSiswa'][$key]['nis'];
                            $_POST['edit-rayon'] = $_SESSION['dataSiswa'][$key]['rayon'];

                            header('Location: edit.php' . $_SERVER['PHP_SELF']);
                            exit;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
