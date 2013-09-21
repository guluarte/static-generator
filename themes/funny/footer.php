    </div>
    <hr>
    <footer class="width940 aligncenter">
      <p>&copy;<?php echo $site['name']; ?> <?php echo date("Y"); ?> - <a href="/privacy.html"><?php echo SITE_PRIVACY_TITLE; ?></a></p>
    </footer>

  </div>
  <?php include(__DIR__."/analytics.php"); ?>
  <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="/assets/bootstrap/js/bootstrap.min.js?version=<?php echo $site['version'];?>"></script>
   <script src="/assets/custom.js?version=<?php echo $site['version'];?>"></script>
</body>
</html>