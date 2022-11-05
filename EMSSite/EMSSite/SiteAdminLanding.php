
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name ="viewport" content="width = device-width", initial-scale="1.0">
        <title> Landing Page</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
    <body>
        <section>
                <input type="checkbox" id="check">
            <header>

                <h2> <a href="#" class ="logo">E M S</a></h2>
                <div class ="navigation">
                <a href = "ModifyUsers.Html"> Modify Users</a>
                <a href = "NewLogin.php"> Create New User Login</a>
                <a href = "AddUsers.Html"> Add Users</a>
                <!-- 
                <a href = "#"> Delete User</a>
                <a href = "#"> Update User</a> > 
                -->
                </div>

                <label for ="check">
                    <i class ="fas fa-bars menu-btn"></i>
                    <i class ="fas fa-times close-btn"></i>
                </label>

            </header>

            <div class="navigation">
                    <button type="button" class="" onclick="location.href='logout.php'">
                        <span class="">Sign Out</span>
                        <span class="">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                    </button>
            </div>

            <div class ="content">
                    <div class info ="info">
                <h2> Employee Management System!</h2>
                <strong >Welcome Site Admins!</strong>
                <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis, nostrum inventore aperiam perspiciatis quas totam autem adipisci esse. Incidunt at corporis repellat neque, quaerat qui cum! Quibusdam aperiam accusamus accusantium! Impedit, perspiciatis quam. Nulla temporibus aliquam corporis recusandae obcaecati ex nostrum officiis nesciunt, reiciendis facere, consectetur quos sed dolorum? Voluptatem quas velit quo corporis, distinctio ad consequuntur omnis temporibus mollitia perspiciatis veniam minus, unde possimus rerum. Quia doloremque sit, dolorem ipsam odio aspernatur totam ex nostrum error nihil neque vel. Voluptatem iure quisquam accusantium quam eaque laudantium quis cumque, incidunt ab. Magnam eos dolore, recusandae blanditiis necessitatibus neque. Qui, ipsam.</p>
            </div>
        </section>
    </body>
</html>