<?php include(__DIR__."/header.php"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <section class="span8 maincontainer">
      <h1><?php echo $post['title']; ?></h1>
      <!--Body content-->
      <article class="content addrelative aligncenter">
        <div class="aligncenter postimage">
          <img src="/images/<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>"/>
        </div>

        <?php include(__DIR__."/share.php"); ?>
      </article>
      <nav class="aligncenter">
        <?php if ($prev): ?>
        <a id="prev" class="btn btn-primary btn-large" href="<?php echo $prev['url']; ?>" title="<?php echo $prev['title']; ?>">&larr; Prev</a>
      <?php endif; ?>
      <?php $randomPost = current($random); ?>
      <a id="rand" class="btn btn-primary btn-large" href="<?php echo $randomPost['url']; ?>" title="<?php echo $randomPost['title']; ?>">Random</a>
      <?php if ($next): ?>
      <a id="next" class="btn btn-primary btn-large" href="<?php echo $next['url']; ?>" title="<?php echo $next['title']; ?>">Next &rarr;</a>
    <?php endif; ?>

  </nav>

  <?php if ($post['tags']): ?>
  <ul class="inline unstyled hidden-phone aligncenter">
   <?php foreach($post['tags'] as $tag): ?>
   <li>
     <span class="btn-mini btn-info" type="button"><?php echo $tag; ?></span>
   </li>

 <?php endforeach; ?>
</ul>
<?php endif; ?>

<div class="aligncenter hidden-phone">
 <div class="fb-comments" data-href="<?php echo $site['url']; ?><?php echo $post['url']; ?>" data-num-posts="20" data-width="600" data-colorscheme="light"></div>
</div>

<!-- end body content -->
</section>

<aside class="span4">

  <ul class="nav nav-pills hidden-phone asidenav">
    <?php if ($prev): ?>
    <li class="nav-prev">
     <a href="<?php echo $prev['url']; ?>" title="<?php echo $prev['title']; ?>">&larr; Prev</a>
   </li>
 <?php endif; ?>
 <?php if ($next): ?>
 <li class="active">
   <a href="<?php echo $next['url']; ?>" title="<?php echo $next['title']; ?>">Next &rarr;</a>
 </li>
<?php endif; ?>
</ul>
<div class="aligncenter">
  <div class="fb-like-box" data-href="https://www.facebook.com/pages/Funny-Things-Every-Day-247/165172277018867" data-width="292" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
</div>
<!-- First Row of Thumbs -->
<ul class="unstyled inline gallery thumbs-single-side aligncenter">
  <?php for ($i=0; $i < 3; $i++): ?>
  <?php $randomPost = next($random); ?>
  <li>
   <a href="<?php echo $randomPost['url'] ?>"><img src="/images/thumb.<?php echo $randomPost['image'] ?>.jpg" alt="<?php echo $randomPost['title'] ?>" title="<?php echo $randomPost['title']; ?>"/></a>
 </li>
<?php endfor; ?>

</ul>
<!-- end related posts -->
<!-- end related posts -->
<div class="row-fluid aligncenter hidden-phone sideads pull-right">
  <script type="text/javascript"><!--
  google_ad_client = "ca-pub-0274242170859142";
  /* funnythings336x280 */
  google_ad_slot = "8041619564";
  google_ad_width = 336;
  google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<!-- First Row of Thumbs -->
<ul class="unstyled inline gallery thumbs-single-side aligncenter hidden-phone">
  <?php for ($i=0; $i < 3; $i++): ?>
  <?php $randomPost = next($random); ?>
  <li>
   <a href="<?php echo $randomPost['url'] ?>"><img src="/images/thumb.<?php echo $randomPost['image'] ?>.jpg" alt="<?php echo $randomPost['title'] ?>" title="<?php echo $randomPost['title']; ?>"/></a>
 </li>
<?php endfor; ?>
</ul>
<!-- end related posts -->
</aside>

</div>
<div class="row-fluid hidden-phone">
 <h2>More fun</h2>
</div>
<?php for ($i=0; $i < 2; $i++): ?>
  <div class="row-fluid hidden-phone"> 
    <ul class="gallery thumbs-footer unstyled inline aligncenter">
      <?php for ($j=0; $j < 4; $j++): ?>
      <?php $randomPost = next($random); ?>
      <li class="span3">
        <a href="<?php echo $randomPost['url']; ?>"><img src="/images/thumb.<?php echo $randomPost['image']; ?>.jpg" alt="<?php echo $randomPost['title']; ?>" title="<?php echo $randomPost['title']; ?>"/></a>

        <p><strong><?php echo $randomPost['title']; ?></strong></p>

      </li>
    <?php endfor; ?>
  </ul>
</div>
<?php endfor; ?>
<!-- end related posts -->
</div>
</div>
<?php include(__DIR__."/footer.php"); ?>