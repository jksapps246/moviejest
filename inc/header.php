<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Movie Master</title>
        <link rel="stylesheet" type="text/css" href="/inc/styles/site.css">
        <script type="text/javascript" src="functions/site.js"></script>
    </head>
    <body>    
        <header>
            <img id="logo" src="inc/images/movie-jest-white.png" alt="MovieMaster Logo">
            <nav>                
                <ul class="nav_links">                                  
                    <li><a id="menu_link" href="Index.php">HOME</a></li>
                </ul> 
            </nav>                     
            <div class="searchForm">
                <form method="POST">
                    <input type="text" required name="search" placeholder="type the movie name here...">
                    <input type="submit" value="SEARCH">
                </form>
            </div>  
            <div class="drop_down" onclick="dropDownMenu(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>            
                <div class="drop_down_content">
                    <a href="Index.php">HOME</a>
                </div>
            </div>             
    </header>
    <div class="page-container">
