<?php
require_once("./include/connect.php");
if (isset($_GET['post'])) {
    $post_id = htmlentities($_GET['post']);

    $post = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $post->execute(['id' => $post_id]);
    $post = $post->fetch();
}
if (isset($_POST['post_comment']) && !empty($_POST['name']) && !empty($_POST['comment'])) {
    if (!trim($_POST['comment']) == "") {
        $name = htmlentities($_POST['name']);
        $comment = htmlentities($_POST['comment']);
        if (isset($_POST['comment'])) {
            $comment_insert = $db->prepare("INSERT INTO comments (name, comment, post_id) VALUES (:name, :comment, :post_id)");
            $comment_insert->execute(['name' => $name, 'comment' => $comment, 'post_id' => $post_id]);
            header("Location:single.php?post=$post_id#comment");
            exit();
        }
    } else {
?>
        <script>
            alert("ببخشید فرم نظرات نمی تونه خالی باشه !!");
        </script>
<?php
    }
}
require_once("./include/header.php");
?>
<div class="col-md-9 col-12">
    <?php if ($post) {
        $category_id = $post['category_id'];
        $query_post_category = "SELECT * FROM categories WHERE id=$category_id";
        $post_category = $db->query($query_post_category)->fetch();
        $post_id = $post['id'];

        $comments = $db->prepare(" SELECT * FROM comments WHERE post_id=:id AND status='1' ");
        $comments->execute(['id' => $post_id]);
    ?>
        <article>
            <header>
            <i class="fas fa-file-text-o fa fa-3x ms-2"></i><h1 class="d-inline"><?php echo $post['title'] ?></h1>
                 <div id="img_post">
                 <img src="./upload/posts/<?php echo $post['image'] ?>" alt="<?php echo $post['title'] ?>" width="100%" height="75%" class="rounded"></div>
                <!-- <div class="byline">
                <time pubdate datetime="2011-08-28" title="August 28th, 2011">8/28/11</time>
            </div> -->
            </header>

            <div class="ck-content article-content text-justify">
                <?php echo $post['body'] ?>
            </div>
            <address class="author">
                <img src="./img/me.jpg" alt="">
                <i class="fas fa-pen fa"></i> <a rel="author" href="/author/<?php echo $post['author'] ?>" class="text-decoration-none"><?php echo $post['author'] ?></a>
            </address>
            <span class="badge bg-primary"><i class="fas fa-hashtag fa"></i>  <?php echo $post_category['title'] ?></span>
        </article>
</div>
<section>
    <div id="comment">
        <div class="d-flex justify-content-center row">
            <div class="col-md-3"></div>
            <div class="col-md-9 col-12">
                <h4 class="text-center"><i class="fas fa-comments fa"></i> نقطه نظرات شما</h4>
                <div class="d-flex flex-column comment-section">
                    <?php
                    if ($comments->rowCount() > 0) {
                        foreach ($comments as $comment) {
                    ?>
                            <div class="bg-white p-2">
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="./img/user.png" width="40">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name"><?php echo $comment['name'] ?></span><span class="date text-black-50">انتشار عمومی</span></div>
                                </div>
                                <div class="mt-2">
                                    <p class="m-0"><?php echo $comment['comment'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white">
                                <div class="d-flex flex-row fs-12">
                                    <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">دوست داشتم</span></div>
                                    <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span class="ml-1">پاسخ</span></div>
                                    <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">اشتراک گذاری</span></div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="bg-light p-2">
                        <form method="post" onsubmit="validation('comment')">
                            <div class="form-group">
                                <textarea required pattern=".*\S.*" name="comment" class="form-control ml-1 shadow-none textarea" placeholder="نظرتان را در این قسمت می توانید بنویسید"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="d-flex flex-row align-items-start mt-2"><img class="rounded-circle" src="./img/user.png" width="40">
                                    <!-- <label for="name">نام</label> -->
                                    <input type="name" name="name" required pattern=".*\S.*" placeholder="لطفا نام تان را بنویسید">
                                </div>
                            </div>
                            <div class="mt-2 text-right"><button name="post_comment" class="btn btn-primary btn-sm shadow-none" type="submit"><i class="fas fa-send-o fa"></i>  بفرست</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    } else {
?>
    <div class="alert alert-primary" role="start">
        ببخشید! مثل اینکه پست مدنظرت پیدا نشد. می تونی از بخش جستجو سایت استفاده کنی :)
    </div>
<?php } ?>
</div>
</div>
<!-- NIGHTMODE -->
<script src="./lib/jquery/jquery-3.6.0.min.js"></script>
<script src="./lib/bootstrap-5.0.0-beta3/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<!-- NIGHT MODE -->
</body>

</html>