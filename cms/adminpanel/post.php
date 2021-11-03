<?php
require_once("./include/connect.php");

$query_posts = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db->query($query_posts);

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = htmlentities($_GET['id']);
    $query = $db->prepare("DELETE FROM posts WHERE id = :id");
    $query->execute(['id' => $id]);

    header("Location:post.php");
    exit();
}
require_once("./include/header.php");
?>

<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-9 col-sm-auto col-lg-10">

            <div class="d-flex justify-content-between mt-3 ms-3">
                <h3 class="mt-2">مقالات</h3>
                <a href="new_post.php" class="btn btn-primary h-75">ایجاد مقاله</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان</th>
                            <th>دسته</th>
                            <th>نویسنده</th>
                            <th>تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($posts->rowCount() > 0) {
                            foreach ($posts as $post) {
                $category_id = $post['category_id'];
                $query_post_category = "SELECT * FROM categories WHERE id = $category_id";
                $post_category = $db->query($query_post_category)->fetch();
                        ?>
                                <tr>
                                    <td><?php echo $post['id'] ?></td>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post_category['title'] ?></td>
                                    <td><?php echo $post['author'] ?></td>
                                    <td>
                                        <a href="edit_post.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-primary">ویرایش</a>
                                        <a href="post.php?entity=post&action=delete&id=<?php echo $post['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger" role="start">
                                در حال حاضر هیچ پستی وجود ندارد!
                            </div>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
            <?php
        require_once("./include/footer.php");
        ?>