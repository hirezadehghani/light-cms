<?php
require_once("./include/connect.php");

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $post = $db->prepare("SELECT * FROM posts WHERE id = :id");
    $post->execute(['id' => $post_id]);
    $post = $post->fetch();

    $query_categories = "SELECT * FROM categories";
    $categories = $db->query($query_categories);
}

if (isset($_POST['edit_post'])) {
    if (trim($_POST['title']) != "" && trim($_POST['author']) != "" && trim($_POST['category_id']) != "" && trim($_POST['body']) != "") {

        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $body = $_POST['body'];

        if (trim($_FILES['image']['name']) != "") {

            $name_image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            if (move_uploaded_file($tmp_name, "../upload/posts/$name_image")) {
                echo "عکس با موفقیت آپلود شد.";
            } else {
                echo "آپلود عکس با شکست مواجه شد!";
                echo $_FILES['image']['error'];
            }

            $post_update = $db->prepare("UPDATE posts SET title =:title , author =:author, category_id = :category_id, body =:body, image =:image WHERE id = :id");
            $post_update->execute(['title' => $title, 'author' => $author, 'category_id' => $category_id, 'body' => $body, 'image' => $name_image, 'id' => $post_id]);
        } else {
            $post_update = $db->prepare("UPDATE posts SET title =:title , author =:author, category_id = :category_id, body =:body WHERE id = :id");
            $post_update->execute(['title' => $title, 'author' => $author, 'category_id' => $category_id, 'body' => $body, 'id' => $post_id]);
        }
    }
    header("Location:post.php");
    exit();
    
}
require_once("./include/header.php");

?>
<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-9 col-sm-auto col-lg-10">
            <h3 class="mt-2">ویرایش مقاله</h3>

            <hr />

            <form method="post" class="mb-2" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $post['title']; ?>" required>
                    <small class="form-text text-muted">نام مقاله را وارد کنید.</small>
                </div>
                <div class="form-group">
                    <label for="author">نویسنده: </label>
                    <input type="text" class="form-control" name="author" id="author" value="<?php echo $post['author']; ?>" required>
                    <small class="form-text text-muted">نام مقاله را وارد کنید.</small>
                </div>
                <div class="form-group">
                    <label for="category_id">دسته بندی: </label>
                    <select name="category_id" id="category_id" class="form-control">
                        <?php
                        if ($categories->rowCount() > 0) {
                            foreach ($categories as $category) {
                        ?>

                                <option value="<?php echo $category['id'] ?>" <?php echo ($category['id'] == $post['category_id']) ? "selected" : "" ?>><?php echo $category['title'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="body">متن مقاله: </label>
                    <textarea name="body" id="body" class="form-control">
                    <?php echo $post['body'] ?>
                    </textarea>
                    <small class="form-text text-muted">متن مقاله را وارد کنید.</small>
                </div>
                <img src="../upload/posts/<?php echo $post['image'] ?>" alt="<?php echo $post['title'] ?>">
                <div class="form-group">
                    <label for="image">تصویر: </label>
                    <input type="file" class="form-control w-50" name="image" id="image">
                    <small class="form-text text-muted">تصویر مقاله را وارد کنید.</small>
                </div>
                <div class="form-group my-3">
                    <label for="post_slider"></label>
                    <input type="checkbox" class="form-check-input" name="post_slider" id="post_slider">
                    <small class="form-text text-muted">نمایش پست در اسلایدر</small>
                </div>
                <button type="submit" name="edit_post" class="btn btn-success">ویرایش</button>
            </form>


        </div>
    </div>
</div>
<script src="./js/script.js" type="text/javascript"></script>

<!-- CK EDITOR -->
<!-- CK EDITOR -->
<script src="./lib/jquery/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./plugin/ckeditor5/ckeditor.js"></script>
	<script>ClassicEditor
			.create( document.querySelector( '#body' ), {
				
				toolbar: {
					items: [
						'heading',
						'fontFamily',
						'fontSize',
						'fontColor',
						'fontBackgroundColor',
						'highlight',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'outdent',
						'indent',
						'alignment',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'htmlEmbed',
						'code',
						'CKFinder',
						'undo',
						'redo'
					]
				},
				language: 'fa',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				
				
			} )
			.then( editor => {
				window.editor = editor;
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: lk1jrmfyew48-v2doq7vgpypp' );
				console.error( error );
			} );
	</script>

</body>

</html>