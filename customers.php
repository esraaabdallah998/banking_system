<?php
include "init.php";
include "partials/header.php";
?>
<div class="container mt-5">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name </th>
                <th>Email</th>
                <th>Phone</th>
                <th>Blance</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = Customer::action()->get_all();
            $id = 0;
            foreach ($data as $obj) { ?>
                <tr>
                    <td>
                        <?= ++$id ?>
                    </td>
                    <td>
                        <?= $obj->fullname ?>
                    </td>
                    <td>
                        <?= $obj->email ?>
                    </td>
                    <td>
                        <?= $obj->phone ?>
                    </td>
                    <td>
                    <span> $ </span><?= $obj->balance ?> 
                    </td>
                    <td class="text-center">
                        <a href="customer_details.php?custom_id=<?=$obj->id?>" class="btn btn-outline-brand" title="transact">
                            <span>
                                Details <i class="fas fa-angle-double-right"></i>
                            </span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include "partials/footer.php"; ?>