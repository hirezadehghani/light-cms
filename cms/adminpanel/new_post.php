<?php
require_once("./include/connect.php");

$query_categories = "SELECT * FROM categories";
$categories = $db->query($query_categories);

if (isset($_POST['add_post'])) {
    if (trim($_POST['title']) != "" && trim($_POST['author']) != "" && trim($_POST['category_id']) != "" && trim($_POST['body']) != "" && trim($_FILES['image']['name']) != "") {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $body = $_POST['body'];
        $name_image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];


        if (move_uploaded_file($tmp_name, "../upload/posts/$name_image")) {
        } else {
            echo "آپلود عکس با شکست مواجه شد!";
            echo $_FILES['image']['error'];
        }

        $post_insert = $db->prepare("INSERT INTO posts (title, author, category_id, body , image) VALUES (:title, :author, :category_id, :body , :image)");
        $post_insert->execute(['title' => $title, 'author' => $author, 'category_id' => $category_id, 'body' => $body, 'image' => $name_image]);

        if (isset($_POST['post_slider'])) {
            if ($_POST['post_slider'] == "on") {
                $query_posts = "SELECT * FROM posts ORDER BY id DESC LIMIT 1";
                $posts = $db->query($query_posts)->fetch();
                $post_id = $posts['id']++;
                
                $posts_slider = $db->prepare("INSERT INTO posts_slider (post_id) VALUES (:post_id)");
                $posts_slider->execute(['post_id' => $post_id]);
            }
        }

        header("Location:post.php");
        exit();
    }
    // else{
}
require_once("./include/header.php");

?>
<!-- NOT FORCE CLOSE -->
<script>
    window.onbeforeunload = confirmExit;

    function confirmExit() {
        return "You have attempted to leave this page. Are you sure?";
    }
</script>
<div class="container-fluid">

    <div class="row">
            <?php include("./include/sidebar.php"); ?>
        <div class="col-md-9 col-sm-auto col-lg-10">
            <h3 class="mt-2">ایجاد مقاله</h3>

            <hr />

            <form method="post" class="mb-2" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" name="title" id="title" required>
                    <small class="form-text text-muted">نام مقاله را وارد کنید.</small>
                </div>
                <div class="form-group">
                    <label for="author">نویسنده: </label>
                    <input type="text" class="form-control" name="author" id="author" required>
                    <small class="form-text text-muted">نام مقاله را وارد کنید.</small>
                </div>
                <div class="form-group">
                    <label for="category_id">دسته بندی: </label>
                    <select name="category_id" id="category_id" class="form-control">
                        <?php
                        if ($categories->rowCount() > 0) {
                            foreach ($categories as $category) {
                        ?>

                                <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="body">متن مقاله: </label>
                    <textarea name="body" id="body" class="form-control"></textarea>
                    <small class="form-text text-muted">متن مقاله را وارد کنید.</small>
                </div>
                <div class="form-group">
                    <label for="image">تصویر: </label>
                    <input type="file" class="form-control w-50" name="image" id="image" required>
                    <small class="form-text text-muted">تصویر مقاله را وارد کنید.</small>
                </div>
                <div class="form-group my-3">
                    <label for="post_slider"></label>
                    <input type="checkbox" class="form-check-input" name="post_slider" id="post_slider">
                    <small class="form-text text-muted">نمایش پست در اسلایدر</small>
                </div>
                <button type="submit" name="add_post" class="btn btn-success">ایجاد</button>
            </form>


        </div>
    </div>
</div>
<script src="./js/script.js" type="text/javascript"></script>

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