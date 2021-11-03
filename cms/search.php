<?php
require_once("./include/header.php");
if (isset($_GET['search'])) {
    $keyword = htmlentities($_GET['search']);
    $posts = $db->prepare('SELECT * FROM posts WHERE title LIKE :keyword OR body LIKE :keyword');
    $posts->execute(['keyword' => "%$keyword%"]);
}
?>
<div class="col-md-9 col-12">
    <div class="row d-flex">

        <!-- POSTS -->
        <?php
        if ($posts->rowCount() > 0) {
        ?>
            <div class="col-md-12">
                <div class="alert alert-primary" role="alert">
                    پست های مرتبط با کلمه [<?php $keyw =  htmlentities($_GET['search']);
                                            echo $keyw ?>]
                </div>
            </div>
        <?php } ?>
        <?php
        if ($posts->rowCount() > 0) {
            foreach ($posts as $post) {
                $category_id = $post['category_id'];
                $query_post_category = "SELECT * FROM categories WHERE id = $category_id";
                $post_category = $db->query($query_post_category)->fetch();
        ?>
                <div class="col-sm-4 col-6">
                    <article>
                        <a class="text-decoration-none" href="single.php?post=<?php echo $post['id'] ?>">
                            <div class="card">
                                <img class="card-img-top" src="./upload/posts/<?php echo $post['image'] ?>" alt="<?php echo $post['title'] ?>">
                        </a>
                        <div class="card-body">
                            <p class="card-text">
                                <a href="index.php?category=<?php echo $post_category['title'] ?>">
                                    <span class="badge bg-primary badge-post"><?php echo $post_category['title'] ?></span></a>
                                <a class="text-decoration-none" href="single.php?post=<?php echo $post['id'] ?>">
                                    <?php echo $post['title'] ?> </a>
                            </p>
                        </div>
                </div>
                </article>
    </div>
<?php
            }
        } else {
?>
<section>
    <div class="col">
        <div class="alert alert-danger">
            ببخشید هیچ پستی مرتبط با کلمه جستجو شده [<?php echo htmlentities($_GET['search']) ?>] پیدا نشد!
        </div>
    </div>
</section>
<?php
        }
?>
<!-- POSTS -->

</div>
</div>
<?php
require_once("./include/footer.php");
?>