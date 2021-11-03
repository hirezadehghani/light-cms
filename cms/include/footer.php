<hr />
<footer>
    <div class="row">
        <div class="col-md-3 d-none d-sm-block">
            <!-- categories -->
            <?php
                    $category_order = $db->prepare('SELECT * FROM categories ORDER BY id DESC LIMIT 3');
                    $category_order->execute();
            ?>
            <section class="w-100 category flex-column row">
                <h6><i class="fas fa-tags fa"></i>
                    دسته بندی ها</h6>
                <ul class="list-group">
                    <?php
                    if ($category_order->rowCount() > 0) {
                        foreach ($category_order as $category) {
                    ?>
                            <li id="category_a" class="list-group-item d-flex justify-content-between align-items-center <?php echo (isset($_GET['category']) && $category['title'] == $_GET['category']) ? "active" : "" ?> ">
                                <a class="text-decoration-none" href="index.php?category=<?php echo $category['title'] ?> ">
                                <i class="fas fa-hashtag fa"></i>
                                    <?php echo $category['title']; ?>
                                </a>
                                <?php
                                $category_id = $category['id'];
                                $query = "SELECT COUNT(*) FROM posts WHERE category_id = $category_id";
                                $count_category = $db->query($query)->fetch();
                                ?>
                                <span class="badge bg-primary rounded-pill"><?php echo $count_category[0]; ?></span>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </section>
        </div>
        <!-- categories -->
        <div class=" col-md-6 col-12">
            <section class="newslater">
                <h6> <i class="fas fa-send-o fa color-f"></i>
                    خبرنامه</h6>
                <p>برای عضویت در خبرنامه ایمیل خود را وارد کنید</p>
                <?php

                // چک کردن ایمیل های تکراری
                if (isset($_POST['subscribe'])) {
                    $repeat = 1;
                    $email = htmlentities($_POST['email']);
                    if (empty($email)) {
                        echo "فیلد نباید خالی باشد";
                    } else {
                        $query = "SELECT * FROM subscribers";
                        $subscribers = $db->query($query);
                        if ($subscribers->rowCount() > 0) {
                            foreach ($subscribers as $subscriber) {
                                if ($email == $subscriber['email'])
                                    $repeat = 0;
                            }
                        }

                        if ($repeat == 0)
                            echo "ایمیل وارد شده تکراری است!";
                        if ($repeat) {
                            $subscribe_insert = $db->prepare("INSERT INTO subscribers (email) VALUE (:email)");
                            $subscribe_insert->execute(['email' => $email]);
                            echo "سپاسگزارم از همراهی شما؛ ایمیل شما ثبت شد.";
                        }
                    }
                }
                ?>
                <form method="POST">
                    <input type="email" name="email" placeholder="ایمیل بدون www ">
                    <button class="btn btn-primary btn-sm" type="submit" name="subscribe">
                    <i class="fas fa-link fa"></i>    
                    عضویت</button>
                </form>
            </section>
            <hr>
            <p class="text-center m-0"><i class="fas fa-copyright fa"></i>
                تمامی حقوق محفوظ می باشد.
                <i class="fas fa-pencil fa"></i> های رضا/> 2021 - <?php
                                                                    date_default_timezone_set('Asia/Tehran');
                                                                    echo date('Y'); ?>
            </p>
        </div>
        <div class=" col-md-3 col-12">
            <section class="text-center">
                <p class="mt-2">طراحی و توسعه داده شده توسط: رضا دهقانی با <i class="fas fa-heart fa"></i>
                </p>
                <hr>
                <p class="poweredcolor">&#128640; قدرت گرفته از سیستم مدیریت محتوای اختصاصی
                    <span><i class="fas fa-laptop fa"></i>
                        <i class="fas fa-mobile fa"></i>
                    </span>
                </p>
                <!-- <hr class="m-0"> -->
                <!-- <span>ستاد ساماندهی</span> -->
            </section>
        </div>
</div>
</footer>

</div>
<!-- JAVASCRIPTS -->
<script src="./lib/jquery/jquery-3.6.0.min.js"></script>
<script src="./lib/bootstrap-5.0.0-beta3/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<!-- JAVASCRIPTS -->
</body>

</html>