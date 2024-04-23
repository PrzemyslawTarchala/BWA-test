<?php 
    include_once("../../Utils/debug.php");
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App</title>
    <link rel="stylesheet" href="/public/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

		<?php if(!@isset($_SESSION['logged']) || ($_SESSION['logged'] === false)) : ?> 


        <?php else: ?>
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="/img/logo.png" alt="">
                    </span>
                    <div class="text header-text">
                        <span class="name">Budget App</span>
                    </div>
                </div>
                <i class='bx bx-chevron-right toggle'></i>
            </header>
                <div class="menu-bar">
                    <div class="menu">
                        <ul class="menu-links">
                            <li class="nav-link">
                                <a href="/?action=overview">
                                    <i class='bx bx-home-alt icon' ></i>
                                    <span class="text nav-text">Overview</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="/?action=addRevenue">
                                    <i class='bx bx-plus icon' ></i>
                                    <span class="text nav-text">Add revenue</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="/?action=addExpense">
                                    <i class='bx bx-minus icon' ></i>
                                    <span class="text nav-text">Add expense</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="/?action=analitics">
                                    <i class='bx bx-pie-chart-alt icon' ></i>
                                    <span class="text nav-text">Analitics</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="bottom-content">
                        <li class="">
                            <a href="/?action=logout">
                                <i class='bx bx-log-out icon' ></i>
                                <span class="text nav-text">Logout</span>
                            </a>
                        </li>
                        <li class="mode">
                            <div class="moon-sun">
                                <i class='bx bx-moon icon moon' ></i>
                                <i class='bx bx-sun icon sun' ></i>
                            </div>
                            <span class="mode-text text">Dark Mode</span>                      
                            <div class="toggle-switch">
                                <span class="switch"></span>
                            </div>	
                        </li>
                    </div>
                </div>
        </nav>		
        <?php endif; ?>