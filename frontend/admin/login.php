


<!DOCTYPE html>
<html lang="en">

<head>
<?php require('./admin_components/header_links.php'); ?>
    <title>Sign In</title>

    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        body,
        input {
            font-family: "Poppins", sans-serif;
        }

        .container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background: #fff;
            overflow: hidden;
        }

        .container::before {
            content: "";
            position: absolute;
            width: 2000px;
            height: 2000px;
            border-radius: 50%;
            background: linear-gradient(-45deg, #EEEEEE, #EEEEEE);
            right: 48%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            z-index: 6;
            -webkit-transition: 1.8s ease-in-out;
            transition: 1.8s ease-in-out;
        }

        .container__forms {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .container__panels {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: (1fr) [2];
            grid-template-columns: repeat(2, 1fr);
        }

        form {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            padding: 0 5rem;
            overflow: hidden;
            -ms-grid-column: 1;
            -ms-grid-column-span: 1;
            grid-column: 1 / 2;
            -ms-grid-row: 1;
            -ms-grid-row-span: 1;
            grid-row: 1 / 2;
            -webkit-transition: 0.2s 0.7s ease-in-out;
            transition: 0.2s 0.7s ease-in-out;
        }

        form.form__sign-in {
            z-index: 2;
        }

        form.form__sign-up {
            z-index: 1;
            opacity: 0;
        }

        .form {
            position: absolute;
            top: 50%;
            left: 75%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            width: 50%;
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: 1fr;
            grid-template-columns: 1fr;
            z-index: 5;
            -webkit-transition: 1s 0.7s ease-in-out;
            transition: 1s 0.7s ease-in-out;
        }

        .form__title {
            font-size: 2.2rem;
            color: #444;
            margin-bottom: 10px;
        }

        .form__input-field {
            max-width: 380px;
            width: 100%;
            height: 3.437rem;
            background-color: #f0f0f0;
            margin: 10px 0;
            border-radius: 3.437rem;
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: 15% 85%;
            grid-template-columns: 15% 85%;
            padding: 0 0.4rem;
        }

        .form__input-field i {
            text-align: center;
            line-height: 3.437rem;
            color: #acacac;
            font-size: 1.1rem;
        }

        .form__input-field input {
            background: none;
            outline: none;
            border: none;
            line-height: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            border-radius: inherit;
        }

        .form__input-field input::-webkit-input-placeholder {
            color: #aaa;
            font-weight: 500;
        }

        .form__input-field input:-ms-input-placeholder {
            color: #aaa;
            font-weight: 500;
        }

        .form__input-field input::-ms-input-placeholder {
            color: #aaa;
            font-weight: 500;
        }

        .form__input-field input::placeholder {
            color: #aaa;
            font-weight: 500;
        }

        .form__submit {
            width: 9.375rem;
            height: 3.0625rem;
            border: none;
            outline: none;
            border-radius: 3.0625rem;
            cursor: pointer;
            background-color: #b538d1;
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
            margin: 10px 0;
            -webkit-transition: 0.5s;
            transition: 0.5s;
        }

        .form__submit:hover {
            background-color: #5a1369;
        }

        .form__social-text {
            padding: 0.7rem 0;
            font-size: 1rem;
        }

        .form__social-media {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .form__social-icons {
            height: 2.875rem;
            width: 2.875rem;
            border: 1px solid #333;
            border-radius: 50%;
            margin: 0 0.45rem;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            color: #333;
            font-size: 1.1rem;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .form__social-icons:hover {
            color: #d672ec;
            border-color: #d672ec;
        }

        .panel {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            -ms-flex-pack: distribute;
            justify-content: space-around;
            text-align: center;
            z-index: 7;
        }

        .panel__content {
            color: #fff;
            -webkit-transition: 0.9s 0.6s ease-in-out;
            transition: 0.9s 0.6s ease-in-out;
        }

        .panel__left {
            pointer-events: all;
            padding: 3rem 17% 2rem 12%;
        }

        .panel__right {
            pointer-events: none;
            padding: 3rem 12% 2rem 17%;
        }

        .panel__title {
            font-weight: 600;
            line-height: 1;
            font-size: 1.5rem;
        }

        .panel__paragraph {
            font-size: 0.95rem;
            padding: 0.7rem 0;
            max-width: 560px;
        }

        .panel__image {
            width: 100%;
            -webkit-transition: 1.1s 0.4s ease-in-out;
            transition: 1.1s 0.4s ease-in-out;
        }

        .btn {
            border: none;
            outline: none;
            border-radius: 3.0625rem;
            cursor: pointer;
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            margin: 0;
            background: none;
            border: 2px solid #fff;
            width: 130px;
            height: 41px;
            font-size: 0.8rem;
        }

        /*Animation*/
        .panel__right .panel__content,
        .panel__right .panel__image {
            -webkit-transform: translateX(800px);
            transform: translateX(800px);
        }

        .container.sign-up-mode .panel__right .panel__content,
        .container.sign-up-mode .panel__right .panel__image {
            -webkit-transform: translateX(0px);
            transform: translateX(0px);
        }

        .container.sign-up-mode::before {
            -webkit-transform: translate(100%, -50%);
            transform: translate(100%, -50%);
            right: 52%;
        }

        .container.sign-up-mode .panel__left .panel__image,
        .container.sign-up-mode .panel__left .panel__content {
            -webkit-transform: translateX(-800px);
            transform: translateX(-800px);
        }

        .container.sign-up-mode .panel__left {
            pointer-events: none;
        }

        .container.sign-up-mode .panel__right {
            pointer-events: all;
        }

        .container.sign-up-mode .form {
            left: 25%;
        }

        .container.sign-up-mode form.form__sign-in {
            z-index: 1;
            opacity: 0;
        }

        .container.sign-up-mode form.form__sign-up {
            z-index: 2;
            opacity: 1;
        }

        @media (max-width: 870px) {
            .container {
                min-height: 800px;
                height: 100vh;
            }

            .container::before {
                width: 1500px;
                height: 1500px;
                left: 30%;
                bottom: 68%;
                -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
                right: initial;
                top: initial;
                -webkit-transition: 2s ease-in-out;
                transition: 2s ease-in-out;
            }

            .form {
                width: 100%;
                left: 50%;
                top: 95%;
                -webkit-transform: translate(-50%, -100%);
                transform: translate(-50%, -100%);
                -webkit-transition: 1s 0.8s ease-in-out;
                transition: 1s 0.8s ease-in-out;
            }

            .container__panels {
                -ms-grid-columns: 1fr;
                grid-template-columns: 1fr;
                -ms-grid-rows: 1fr 2fr 1fr;
                grid-template-rows: 1fr 2fr 1fr;
            }

            .panel {
                -webkit-box-orient: horizontal;
                -webkit-box-direction: normal;
                -ms-flex-direction: row;
                flex-direction: row;
                -ms-flex-pack: distribute;
                justify-content: space-around;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                padding: 2.5rem 8%;
            }

            .panel__left {
                -ms-grid-row: 1;
                -ms-grid-row-span: 1;
                grid-row: 1 / 2;
            }

            .panel__right {
                -ms-grid-row: 3;
                -ms-grid-row-span: 1;
                grid-row: 3 / 4;
            }

            .panel__image {
                width: 200px;
                -webkit-transition: 0.9s 0.6s ease-in-out;
                transition: 0.9s 0.6s ease-in-out;
            }

            .panel__content {
                padding-right: 15%;
                -webkit-transition: 0.9s 0.8s ease-in-out;
                transition: 0.9s 0.8s ease-in-out;
            }

            .panel__title {
                font-size: 1.2rem;
            }

            .panel__paragraph {
                font-size: 0.7rem;
                padding: 0.5rem 0;
            }

            .panel__right .panel__content,
            .panel__right .panel__image {
                -webkit-transform: translateY(300px);
                transform: translateY(300px);
            }

            .btn {
                width: 6.875rem;
                height: 2.187rem;
                font-size: 0.7rem;
            }

            .container.sign-up-mode::before {
                -webkit-transform: translate(-50%, 100%);
                transform: translate(-50%, 100%);
                bottom: 32%;
                right: initial;
            }

            .container.container.sign-up-mode .panel__left .panel__image,
            .container.container.sign-up-mode .panel__left .panel__content {
                -webkit-transform: translateY(-300px);
                transform: translateY(-300px);
            }

            .container.sign-up-mode .form {
                top: 5%;
                -webkit-transform: translate(-50%, 0);
                transform: translate(-50%, 0);
                left: 50%;
            }
        }

        @media (max-width: 570px) {
            form {
                padding: 0 1.5rem;
            }

            .panel__image {
                display: none;
            }

            .panel__content {
                padding: 0.5rem 1rem;
            }

            .container::before {
                bottom: 72%;
                left: 50%;
            }

            .container.sign-up-mode::before {
                bottom: 28%;
                left: 50%;
            }
        }
    </style>

</head>

<body >
    <div class="container" style="max-width: 4000px !important;">
        <div class="container__forms">
            <div class="form">
                <form action="../../backend/admin/admin_login.php" method="post" class="form__sign-in">
                    <h2 class="form__title">Sign In</h2>
                    <div class="form__input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="Email" required />
                    </div>
                    <div class="form__input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password"  required />
                    </div>
                    <input class="form__submit" type="submit" style="background-color: #FF3859; border: 0px;" 
                    value="Login" />
                    <div class="new-user-box">
                        <span>Forgot Password ? </span>
                        <a type="button" href="../enter_mail.php" id="btn1">Reset</a>
                    </div>

                </form>

                <form action="../backend/login_signup/sign_up.php" method="post" class="form__sign-up">
                    <h2 class="form__title">Sign Up</h2>
                    <div class="form__input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Name" name="name" required />
                    </div>
                    <div class="form__input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="emial" placeholder="Email" name="email" required />
                    </div>
                    <div class="form__input-field">
                        <i class="fas fa-phone"></i>
                        <input type="tel" minlength="10" placeholder="Phone" name="phone" required />
                    </div>
                    <div class="form__input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required />
                    </div>

                    <input class="form__submit" type="submit" 
                    style="background-color: #FF3859; border: 0px;" value="Sign Up" />

                    <!-- <p class="form__social-text">Or Sign up with social platforms</p>
                        <div class="form__social-media">
                            <a href="#" class="form__social-icons">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="form__social-icons">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="form__social-icons">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="form__social-icons">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div> -->
                </form>
            </div>
        </div>
        <div class="container__panels">
            <div class="panel panel__left">
                <!-- <div class="panel__content">
                    <h3 class="panel__title" style="color: black;">New here ?</h3>
                    <p class="panel__paragraph" style="color: black;">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Doloremque adipisci tempore aliquid?
                    </p>
                    <button class="btn" style="background-color: #FF3859; border: 0px;" id="sign-up-btn">
                        Sign Up
                    </button>
                </div> -->
                <img class="panel__image"
                    src="../images/login.png" alt="" />
            </div>
            <div class="panel panel__right">
                <div class="panel__content">
                    <h3 class="panel__title" style="color: black;">One of us ?</h3>
                    <p class="panel__paragraph" style="color: black;">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Doloremque adipisci tempore aliquid?
                    </p>
                    <button class="btn" style="background-color: #FF3859; border: 0px;" id="sign-in-btn">
                        Sign In
                    </button>
                </div>
                <img class="panel__image" src="./images/signup.png"
                    alt="img" />
            </div>
        </div>
    </div>

    <script>
        const signInBtn = document.querySelector("#sign-in-btn");
        const signUpBtn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        signUpBtn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        signInBtn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

    </script>

</body>

</html>