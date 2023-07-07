<?php include('header.php'); ?>


<h1 class="text-center">About Page</h1>

<h1 class="bg-dark text-light p-5"><?php $read = fopen("about.txt", "r") or die("unable to load file");
                                    var_dump(fread($read, filesize("about.txt")))  ?></h1>


<?php
if (isset($_POST['upload_photo'])) {

    // print_r($photo);

    $target_dir = 'photos/';
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    // echo $target_file;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



    $size = $_FILES['photo']['size'];

    var_dump($size);


    if (empty($_FILES['photo']['name'])) {
        $error = "Please include file";
    } elseif ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'zip') {
        $error = 'File must be jpg or png or zip!';
    } elseif ($size >= 500000) {
        $error = 'File must be less than 5MB';
    } else {
        $newName = 'photo' . rand(1111, 9999) . '_' . rand(1111, 9999) . '.' . $imageFileType;
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir . $newName);
        $success = 'Upload successful!';
    }
}

?>

<div class="container"></div>
<row>
    <div class="col-lg-6 bg-dark offset-3 p-5 mt-5 rounded-3 text-white">


        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($success)) : ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <h2 class="mb-5">File upload</h2>
                <label for="photo" class="form-label">Choose file</label>
                <input type="file" class="form-control" name="photo" id="photo">
            </div>

            <div class="mb-3">
                <input class="btn btn-primary" name="upload_photo" type="submit" value="Upload">
            </div>


        </form>
    </div>
</row>
</div>

<?php include('footer.php'); ?>