<?php require(__DIR__ . "/../controller/controller.php"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>AFL-1 - Employee</title>
</head>

<body>
<div class="container py-4">
    <div class="wrap card mx-auto">
        <div class="card-header p-0 border-0">
            <ul class="nav tabbar mb-0">
                <li class="nav-item"><a class="nav-link active" href="viewEmployee.php">Employee</a></li>
                <li class="nav-item separator">|</li>
                <li class="nav-item"><a class="nav-link" href="viewOffice.php">Office</a></li>
                <li class="nav-item separator">|</li>
                <li class="nav-item"><a class="nav-link" href="viewRelation.php">Office-Employees</a></li>
            </ul>
        </div>
        <div class="card-body">
            <h2 class="section-title">List Karyawan</h2>
            <div class="table-responsive">
            <table class="table list-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Usia</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = -1;
                    $allEmployee = getAllEmployee();
                    if (empty($allEmployee)) {
                    ?>
                        <tr><td colspan="5" class="empty-row">Belum ada karyawan.</td></tr>
                    <?php
                    } else {
                        foreach ($allEmployee as $index => $employee) {
                            $counter++;
                    ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?=($employee->nama) ?></td>
                            <td><?=($employee->jabatan) ?></td>
                            <td><?=($employee->usia) ?></td>
                            <td>
                                <a class="delete-link" href="../controller/controller.php?deleteID=<?= $index ?>"
                                   onclick="return confirm('Hapus karyawan ini?')">Delete</a>
                            </td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>

            <h2 class="section-title">Tambah Karyawan</h2>
            <form class="plain-form" method="POST" action="../controller/controller.php">
                <div class="mb-3">
                    <label for="inputNama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Masukkan Nama" required>
                </div>
                <div class="mb-3">
                    <label for="inputJabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="inputJabatan" name="inputJabatan" placeholder="Masukkan Jabatan" required>
                </div>
                <div class="mb-3">
                    <label for="inputUsia" class="form-label">Usia</label>
                    <input type="number" class="form-control" id="inputUsia" name="inputUsia" placeholder="Masukkan Usia" required>
                </div>
                <button name="button_submit" type="submit" class="btn btn-primary d-block mx-auto px-4">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
