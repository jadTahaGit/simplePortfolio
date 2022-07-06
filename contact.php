<!DOCTYPE html>
<html lang="en">

<head>
    <meta author="Jad Taha" />
    <meta email="jadtaha@gmail.com" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jad Taha</title>
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/queries.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
</head>

<body>
    <ion-icon class="nav-icon" name="reorder-three"></ion-icon>
    <aside class="site-sidebar">
        <ion-icon class="close-icon" name="close"></ion-icon>
        <a href="#" rel="me" class="person">
            <img class="person-img" src="img/profile.png" alt="person" />
            <div class="person-content">
                <h1 class="person-name">Jad Taha</h1>
                <h2 class="person-job-title">Full-Stack Web Developer</h2>
            </div>
        </a>

        <nav>
            <ul>
                <li>
                    <a class="nav-link" href="index.html">Home
                        <ion-icon class="chevron-forward" name="chevron-forward-outline"></ion-icon>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="portfolio.html">Portfolio
                        <ion-icon class="chevron-forward" name="chevron-forward-outline"></ion-icon>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="contact.php">Contact Me
                        <ion-icon class="chevron-forward" name="chevron-forward-outline"></ion-icon>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="cv.pdf">my CV
                        <ion-icon class="chevron-forward" name="chevron-forward-outline"></ion-icon>
                    </a>
                </li>
            </ul>

            <div class="social-icons">
                <p>GET IN TOUCH</p>
                <a href="tel:004915221014525" target="_blank">
                    <ion-icon class="social-icon" name="call-sharp"></ion-icon>
                </a>
                <a href="mailto:jadtaha.de@gmail.com" target="_blank">
                    <ion-icon class="social-icon" name="mail-unread"></ion-icon>
                </a>
                <a href="https://www.linkedin.com/in/jad-taha/" target="_blank">
                    <ion-icon class="social-icon" name="logo-linkedin"></ion-icon>
                </a>
                <a href="https://github.com/jadTahaGit" target="_blank">
                    <ion-icon class="social-icon" name="logo-github"></ion-icon>
                    </ion-icon>
                </a>
            </div>

        </nav>
    </aside>

    <main class="main-site main-background-img">
        <div class="contact-section">
            <form class="contact-grid" action="contact.php" method="POST">
                <input type="text" name="name" placeholder="Your name..." required />
                <input type="text" name="company" placeholder="Your company..." required />
                <input type="email" name="email" placeholder="example@mail.com" required />

                <?php
                require "connect.php";
                $sql = "SELECT * FROM options";
                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        // Create the array for all the options:
                        $options = array();
                        $ids = array();
                        //Create a variable for the selected option
                        while ($row = mysqli_fetch_array($result)) {
                            // Push the elements into the array:
                            // echo $row['option'];
                            array_push($options,  $row['option']);
                            array_push($ids,  $row['id']);

                            // Take it from Get:
                            // The selected element (in this case 2)
                            $selected_sql = "SELECT * FROM options WHERE id = 2"; // $optionName
                            $selected_result = mysqli_query($conn, $selected_sql);
                            while ($selected_row = mysqli_fetch_array($selected_result)) {
                                $dbselected = $selected_row['option'];
                            }
                            // frees the memory associated with the result
                            mysqli_free_result($selected_result);
                        }
                    } else {
                        echo "Something went wrong...";
                    }
                } else {
                    echo "ERROR: Could not execute $sql." . mysqli_error($conn);
                }

                // -----------------------------------------------
                // ------------------- Select --------------------------
                // -----------------------------------------------
                echo "<select name='from_where'>";
                $i = 0;
                foreach ($options as $option) {

                    if ($dbselected == $option) {
                        echo "<option selected='selected' value='$ids[$i]'>$option</option>";
                    } else {
                        echo "<option value='$ids[$i]'>$option</option>";
                    }
                    $i++;
                }
                echo "</select>";



                // -----------------------------------------------
                // ------------------- Action --------------------------
                // -----------------------------------------------
                if (isset($_POST['btn-form'])) {
                    // submit the form
                    $name = $_POST['name'];
                    $company = $_POST['company'];
                    $email = $_POST['email'];
                    $from_where = ($_POST['from_where']);
                    $message = trim($_POST['message']);

                    // echo "from: " . $from_where;
                    // echo "message: " . $message;


                    $sql = "INSERT INTO messages (name, email, message, from_where, company )
                    VALUES ('$name', '$email', '$message','$from_where', '$company' )";


                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "<script>
                alert('Message added Successfully')
                </script>";
                        $name = "";
                        $email = "";
                        $message = "";
                        $company = "";
                        $from_where = "";
                    } else {
                        echo "<script>
                alert('Something went wrong!')
                </script>";
                    }
                    // header("Location: ../contact.php?action");
                }
                ?>
                <textarea class="message" name="message" placeholder="Your message...." required></textarea>
                <button class="btn-form" name="btn-form">Submit</button>
            </form>
        </div>
    </main>
    <script src="js/mobileNav.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
