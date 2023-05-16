<?php
include_once 'inc/header.php';
include 'functions/moviefunction.php';


if(isset($_POST["actorID"])) {
   GetCast($_POST["actorID"]);
}

echo
"<div class=\"movieDiv\" style=\"background: radial-gradient(rgba(15, 14, 22, 0.67), #100e17), url(".$backdropPath.") ; background-size: cover; background-position: center;\">
    <div id=\"title\">
        <h1>".$movieTitle."</h1>
    </div>
    <div class=\"movieInfo\">
        <div id=\"poster\">
            <img id=\"largeMoviePoster\" src=\"".$posterPath."\" alt=\"".$movieTitle."\">
        </div>
        <div class=\"posterInfo\">    
            <label>Released:</label>
            <p>".$releaseDate."</p>
            <label>Runtime:</label>
            <p>".$runtime." mins</p>
            <label>User Rating:</label>
            <p>".$voteAverage." / 10</p>
            <label>Genres:</label>
            <p>";
            for($i = 0; $i < count($genres); $i++) {
                if($i < (count($genres) - 1)) {
                    echo $genres[$i] . ", ";
                }
                else {
                    echo $genres[$i];
                }
            }
            echo
            "</p>
        </div>
        <div class=\"story\"> 
            <label>Story:</label>
            <p>".$overview."</p>
        </div>        
    </div>";      
        
    if(count($videos) > 0) {
        echo
        "<div id=\"videoPanel\">
            <div id=\"trailer\">       
                <label>Select Trailer:</label>
                <select id=\"trailerButton\" onchange=\"setTrailer('youtubePlayer',this.value)\">";
                    for($i= 0; $i < count($videos); $i++){
                        if($videoNames[$i] == "Official Trailer"){
                            echo "<option selected = \"selected\" value=\"".$videos[$i]."\">".$videoNames[$i]."</option>";
                        }
                        else {
                            echo "<option value=\"".$videos[$i]."\">".$videoNames[$i]."</option>";
                        }
                    }
                echo
                "</select>
            </div> 
            <div class=\"youtubeVids\">
                <iframe  id=\"youtubePlayer\"
                    src=\"https://www.youtube.com/embed/".$videoKey."?rel=0&enablejsapi=1\"
                    frameborder=\"0\" allow=\"encrypted-media; picture-in-picture\"
                    allowfullscreen autoplay=\"false\">
                </iframe>";
                include 'functions/videoPurge.php';
            echo
            "</div>
        </div>";
    }
    else {
        echo
        "<div id=\"videoPanelDefault\">
            <img src=\"inc/images/trailerImage.png\">
        </div>";
    }
    echo
    "<div id=\"castInfo\">   
        <label>Cast:</label>
        <div id=\"castPics\">";
            for($i = 0; $i < count($castImgs); $i++) {
                $path = "";
                if($castImgs[$i] == null){
                    $path = "inc/images/castImage.png";
                }
                else {
                    $path = "https://image.tmdb.org/t/p/w500" . $castImgs[$i];
                }
                echo
                "<div class=\"castPic\" style=\"background: url(".$path."); background-size: cover; background-position: center;\"> 
                    <form method=\"POST\">  
                        <span class=\"castName\" name=\"actorName\">".$castNames[$i]."</span>
                        <input class=\"castButton\" type=\"submit\" name=\"actorID\" value=\"".$castIDs[$i]."\" />
                    </form>
                </div>";
            }
        echo
        "</div>
    </div>
</div>";

include_once 'inc/footer.php';
?>
