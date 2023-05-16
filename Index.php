<?php
include_once 'inc/header.php';
include_once 'functions/indexfunction.php';

    if(isset($_GET["type"])) {
        Filter($_GET["category"],$_GET["type"],$_GET["genre"]);
    }
    if(isset($_POST["search"])) {
        Search($_POST["search"]);
    }
    elseif(isset($_POST["movieID"])) {        
          Movie($_POST["movieID"]);          
    }
  
?>
<div id="mainDiv">    
    <div id="filter">                    
        <form method="GET" >            
            <select class="filterList" name="category">
               <option value="">-Categories:-</option> 
               <option value="LATEST">Latest Movie</option>
                <option value="THEATERS">In Theaters</option>
                <option value="ALL">ALL Movies</option>
    
            </select>  
            <select class="filterList" name="type">
                <option value="">-Type:-</option> 
                <option value="KIDS">Kids</option>
                <option value="TEENS">Teens</option>
                <option value="ADULTS">Adults</option>
            </select>
            <select class="filterList" name="genre">
                <option value="">-Genre:-</option>
                <?php 
                    for($i =0; $i < count($genres); $i++){
                    echo "<option value=\"".$genres[$i]['id']."\">".$genres[$i]['name']."</option>";
                    
                    }
                ?>
            </select>  
            <input class="filterButton" type="submit" value="Filter">
        </form>
    </div>     
        <div id= "mainTop">   
            <br></br>
            <div id="mainTitle"> <?php echo $searchTitle ?> </div>        
                <div id="mainResults"> 
                    <?php                   
                    for($i = 0; $i <count($posterURLS); $i++) {
                        $path = "";
                        if($posterURLS[$i] == null){
                            $path = "inc/images/moviePoster.png";
                        }
                        else {
                            $path = "https://image.tmdb.org/t/p/w500" . $posterURLS[$i];
                        }
                    echo
                    "<div class=\"thumbs\" style=\"background: url(".$path."); background-size: cover;\">
                        <form method=\"POST\"  onmouseover=\"setDetails(dTitle.value, dDate.value, dLang.value,dBio.value)\">
                            <input type=\"submit\" class=\"thumbButton\" name=\"movieID\" value=\"".$movieIDS[$i]."\" />
                            <input type=\"hidden\" class=\"thumbButton\" name=\"dTitle\" value=\"".$movieTitle[$i]."\" />
                            <input type=\"hidden\" class=\"thumbButton\" name=\"dDate\" value=\"".$releaseDate[$i]."\" />
                            <input type=\"hidden\" class=\"thumbButton\" name=\"dLang\" value=\"".$movieLanguage[$i]."\" />
                            <input type=\"hidden\" class=\"thumbButton\" name=\"dBio\" value=\"".$overviews[$i]."\" />
                            
                        </form>
                        <div class=\"thumbLabel\">
                            <label>Title:<p>".$movieTitle[$i]."</p></label>
                            <div class=\"thumbLabel2\">
                                <label>Date:<p>".$releaseDate[$i]."</p></label>
                                <label>Language:<p>".$movieLanguage[$i]."</p></label>
                            </div>
                        </div>
                    </div>";                 
                    }
                    ?>
                </div>
            </div> 
        <div id="mainBottom">  
            <div id="infoLeft">
                <label>Title: </label>
                <p id="dTitle"><?php echo $defaultTitle ?></p>
                <label>Date: </label>
                <p id="dDate"><?php echo $defaultDate ?></p>
                <label>Language: </label>
                <p id="dLang"><?php echo $defaultLang ?></p>
            </div>
            <div id="infoRight">
                <label >Bio:</label>
                <p id="dBio"><?php echo $defaultBio ?></p>
            </div>
        </div>
    </div>
<?php
include_once 'inc/footer.php';
?>
