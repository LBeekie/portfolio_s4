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
                <div class="nav-left">
                    <a href="index.php"><h1 class="name">Lucas Beekmans</h1></a>
                </div>
                <div class="nav-right noselect">
                    <!--<svg width="48" height="48">
                        <path class="search-icon" d="M46.8,41.2L36.4,30.7c-0.1-0.1-0.1-0.1-0.2-0.1c2.1-3.1,3.2-6.8,3.2-10.8C39.5,8.8,30.6,0,19.7,0S0,8.8,0,19.7
		                c0,10.9,8.8,19.7,19.7,19.7c4,0,7.7-1.2,10.8-3.2c0.1,0.1,0.1,0.1,0.1,0.2l10.4,10.4c1.6,1.6,4.1,1.6,5.7,0
		                C48.4,45.3,48.4,42.7,46.8,41.2z M19.7,32.6c-7.1,0-12.9-5.8-12.9-12.9c0-7.1,5.8-12.9,12.9-12.9c7.1,0,12.9,5.8,12.9,12.9
		                S26.9,32.6,19.7,32.6z"/>
                    </svg>-->
                    <svg id="filter-icon" width="48" height="48" onclick="showFilter();">
                        <path class="filter-icon" d="M6.3,11.2H2c-1.1,0-2-0.9-2-2.2c0-1.1,0.9-2,2-2h4.4C7.2,4.9,9.4,3.1,12,3.1s4.8,1.7,5.7,3.9H46
                        c1.1,0,2,0.9,2,2s-0.9,2-2,2H17.7c-0.9,2.4-3.1,4.1-5.7,4.1S7.2,13.4,6.3,11.2z M12,11.2c1.1,0,2-0.9,2-2s-0.9-2-2-2
                        c-1.1-0.2-2,0.7-2,1.7C10,10.3,10.9,11.2,12,11.2z M26.4,27.1H2c-1.1,0-2-0.9-2-2s0.9-2,2-2h24.4c0.9-2.4,3.1-3.9,5.7-3.9
                        s4.8,1.7,5.7,3.9H46c1.1,0,2,0.9,2,2c0,1.1-0.9,2-2,2h-8.3c-0.9,2.4-3.1,3.9-5.7,3.9S27.3,29.5,26.4,27.1z M32.1,27.1
                        c1.1,0,2-0.9,2-2s-0.9-2-2-2c-1.1,0-2,0.9-2,2S31,27.1,32.1,27.1z M6.3,43.1H2c-1.1,0-2-0.9-2-2s0.9-2,2-2h4.4
                        c0.9-2.4,3.1-3.9,5.7-3.9s4.8,1.7,5.7,3.9H46c1.1,0,2,0.9,2,2s-0.9,2-2,2H17.7C16.8,45.5,14.6,47,12,47S7.2,45.5,6.3,43.1z M12,43.1
                        c1.1,0,2-0.9,2-2s-0.9-2-2-2s-2,0.9-2,2S10.9,43.1,12,43.1z"/>
                    </svg>
                    
                    <div class="filter-modal hide noselect" id="filter-modal">
                        <form onsubmit="filterArticles();">
                            <?php 
                            $filters = sqlSelect("SELECT * FROM tag");
                            foreach ($filters as $filter) {
                                $id = $filter['id'];
                                $filterItem = $filter['tag'];
                                echo "<input type='checkbox' name='filter' value='".$filterItem."'> ".$filterItem."<br>";
                            }
                            ?>
                            <button type="button" onClick="filterArticles();" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="nav-placeholder"></div>
        <div class="flex-container">
            <?php
            $articles = sqlSelect("SELECT * FROM article");
            //print_r ($articles);
            foreach ($articles as $article) {
                $id = $article['id'];
                
                //Get tags
                $tags = sqlSelect("SELECT * FROM article_tag at LEFT OUTER JOIN tag t ON t.id=at.tag_id WHERE at.article_id=".$id);
                $tagList = "";
                foreach ($tags as $tag) {
                    $tagList .= " ".$tag['tag'];
                }

                $image = $article['cover_img'];
                if ($image == "") {
                    $image = "images/placeholder.png";
                }
                
                $title = $article['title'];
                $subText = $article['subText'];
                ?>
                <a href="subpage.php?id=<?php echo $id ?>" class="<?php echo "flex-item filterDiv article".$id . $tagList?>">
                    <div class="img-wrap">
                        <div class="img" style="background-image: url('http://beekie.nu/portfolio/<?php echo $image?>');">
                        
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

function filterArticles() {
    var x = document.getElementsByClassName("filterDiv");
    var form = document.forms[0];
    console.log(form.length);
    var filter;
    var i, o;
    for (o = 0; o < x.length; o++) { //o = article number
        for (i = 0; i < form.length; i++) {
            if(form[i].checked) {
                filter = form[i].value;
                console.log(filter);
                if(x[o].classList.contains(filter)) {
                    x[o].style.display = "block";
                    break;
                }else {
                    x[o].style.display = "none";
                }    
            }       
        }
    }
}
    
function showFilter() {
    var modal = document.getElementById('filter-modal');
    if(modal.classList.contains('hide')) {
        modal.classList.remove('hide');
    }else {
        modal.classList.add('hide');
    }
}
    
$(document).mouseup(function(e) {
    var container = $("#filter-modal");
    var container2 = $("#filter-icon");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0) {
        container.addClass('hide');
    }
});

</script>
</body>
</html>