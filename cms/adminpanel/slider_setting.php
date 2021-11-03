<?php
require_once("./include/connect.php");

$posts_slider = "SELECT * FROM posts_slider ORDER BY id DESC";
$posts_slider = $db->query($posts_slider);
$posts = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db->query($posts);

if (isset($_POST['disable'])) {
    if ($_POST['disable'] == "on") {

        $del_slider = $db->prepare("DELETE FROM posts_slider");
        $del_slider->execute();
        header("Location:slider_setting.php");
        exit();
    }
}
if (isset($_POST['post_slider'])) {
    $post_id = $_POST['activepost'];

    $posts_slider_up = $db->prepare("UPDATE posts_slider SET active='0'");
    $posts_slider_up->execute();
    $has = 0;
    foreach ($posts_slider as $slide) {
        if ($post_id == $slide['post_id']) {
            $has = 1;
        }
    }
    if ($has == 1) {
        $posts_slider_up = $db->prepare("UPDATE posts_slider SET active='1' WHERE post_id = :post_id");
        $posts_slider_up->execute(['post_id' => $post_id]);
    } elseif ($has == 0) {
        $posts_slider_set = $db->prepare("INSERT INTO posts_slider (post_id, active) VALUES (:post_id, :active)");
        $posts_slider_set->execute(['post_id' => $post_id, 'active' => 1]);
    }
    header("Location:slider_setting.php");
    exit();
}
require_once("./include/header.php");
?>

<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-10 col-sm-auto col-lg-10">
            <h3 class="mt-2">تنظیمات اسلایدر</h3>
            <form method="post">
                <div class="form-group">
                    <label for="disable">غیرفعال کردن اسلایدر</label>
                    <input name="disable" type="checkbox" class="form-check-input">
                </div>
                <div class="form-group">
                    <label for="activepost">انتخاب آی دی پست به عنوان پست اول اسلایدر</label>
                    <select name="activepost" id="activepost">
                        <?php
                        if ($posts->rowCount() > 0) {
                            foreach ($posts as $post) {
                        ?>
                                <option value="<?php echo $post['id']; ?>"><?php echo $post['title']; ?></option>
                            <?php
                            }
                        } else { ?>
                            <option disabled>هیچ پستی در اسلایدر وجود ندارد</option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-success" name="post_slider" id="post_slider">ذخیره</button>
                </div>
            </form>
        </div>
        <?php
        require_once("./include/footer.php");
        ?>