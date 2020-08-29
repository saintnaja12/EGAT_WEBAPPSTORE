<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <link rel="stylesheet" href="../css/style.css">

    <link rel="shortcut icon" type="image/x-icon" href="../pic/180px-การไฟฟ้าฝ่ายผลิตแห่งประเทศไทย.png">

    <title>EGAT Enterprise App Store</title>

    <title></title>
</head>

<body>

    <div class="container pt-lg-md">

        <div class="row justify-content-center">

            <div class="col-sm-4"
                style="background-color: #EACA6A; border-radius: 10px ; margin-left: 1em ; margin-right: 1em ;">
                <form class="form-signin" id="signin" name="signin" method="post"  >

                    <img class="img-fluid mt-3" src="../pic/logo.png" alt="Responsive image" style="border-radius: 5px;">

                    <p></p>

                    <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                        required>

                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                    
                    <div class="text-center">
                        <!-- <input name="submit" class="btn btn-primary my-3 btn-block" type="submit" value="Sign in" /> -->
                        <button type="submit" name="login" value="Login" class="btn btn-primary my-3 btn-block">Singin</button>
                    </div>
                </form>

            </div>


        </div>
        <p></p>

        <h6 class="h6" style="margin: 20px auto; text-align: center;">
            <u>
                <a href="../file_link/EGATApplicationSteps.pdf">
                    <font color="#fff">
                        ขั้นตอนการนำ Mobile Application เข้า App Store / Play Store / EGAT Enterprise App Store
                        ในนามของ กฟผ.
                    </font>
                </a>
            </u>
        </h6>

        <p></p>
        <h6 style="text-align: center;">
            <font color="#fff">ติดต่อผู้ดูแลระบบ : <br />
                กองพัฒนาระบบสายงานกลาง <br />
                ฝ่ายจัดการและพัฒนาระบบสารสนเทศ (อจส.) <br />
                โทร. 64425 และ 64456 <br />

                Email : <a href="">egatentapp@egat.co.th</a>
            </font>
        </h6>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
$(document).on('submit', '#signin',function () {
    $.post("check_login.php", $("#signin").serialize(),
        function (data) {
            d = JSON.parse(data)
            var test = JSON.parse(data)

            if( d.row == 0)
            {
                swal("Username or Password wrong !" , "Please check again.");
                swal({
                    title: "Username or Password wrong !",
                    text: "Please check again.",
                    icon: "error",
                    button: "OK",
                    });
                
            }
            else
            {

                swal( "Welcome " + d.msg + " !!!", 
                        {icon: "success",
                        button: false,
                });
                if(d.msg == 'Admin')
                {
                    setTimeout(function(){window.location="../admin/admin_page.php"}, 2000);
                }
                else if(d.msg == 'Developer')
                {
                    setTimeout(function(){window.location="../admin/admin_page.php"}, 2000);
                }
                else 
                {
                    setTimeout(function(){window.location="../admin/admin_page.php"}, 2000);
                } 
            }

        },

    );
    event.preventDefault();
});
</script>
</body>

</html>