<?php
require_once("./include/connect.php");

if (isset($_POST['add_category'])) {

    if (trim($_POST['title']) != "") {

        $title = trim($_POST['title']);

        $query_categories = "SELECT * FROM categories";
        $categories = $db->query($query_categories);

        foreach ($categories as $category) {
            if ($title == $category['title']) {
                $title = "";
            }
        }
        if ($title != "") {
            $category_insert = $db->prepare("INSERT INTO categories (title) VALUES (:title)");
            $category_insert->execute(['title' => $title]);
            header("Location:category.php");
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
            <h3 class="mt-2">ایجاد دسته</h3>

            <hr />

            <form method="post" class="mb-2">
                <div class="form-group">
                    <label for="category">عنوان</label>
                    <input type="text" class="form-control" name="title" id="category" required>
                    <small class="form-text text-muted">نام دسته را وارد کنید.</small>
                </div>
                <button type="submit" name="add_category" class="btn btn-primary">ویرایش</button>
            </form>


        </div>
    </div>
<?php
    require_once("./include/footer.php");
?>