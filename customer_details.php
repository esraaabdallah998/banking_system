<?php
include "init.php";
include "partials/header.php";
$custom_id = $_GET['custom_id'];
$data = Customer::action()->get_by_id($custom_id);
?>
<div class="container mt-5" >
    <div class="row" style="height: 100vh;">
        <?php foreach ($data as $obj) { ?>
            <div class="col-4">
                <div class="card">
                    <img src="img/person.jpg" class="card-img-top img-fluid" alt="customer image">
                    <div class="card-body">
                        <p class="card-text text-center">
                        <div class="row">
                            <div class="col-12 text-center">
                                <strong><?= $obj->fullname ?></strong>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Details</h5>
                        <!-- <div class="card-text"> -->
                            <p class="card-text"><strong>full name:</strong><?= $obj->fullname ?></p>
                            <p class="card-text"><strong>email:</strong><?= $obj->email ?></p>
                            <p class="card-text"><strong>phone:</strong> <?= $obj->phone ?></p>
                            <p class="card-text"><strong>balance:</strong><span> $</span> <?= $obj->balance ?> </p>
                        <!-- </div> -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-backdrop="static" data-keyboard="false" class="btn btn-outline-brand ms-lg-3">transfer</a>
                        <?php include "transfer.php" ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include "partials/footer.php" ?>