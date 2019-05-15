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

<body onload="getArticles('')">
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
        <div class="flex-container" id="flex-container">
            <script>
            function getArticles(sql) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var articles = JSON.parse(this.responseText);;
                            console.log(articles);
                            console.log(articles.length);
                        var list = document.getElementById("flex-container");
                           while (list.hasChildNodes()) {
                              list.removeChild(list.firstChild);
                           }
                        
                        for (i = 0; i < articles.length; i++) {
                            //console.log(articles[i]['id']);
                            var flex_container = document.getElementById("flex-container")
                            var flex_item = document.createElement("a");
                            flex_item.setAttribute("class", "flex-item");
                            flex_item.setAttribute("href", "subpage.php?id=" + articles[i]['id']);
                            flex_container.appendChild(flex_item);

                            var img_wrap = document.createElement("div");
                            img_wrap.setAttribute("class", "img-wrap");
                            flex_item.appendChild(img_wrap);

                            if (articles[i]['cover_img'] == '') {
                                var articleIMG = "images/placeholder.png";
                            }else {
                                var articleIMG = articles[i]['cover_img'];
                            }

                            var img = document.createElement("div");
                            img.setAttribute("class", "img");
                            img.setAttribute("style", "background-image: url(http://beekie.nu/portfolio/"+ articleIMG +")");
                            img_wrap.appendChild(img);

                            var details_wrap = document.createElement("div");
                            details_wrap.setAttribute("class", "details-wrap");
                            flex_item.appendChild(details_wrap);

                            var details_back = document.createElement("div");
                            details_back.setAttribute("class", "details-back");
                            details_wrap.appendChild(details_back);

                            var details = document.createElement("div");
                            details.setAttribute("class", "details");
                            details_wrap.appendChild(details);

                            var detailsH1 = document.createElement("h1");
                            var detailsH1Text = document.createTextNode(articles[i]['title']);
                            detailsH1.appendChild(detailsH1Text);
                            details.appendChild(detailsH1);

                            var detailsP = document.createElement("p");
                            var detailsPText = document.createTextNode(articles[i]['subText']);
                            detailsP.appendChild(detailsPText);
                            details.appendChild(detailsP);
                        }
                    }
                };
                xhttp.open("POST", "functions/selectArticles.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("sql=" + sql);
            }
            
            </script>
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