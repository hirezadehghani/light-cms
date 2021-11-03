<?php
$query_slider = "SELECT * FROM posts_slider";
$posts_slider = $db->query($query_slider);
if ($posts_slider->rowCount() > 0) {

?>
    <div class="col-sm-4 col-12 d-none d-sm-block">

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            <?php } ?>
            <?php
            if ($posts_slider->rowCount() > 0) {
                foreach ($posts_slider as $post_slider) {
                    $id_post = $post_slider['post_id'];
                    $query_posts = "SELECT * FROM posts WHERE id = $id_post";
                    $post = $db->query($query_posts)->fetch();
            ?>
                    <div class="carousel-item card <?php echo ($post_slider['active']) ? "active" : ""; ?>">
                        <a class="text-decoration-none" href="single.php?post=<?php echo $post['id'] ?>">
                        <img height="200px" class="d-block w-100 card-img-top" src="./upload/posts/<?php echo $post['image'] ?>" alt="<?php echo $post['title'] ?>"></a>
                        <!-- <div class="carousel-caption d-none d-md-block"> -->
                        <div class="card-body">
                            <span class="badge bg-primary badge-post">اسلایدر</span>
                            <!-- </a> -->
                            <p class="card-text"><a class="text-decoration-none" href="single.php?post=<?php echo $post['id'] ?>"><?php if (strlen($post['title']) > 35)
                                                        echo substr($post['title'], 0, 30) . "..";
                                                    else
                                                        echo $post['title'];
                                                    ?> <i class="fas fa-external-link fa"></i></a></p>
                            <!-- </div> -->
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
        </div>
    </div>
<?php
            }
?>

<!--
?> -->