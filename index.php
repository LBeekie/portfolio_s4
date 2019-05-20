<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lucas Beekmans | Portfolio</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <?php
        include ("functions/sql.php");
    ?>
</head>

<body>
    <div class="main-container">
        <div class="welcome-container">
            <div class="welcome">
                <div class="text">
                    <h1 >Lucas Beekmans</h1>
                    <h2>Portfolio</h2>
                </div>
                <div class="arrow-container">
                    <div class="arrow"></div>                
                </div>
            </div>
        </div>
        <div class="placeholder"></div>
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
        <div class="flex-container">
            <?php
            $articles = sqlSelect("SELECT * FROM article");
            //print_r ($articles);
            foreach ($articles as $article) {
                $id = $article['id'];
                $image = sqlSelect("SELECT src FROM image WHERE article_id = ". $id ." LIMIT 1");
                //print_r ($image);
                //$image = $image['src'];
                $images = $image[0]['src'];
                $title = $article['title'];
                $subText = $article['subText'];
                ?>
                <a class="flex-item" href="subpage.php?id=<?php echo $id ?>">
                    <div class="img-wrap">
                        <div class="img" style="background-image: url('http://beekie.nu/portfolio/<?php echo $images?>');">
                        
                        </div>
                    </div>
                    <div class="details-wrap">
                        <div class="details-back"></div>
                        <div class="details">
                            <h1><?php echo $title ?></h1>
                            <p><?php echo $subText ?></p>                       
                        </div>

                    </div>
                    
                </a>
                <?php
            }
            ?>
        </div>
    </div>
    
<script type="text/javascript">    
var elementPosition = $('#header_nav').offset();

$(window).scroll(function () {
    var navHeight = $('.nav-container').height()
    if ($(window).scrollTop() > elementPosition.top) {
        $('#header_nav').css('position', 'fixed').css('top', '0');
        $('#nav-placeholder').css('height', navHeight);
    } else {
        $('#header_nav').css('position', 'relative');
        $('#nav-placeholder').css('height', '0px');
    }
 });
    
$(window).scroll(function() {
  var scrollTop = $(this).scrollTop();

  $('.text').css({
    opacity: function() {
      var elementHeight = $(this).height(),
          opacity = ((0 + (elementHeight - scrollTop) / elementHeight) * 0.8) + 1;
          
      return opacity;
    }
  });
});
</script>
</body>
</html>