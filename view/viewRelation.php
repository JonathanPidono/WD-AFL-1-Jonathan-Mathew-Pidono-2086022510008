<?php require(__DIR__ . "/../controller/controller.php"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>AFL-1 - Office Employees</title>
</head>

<body>
<div class="container py-4">
    <div class="wrap card mx-auto">
        <div class="card-header p-0 border-0">
            <ul class="nav tabbar mb-0">
                <li class="nav-item"><a class="nav-link" href="viewEmployee.php">Employee</a></li>
                <li class="nav-item separator">|</li>
                <li class="nav-item"><a class="nav-link" href="viewOffice.php">Office</a></li>
                <li class="nav-item separator">|</li>
                <li class="nav-item"><a class="nav-link active" href="viewRelation.php">Office-Employees</a></li>
            </ul>
        </div>
        <div class="card-body">
            <h1 class="page-title">Office Employees</h1>

            <?php
            $allEmployee = getAllEmployee();
            $allOffice = getAllOffice();
            $allRelation = getAllRelation();
            ?>

            <div class="table-responsive">
            <table class="table light-table">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Office</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($allRelation)) { ?>
                        <tr><td colspan="2" class="empty-row">Belum ada relasi.</td></tr>
                    <?php } else {
                        foreach ($allRelation as $index => $relation) {
                            $employee = $allEmployee[$relation->employeeIndex] ?? null;
                            $office = $allOffice[$relation->officeIndex] ?? null;
                    ?>
                        <tr>
                            <td><?= $employee ? ($employee->nama) : '(deleted)' ?></td>
                            <td><?= $office ? ($office->namaKantor) : '(deleted)' ?></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>

            <?php if (empty($allEmployee) || empty($allOffice)): ?>
                <p class="text-muted-note text-center">Tambahkan minimal satu employee dan satu office dulu.</p>
            <?php else: ?>
                <form class="relation-form" method="POST" action="../controller/controller.php">
                    <div class="form-row">
                        <label for="inputEmployee">Employee</label>
                        <select id="inputEmployee" name="inputEmployee" class="form-select" required>
                            <?php foreach ($allEmployee as $index => $employee): ?>
                                <option value="<?= $index ?>"><?= ($employee->nama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="inputOffice">Office</label>
                        <select id="inputOffice" name="inputOffice" class="form-select" required>
                            <?php foreach ($allOffice as $index => $office): ?>
                                <option value="<?= $index ?>"><?= htmlspecialchars($office->namaKantor) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button name="button_submit_relation" type="submit" class="btn btn-save d-block mx-auto">SAVE</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
