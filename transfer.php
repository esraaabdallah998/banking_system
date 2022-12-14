<?php
if (count($_POST) > 0) {
    $errors = Transaction::action()->create($_POST);
    if (!is_array($errors)) {
        header("Location:transactions.php");
        die;
    }
 }

?>
<!--Transaction Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-8">
                            <form class="p-lg-5 col-12 row g-3 myform" method="post">
                                <div>
                                    <h1>Transfer money</h1>
                                </div>
                                <div class="col-12">
                                    <label for="email1" class="form-label">From:</label>
                                    <input type="email" class="form-control" placeholder="Johndoe@example.com" name="email1" id="email1" aria-describedby="emailHelp" value="<?= isset($_POST['email1']) ? $_POST['email1'] : '' ?>">
                                    <small class="text-danger"> <?= $errors['from'][0] ?? '' ?></small>
                                </div>
                                <div class="col-12">
                                    <label for="email2" class="form-label">To:</label>
                                    <input type="email" class="form-control" placeholder="Johndoe@example.com" name="email2" id="email2" aria-describedby="emailHelp" value="<?= isset($_POST['email2']) ? $_POST['email2'] : '' ?>">
                                    <small class="text-danger"><?= $errors['to'][0] ?? '' ?></small>
                                </div>
                                <div class="col-8 mb-5">
                                    <label for="amount" class="form-label">Amount:</label>
                                    <input type="text" class="form-control" placeholder="$1" name="amount" id="amount" aria-describedby="emailHelp" value="<?= isset($_POST['amount']) ? $_POST['amount'] : '' ?>">
                                    <small class="text-danger"><?= $errors['amount'][0] ?? '' ?></small>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-secondary btn-default closefirstmodal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-brand transfer-submit">Transfer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Transaction Modal -->

<!-- Cancel Modal -->
<div class="modal fade" id="WarningModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                Are you Sure you Don't Want to complete the money transfer process !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary confirmclosed">Close</button>
            </div>
        </div>
    </div>
</div>