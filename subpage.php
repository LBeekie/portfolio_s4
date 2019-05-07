<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styleSub.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <?php
        include("functions/connect.php");
        include("functions/sql.php");
        $id = $_GET['id'];
        $article = sqlSelect("SELECT * FROM article WHERE id=". $id);
        $title = $article[0]['title'];
        $text = $article[0]['text'];
        
        $images = sqlSelect("SELECT * FROM image WHERE article_id=". $id);
        $imageCount = sqlSelect("SELECT count(id) FROM image WHERE article_id=". $id);

    ?>
    
    
<meta charset="utf-8">
<title>Lucas Beekmans | Portfolio</title>
</head>

<body>
    <div class="nav-container" id="header_nav">
        <div class="nav">
            <ul>
                <a href="index.php"><li class="name">Lucas Beekmans</li></a>
                <?php
                    $pages = sqlSelect("SELECT DISTINCT page from article");
                    foreach ($pages as $page) {
                        $page = $page['page'];
                        echo "<li><a href='/'>". $page ."</a></li>";
                    }
                ?>
            </ul>      
        </div>
    </div>
    <div id="nav-placeholder"></div>
    <div class="main-container">
        <div class="close-container">
            <a href="http://beekie.nu/portfolio" class="close"></a>
        </div>
        <div class="slide-container">
            <?php
                $imageID = 1;
                foreach ($images as $image) {
                    $info = $image['info'];
                    $imageSrc = $image['src'];
                    echo "
                        <div class='slide fade'>
                          <div class='slide-numbertext'>". $imageID ." / ". $imageCount[0]['count(id)'] ."</div>
                          <img src='". $imageSrc ."' style='width:100%''>
                          <div class='slide-text'>". $info ."</div>
                        </div>";
                $imageID++;
                }
            ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            
            <div style="text-align:center">
                <?php
                    $slideID = 1;
                    foreach($images as $image) {
                        echo "
                            <span class='dot' onclick='currentSlide(". $slideID .")'></span>";
                    $slideID++;
                    } 
                ?>
            </div>
        </div>
        <div class="info-container">
            <div class="title">
                <h1><?php echo $title?></h1>
            </div>
            <div class="text">
                <p><?php echo $text?></p>
            </div>

        </div>

    </div>
    
    <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("slide");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
    }
    </script>
</body>
</html>