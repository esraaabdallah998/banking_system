<?php 
include "init.php";
include "partials/header.php"; 
?>
<div class="container mt-5" style="height: 100vh;">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>transfer from </th>
                <th>transfer to</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $data = Transaction::action()->get_all();
            $id = 0;
            foreach ($data as $obj) { ?>
            <tr>
                <td><?= ++$id ?></td>
                <td><?= $obj->mailfrom ?></td>
                <td><?= $obj->mailto ?></td>
                <td><span>$ </span><?= $obj->trn_amount?></td>
                <td><?= $obj->trn_date?></td>
               
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<?php include "partials/footer.php"; ?>