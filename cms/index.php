<?php
require_once("./include/header.php");
?>
<?php
if (isset($_GET['category'])) {
    $categoryname = htmlentities($_GET['category']);
    $category = $db->prepare('SELECT id FROM categories WHERE title = :title');
    $category->execute(['title' => $categoryname]);
    $category = $category->fetch();

    $getcategory = $category['id'];
    $posts = $db->prepare('SELECT * FROM posts WHERE category_id = :category_id');
    $posts->execute(['category_id' => $getcategory]);
} else {
    $query_posts = "SELECT * FROM posts ORDER BY id DESC";
    $posts = $db->query($query_posts);
}
?>
<div class="col-md-9 col-12">
    <div class="row d-flex">
        <?php
        if (!isset($_GET['category'])) {
        ?>
            <!-- SLIDER -->
            <?php
            include("./include/slider.php");
            ?>
            <!-- SLIDER -->
        <?php }
        ?>
        <!-- POSTS -->
        <?php
        if ($posts->rowCount() > 0) {
            foreach ($posts as $post) {
                $category_id = $post['category_id'];
                $query_post_category = "SELECT * FROM categories WHERE id = $category_id";
                $post_category = $db->query($query_post_category)->fetch();
        ?>
                <div class="col-sm-4 col-6">
                    <article>
                            <div class="card">
                            <a class="text-decoration-none" href="single.php?post=<?php echo $post['id'] ?>">
                                <img class="card-img-top" height="180px" src="./upload/posts/<?php echo $post['image'] ?>" alt="<?php echo $post['title'] ?>">
                            </a>
                        <div class="card-body">
                            <p class="card-text">
                                <a href="index.php?category=<?php echo $post_category['title'] ?>">
                                    <span class="badge bg-primary badge-post">
                                    <i class="fas fa-hashtag fa"></i>    
                                    <?php echo $post_category['title'] ?></span></a>
                                <a class="text-decoration-none" href="single.php?post=<?php echo $post['id'] ?>">
                                <?php echo $post['title'];
                                                    ?> <i class="fas fa-external-link fa"></i></a>
                            </p>
                        </div>
                </div>
                </article>
    </div>
<?php
            }
        } 
        elseif (!isset($_GET['category'])) {}
        else {
?>
<section>
    <div class="col">
        <div class="alert alert-danger">
            متاسفیم؛ هیچ پستی وجود ندارد! لطفا از سایر بخش های سایت دیدن کنید یا در صورتی که به دنبال بخش خاصی هستید از قسمت جستجو استفاده کنید.
        </div>
    </div>
</section>
<?php
        }
?>
<!-- POSTS -->
</div>
</div>
</div>
<?php
require_once("./include/footer.php");
?>