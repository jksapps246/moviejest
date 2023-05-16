<?php
include_once 'inc/header.php';
include "functions/actorfunctions.php";

if(isset($_POST["movieID"])) {
    GetMovie($_POST["movieID"]);
}
echo
"<div class=\"actorBox\">
    <div class=\"leftActor\">
        <img id=\"actorImg\" src=\"". $profilePath ."\" alt=\"". $name . "\">
        <div class=\"profileinfo\">
            <h3>Profile Info</h3>
            <label>Known For</label>
            <p>".$knownForDepartment."</p>

            <label>Known Credits</label>
            <p>".$knownCredits."</p>

            <label>Gender</label>
            <p>".$gender."</p>

            <label>Birthday</label>
            <p>".$birthday ." ". $age ."</p>

            <label>Place of Birth</label>
            <p>".$placeOfBirth."</p>

            <label>Also Known As</label> 
            <p>";
            for($i = 0; $i< count($alsoKnownAs); $i++){
                if ($i < count($alsoKnownAs) -1) {
                    echo "".$alsoKnownAs[$i].", ";
                }
                else {
                    echo "".$alsoKnownAs[$i];
                }
            }
            echo
            "</p>
        </div>
    </div>
    <div class=\"rightActor\">
        <div class=\"actorText\">
            <h2>".$name."</h2>";    
            if($bio_limit != 0){
                echo "<label>Biography</label>";
                if(strlen($biography) < $bio_limit){
                    echo "<span>".$biography."</span>";
                }
                else {
                    echo
                    "<span id=\"bio\">".strstr($biography,0, $bio_limit)."</span>
                    <span id=\"dots\" >...</span>            
                    <span id=\"more\">".strstr($biography.$bio_limit,(strlen($biography)- $bio_limit))."</span>
                    <button id=\"bioButton\" onclick=\"showBio()\">[Read more]</button>";
                }
            }
        echo
        "</div>
        <br></br>
        <div class=\"actorText\">   
            <label>Known For:</label>
            <div id=\"castVidPics\">";
                for($i = 0; $i < count($videoPaths); $i++) {
                    $path = "https://www.themoviedb.org/t/p/w150_and_h225_bestv2";
                    if($videoPaths[$i] == null){
                        $fullImagePath = "inc/images/moviePoster.png";
                    }
                    else $fullImagePath = $path . $videoPaths[$i];
                    echo
                    "<div class=\"castVidPic\" style=\"background: url(".$fullImagePath."); background-size: cover; background-position: center;\"> 
                        <form method=\"POST\">                              
                            <input class=\"castVidButton\" type=\"submit\" name=\"movieID\" value=\"".$videoIds[$i]."\" />
                        </form>
                    </div>";
                }
            echo    
            "</div>
            <label> Profile:</label>
            <div id=\"profilePics\">";             
                for($i = 0; $i < count($profileImages); $i++){
                    $path = "https://www.themoviedb.org/t/p/w220_and_h330_face";
                    $fullImagePath = $path . $profileImages[$i];
                    echo
                    "<div class=\"profilePic\">
                        <img src=\"".$fullImagePath."\" > 
                        <div class=\"profileSize\" >Size: ".$profileSize[$i]."</div>
                    </div>";
                }
            echo
            "</div>
        </div>
    </div>
</div>";
include_once 'inc/footer.php';
?>