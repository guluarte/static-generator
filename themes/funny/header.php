<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $post['title']; ?></title>
  <meta name="author" content="<?php echo $site['author']; ?>">
  <link rel="canonical" href="<?php echo $site['url']; ?><?php echo $post['url']; ?>" />
  <!-- Enable responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <!-- styles -->
      <link href="/assets/themes/twitter/bootstrap/css/bootstrap.2.2.2.min.css?version=<?php echo $site['version'];?>" rel="stylesheet" type="text/css" >
      <link href="/assets/themes/twitter/css/style.css?body=1&version=<?php echo $site['version'];?>" rel="stylesheet" type="text/css" media="all">
      <link rel="shortcut icon" href="/favicon.ico?version=<?php echo $site['version'];?>">
     
      <link rel="apple-touch-icon" href="/img/apple-touch-icon.png?version=<?php echo $site['version'];?>">
      <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png?version=<?php echo $site['version'];?>">
      <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png?version=<?php echo $site['version'];?>">
     
      <!-- Facebook metatags -->
      <?php 
      if(isset($post['image'])):
          $image = $site['image_path']."thumb480x360.".$post['image'].".jpg";
        else: 
          $image = $site['image_path']."default.jpg?version=".$site['version'];
        endif; 
      ?>
      <meta property="og:image" content="<?php echo $image; ?>"/>
      <meta property="og:title" content="<?php echo $post['title']; ?>"/>
      <meta property="og:url" content="<?php echo $site['url']; ?><?php echo $post['url']; ?>"/>
      <meta property="og:site_name" content="<?php echo $site['name']; ?>"/>
      <meta property="og:type" content="blog"/>
      <meta property="fb:admins" content="547998939"/>
      <!-- end facebook metatags -->
      <link href="/assets/custom.css?version=<?php echo $site['version'];?>" rel="stylesheet" type="text/css" >

    </head>

    <body>
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=583195078383535";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <header class="container-fluid width940">
        <div class="row-fluid menu">
          <div class="span4">
            <a href="/" class="logo"><h1>Funny Things 24/7</h1></a>
          </div>
          <div class="span7">
            <div class="hidden-phone">
             <script type="text/javascript"><!--
             google_ad_client = "ca-pub-0274242170859142";
             /* funnthings728x90 */
             google_ad_slot = "3611419966";
             google_ad_width = 728;
             google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</div>
</div>
</header>
<div class="container-fluid width940 ">
  <div class="content">