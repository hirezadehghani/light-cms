<?php
require_once("./include/header.php");

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = htmlentities($_GET['entity']);
    $action = htmlentities($_GET['action']);
    $id = htmlentities($_GET['id']);
    if ($action == "delete") {
        switch ($entity) {
            case "post":
                $query = $db->prepare("DELETE FROM posts WHERE id = :id");
                break;
            case "comment":
                $query = $db->prepare("DELETE FROM comments WHERE id = :id");
                break;
            case "category":
                $query = $db->prepare("DELETE FROM categories WHERE id = :id");
                break;
        }
        $query->execute(['id' => $id]);
    } else {
        $query = $db->prepare("UPDATE comments SET status='1' WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}

$query_posts = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
$posts = $db->query($query_posts);

$query_comments = "SELECT * FROM comments WHERE status='0' ORDER BY id DESC LIMIT 3";
$comments = $db->query($query_comments);

$query_categories = "SELECT * FROM categories  ORDER BY id DESC LIMIT 3";
$categories = $db->query($query_categories);
?>

<div class="container-fluid">
                <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-10 col-12 m-0 p-0">
            <!-- <main role="main" class=""> -->

            <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h1 class="h2 m-0">داشبورد</h1>
            </div>
            <hr /> -->
            <h3 class="mt-2">مقالات اخیر</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان</th>
                            <th>نویسنده</th>
                            <th>تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($posts->rowCount() > 0) {
                            foreach ($posts as $post) {
                        ?>
                                <tr>
                                    <td><?php echo $post['id'] ?></td>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post['author'] ?></td>
                                    <td>
                                        <a href="edit_post.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-primary">ویرایش</a>
                                        <a href="index.php?entity=post&action=delete&id=<?php echo $post['id'] ?>" class="btn btn-outline-danger">حذف</a>
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

            <h3>نظرات اخیر</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان</th>
                            <th>نویسنده</th>
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
                                        <a href="index.php?entity=comment&action=approve&id=<?php echo $comment['id'] ?>" class="btn btn-outline-primary">در انتظار تایید</a>
                                        <a href="index.php?entity=comment&action=delete&id=<?php echo $comment['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-primary" role="start">
                                تمامی نظرات تایید شده اند!
                            </div>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>

            <h3>دسته بندی</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان</th>
                            <th>تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($categories->rowCount() > 0) {
                            foreach ($categories as $category) {
                        ?>
                                <tr>
                                    <td><?php echo $category['id'] ?></td>
                                    <td><?php echo $category['title'] ?></td>
                                    <td>
                                        <a href="edit_category.php?id=<?php echo $category['id'] ?>" class="btn btn-outline-primary">ویرایش</a>
                                        <a href="index.php?entity=category&action=delete&id=<?php echo $category['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger" role="start">
                                دسته ای برای نمایش نیست!
                            </div>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>

            <!-- </main> -->
        </div>

        <?php
        require_once("./include/footer.php");
        ?>