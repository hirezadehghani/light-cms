<?php
    require_once("./include/connect.php");
    
    $query = "SELECT * FROM subscribers";
    $subs = $db->query($query);
    
    require_once("./include/header.php");
?>

<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-10 col-sm-auto col-lg-10">
        <div class="d-flex justify-content-between mt-3 ms-3">
            <h3 class="mt-2">اعضای خبرنامه</h3>
        </div>
        
         <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>ایمیل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($subs->rowCount() > 0) {
                            foreach ($subs as $sub) {
                        ?>
                                <tr>
                                    <td><?php echo $sub['id'] ?></td>
                                    <td><?php echo $sub['email'] ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger" role="start">
                                در حال حاضر هیچ نظری وجود ندارد!
                            </div>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
<?php
    require_once("./include/footer.php");
?>