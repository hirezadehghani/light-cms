<?php
require_once("./include/connect.php");


if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $category = $db->prepare("SELECT * FROM categories WHERE id = :id");
    $category->execute(['id' => $category_id]);
    $category = $category->fetch();
}

if (isset($_POST['edit_category'])) {
    if (trim($_POST['title']) != "") {

        $title = trim($_POST['title']);

        $query_categories = "SELECT * FROM categories";
        $categories2 = $db->query($query_categories);

        foreach ($categories2 as $category) {
            if ($title == $category['title'] && $category['id'] != $_GET['id']) {
                $title = "";
            }
        }
        if ($title != "") {
            $category_update = $db->prepare("UPDATE categories SET title =:title WHERE id = :id");
            $category_update->execute(['title' => $title, 'id' => $category_id]);
            header("Location:category.php");
            // echo '<script type="text/javascript"> window.location="category.php";</script>';
            exit();
        } else { ?>
            <div class="alert alert-danger" role="start">
                نام دسته تکراری است!
            </div><?php
                }
            }
        }
require_once("./include/header.php");
?>

<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-9 col-sm-auto col-lg-10">
            <h3 class="mt-2">ویرایش دسته</h3>

            <hr />

            <form method="post" class="mb-2">
                <div class="form-group">
                    <label for="category">عنوان</label>
                    <input type="text" class="form-control" name="title" id="category" value="<?php echo $category['title']; ?>" required>
                    <small class="form-text text-muted">نام دسته را وارد کنید.</small>
                </div>
                <button type="submit" name="edit_category" class="btn btn-primary">ویرایش</button>
            </form>


        </div>
    </div>
<?php
    require_once("./include/footer.php");
?>