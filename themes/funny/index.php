<?php include(__DIR__."/header.php"); ?>
<div class="row-fluid">
	<section class="span7 maincontainer">
		<?php foreach($posts as $post): ?>
		<a href="<?php echo $site['url']; ?><?php echo $post['url']; ?>">
			<h2><?php echo $post['title']; ?></h1>
			</a>	
			<!--Body content-->
			<article class="content addrelative ">
				
				<div class="aligncenter postimage">
					<a href="<?php echo $site['url']; ?><?php echo $post['url']; ?>"><img src="<?php echo $site['url']; ?>/images/<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>"/></a>
				</div>

			</article>
			<!-- end body content -->
		<?php endforeach; ?>


		<!-- Pagination links -->
		<ul class="pager">
			<?php if($prev): ?>
			<li>
				<a href="<?php echo $site['url']; ?><? echo $prev['url']; ?>" rel="prev">&larr; <?php echo SITE_NEWER; ?></a>
			</li>
		<?php else: ?>
		<li class="disabled">
			<a href="#">&larr; <?php echo SITE_NEWER; ?></a>
		</li>
	<?php endif; ?>

	<?php if($next): ?>
	<li>
		<a href="<?php echo $site['url']; ?><? echo $next['url']; ?>" rel="next"><?php echo SITE_OLDER; ?> &rarr;</a>
	</li>
<?php else: ?>
	<li class="disabled">
		<a href="#"><?php echo SITE_OLDER; ?> &rarr;</a>
	</li>
<?php endif; ?>

</ul>
</section>

<aside class="span5 hidden-phone pull-right">
	<!-- Pagination links -->
	<ul class="pager asidenav">
		<?php if($prev): ?>
		<li>
			<a href="<?php echo $site['url']; ?><? echo $prev['url']; ?>" rel="prev">&larr; <?php echo SITE_NEWER; ?></a>
		</li>
	<?php else: ?>
	<li class="disabled">
		<a href="#" >&larr; <?php echo SITE_NEWER; ?></a>
	</li>
<?php endif; ?>

<?php if($next): ?>
	<li>
		<a href="<?php echo $site['url']; ?><? echo $next['url']; ?>" rel="next"><?php echo SITE_OLDER; ?> &rarr;</a>
	</li>
<?php else: ?>
	<li class="disabled">
		<a href="#"><?php echo SITE_OLDER; ?> &rarr;</a>
	</li>
<?php endif; ?>

</ul>
<div class="aligncenter">
	<div class="fb-like-box" data-href="https://www.facebook.com/pages/Funny-Things-Every-Day-247/165172277018867" data-width="292" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
</div>
<ul class="unstyled inline gallery thumbs-index aligncenter hidden-phone">
	<?php for ($i=0; $i < 2; $i++): ?>
	<?php $randomPost = next($random); ?>
	<li>
		<a href="<?php echo $site['url']; ?><?php echo $randomPost['url'] ?>"><img src="<?php echo $site['url']; ?>/images/thumb.<?php echo $randomPost['image'] ?>.jpg" alt="<?php echo $randomPost['title'] ?>" title="<?php echo $randomPost['title']; ?>"/></a>
	</li>
<? endfor; ?>

</ul>
<div class="row-fluid aligncenter">
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
<ul class="unstyled inline gallery thumbs-index aligncenter hidden-phone">
	<?php for ($i=0; $i < 22; $i++): ?>
	<?php $randomPost = next($random); ?>
	<li>
		<a href="<?php echo $site['url']; ?><?php echo $randomPost['url'] ?>"><img src="<?php echo $site['url']; ?>/images/thumb.<?php echo $randomPost['image'] ?>.jpg" alt="<?php echo $randomPost['title'] ?>" title="<?php echo $randomPost['title']; ?>"/></a>
	</li>
<? endfor; ?>

</ul>
</aside>

</div>


<?php include(__DIR__."/footer.php"); ?>