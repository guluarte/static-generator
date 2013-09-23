    </div>
    <hr>
    <footer class="width940 aligncenter">
      <p>&copy;<?php echo $site['name']; ?> <?php echo date("Y"); ?> - <a href="<?php echo $site['url']; ?>/privacy.html"><?php echo SITE_PRIVACY_TITLE; ?></a> - <a href="https://plus.google.com/u/0/b/108808691043819734649/?rel=author" rel="author">Follow us on Goolge+</a></p>
    </footer>

  </div>
  <?php include(__DIR__."/analytics.php"); ?>
  <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="<?php echo $site['url']; ?>/assets/bootstrap/js/bootstrap.min.js?version=<?php echo $site['version'];?>"></script>
   <script src="<?php echo $site['url']; ?>/assets/custom.js?version=<?php echo $site['version'];?>"></script>
</body>
</html>