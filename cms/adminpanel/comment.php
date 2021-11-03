<?php
require_once("./include/connect.php");

$query_comments = "SELECT * FROM comments ORDER BY id DESC";
$comments = $db->query($query_comments);

if(isset($_GET['action']) && isset($_GET['id'])){
    $action = $_GET['action'];
    $id = $_GET['id'];
    if($action == "delete"){
        $comments_query = $db->prepare("DELETE FROM comments WHERE id = :id");
    }
    else{
        $comments_query = $db->prepare("UPDATE comments SET status = '1' WHERE id = :id");
    }
    $comments_query->execute(['id' => $id]);
    header("Location:comment.php");
    exit();
}
require_once("./include/header.php");

?>

<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-9 col-sm-auto col-lg-10">

            <div class="d-flex justify-content-between mt-3 ms-3">
                <h3 class="mt-2">نظرات</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>نام</th>
                            <th>کامنت</th>
                            <th>تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($comments->rowCount() > 0) {
                            foreach ($comments as $comment) {
                        ?>
                                <tr>
                                    <td><?php echo $comment['id'] ?></td>
                                    <td><?php echo $comment['name'] ?></td>
                                    <td><?php echo $comment['comment'] ?></td>
                                    <td>
                                    <?php
                                    if($comment['status']){ ?>
                                        <a href="#" class="btn btn-outline-primary" disabled>تایید شده</a>
                                        <?php }else{ ?>

                                        <a href="comment.php?action=approve&id=<?php echo $comment['id'] ?>" class="btn btn-outline-primary">در انتظار تایید</a>
                                    <?php } ?>
                                    <a href="comment.php?action=delete&id=<?php echo $comment['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
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
            <?php
            require_once("./include/footer.php");
            ?>