<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <meta charset="utf-8">
  <?php if($post['url'] == '/'):?>
  <!-- redirect here -->
  <script>
  var pageToGo = Math.floor((Math.random()*<?php echo $numPages; ?>)+1);
  window.top.location.href = "<?php echo $site['url']; ?>/nav/page" + pageToGo +".html";
  </script>   
  <!-- randomin redirect end -->
<?php endif; ?>
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
      <link href="<?php echo $site['url']; ?>/assets/themes/twitter/bootstrap/css/bootstrap.2.2.2.min.css?version=<?php echo $site['version'];?>" rel="stylesheet" type="text/css" >
      <link href="<?php echo $site['url']; ?>/assets/themes/twitter/css/style.css?body=1&version=<?php echo $site['version'];?>" rel="stylesheet" type="text/css" media="all">
      <link rel="shortcut icon" href="<?php echo $site['url']; ?>/favicon.ico?version=<?php echo $site['version'];?>">

      <link rel="apple-touch-icon" href="<?php echo $site['url']; ?>/assets/images/apple-touch-icon.png?version=<?php echo $site['version'];?>">
      <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $site['url']; ?>/assets/images/apple-touch-icon-72x72.png?version=<?php echo $site['version'];?>">
      <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $site['url']; ?>/assets/images/apple-touch-icon-114x114.png?version=<?php echo $site['version'];?>">

      <meta name="description" content="<?php echo $post['title']; ?>">
      <!-- Facebook metatags -->
      <?php 
      if(isset($post['image'])):
        $image = $site['image_path']."thumb480x360.".$post['image'].".jpg";
      else: 
        $image = $site['url']."/assets/images/default.jpg?version=".$site['version'];
      endif; 
      ?>
      <meta property="og:image" content="<?php echo $image; ?>"/>
      <meta property="og:title" content="<?php echo $post['title']; ?>"/>
      <meta property="og:description" content="<?php echo $post['title']; ?>" />
      <meta property="og:url" content="http://fb.funnythings247.com/enter.php?next=<?php echo urlencode( $site['url'].$post['url']); ?>"/>
      <meta property="og:site_name" content="<?php echo $site['name']; ?>"/>
      <meta property="og:type" content="website"/>
      <meta property="og:updated_time" content="<?php echo time(); ?>"/>
      <meta property="fb:admins" content="547998939, 100004691232252"/>
      <meta property="fb:page_id" content="165172277018867" />
      <meta property="fb:app_id" content="583195078383535" />

      <!-- end facebook metatags -->
      <?php if(isset($post['image'])): ?>
      <!-- Twitter meta tags -->
      <meta name="twitter:card" content="photo" />
      <meta name="twitter:url" content="<?php echo $site['url']; ?><?php echo $post['url']; ?>" />
      <meta name="twitter:title" content="<?php echo $post['title']; ?>" />
      <meta name="twitter:description" content="<?php echo $post['title']; ?> @funnythings247_" />
      <meta name="twitter:image:src" content="<?php echo $site['image_path'].$post['image']; ?>" />
      <meta name="twitter:site" content="@funnythings247_" />
      <meta name="twitter:creator" content="@funnythings247_" />
      <meta name="twitter:domain" content="funnythings247.com" />
      <!-- end twitter tags -->
    <?php endif; ?>
    <link href="<?php echo $site['url']; ?>/assets/custom.css?version=<?php echo $site['version'];?>" rel="stylesheet" type="text/css" >

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
          <a href="<?php echo $site['url']; ?>/" class="logo"><h1>Funny Things 24/7</h1></a>
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