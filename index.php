<?php
if (file_exists(__DIR__ . "/autoload.php")) {
    require_once __DIR__ . "/autoload.php";
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css">

    <title>Create Form</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = $_POST["name"];
        $phone = $_POST["phone"];

        //   file manage
        $fileName = $_FILES["file"]["name"];
        $file_tem_Name = $_FILES["file"]["tmp_name"];

        // form validation
        if (empty($name) || empty($phone) || empty($fileName)) {
            $msg = alert("All fields are required",);;
        } else {
            $msg =  alert("Form submition done", "success");
            reset_data();
            $data = json_decode(file_get_contents("./db/form.json"), true);

            array_push($data, [
                "name" => "$name",
                "pnone" => "$phone",
                "photo" => "$fileName",
            ]);

            file_put_contents("./db/form.json", json_encode($data));
            move_uploaded_file($file_tem_Name, "./photo/" . $fileName);
        };
    };


    ?>


    <div class="container">
        <div class="row">
            <div class="col-md- d-flex justify-content-center">
                <div class="card my-3 shadow">
                    <div class="card-header ">
                        <div class="card-title ">
                            <h4 class="d-flex justify-content-center">Upload Your Files</h4>
                        </div>

                    </div>
                    <div class="card-body">
                        <?php echo $msg ?? "" ?>
                        <div class="my-2">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="my-2">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo old("name") ?>">
                                </div>
                                <div class="my-2">
                                    <label for="">Phone</label>
                                    <input type="number" class="form-control" name="phone" value="<?php echo old("phone") ?>">
                                </div>
                                <div class="my-2">
                                    <label for="">Photo</label>
                                    <label class="upload">
                                        <input type="file" id="previwe" class="form-control" name="file">
                                        <img src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=612x612&w=0&k=20&c=St-gpRn58eIa8EDAHpn_yO4CZZAnGD6wKpln9l3Z3Ok=" alt="">

                                    </label>

                                    <div class="preview-image">
                                        <img src="" alt="">
                                    </div>
                                </div>
                                <div class="my-2">

                                    <input type="submit" value="Save" class="form-control w-100%  btn-success">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        const previwe = document.getElementById('previwe');
        const previwe_image = document.querySelector(".preview-image");

        previwe.onchange = (event) => {
            const image = URL.createObjectURL(event.target.files[0]);
            previwe_image.children[0].setAttribute("src", image)
        }
    </script>


</body>

</html>