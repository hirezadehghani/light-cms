<?php
require_once("./include/connect.php");

$query_categories = "SELECT * FROM categories ORDER BY id DESC";
$categories = $db->query($query_categories);

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = htmlentities($_GET['id']);
    $query = $db->prepare("DELETE FROM categories WHERE id = :id");
    $query->execute(['id' => $id]);

    header("Location:category.php");
    exit();
}
require_once("./include/header.php");
?>

<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-10 col-12 m-0 p-0">

            <div class="d-flex justify-content-between mt-3 ms-3">
                <h3 class="mt-2">دسته بندی ها</h3>
                <a href="new_category.php" class="btn btn-primary h-75">ایجاد دسته</a>
            </div>
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
                                        <a href="category.php?action=delete&id=<?php echo $category['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger" role="start">
                                در حال حاضر دسته ای وجود ندارد!
                            </div>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
            <?php
            require_once("./include/footer.php");
            ?>