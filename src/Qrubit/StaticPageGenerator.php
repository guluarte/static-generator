<?php
namespace Qrubit;
class StaticPageGenerator {

	private $posts = array();
	private $lastestPosts = false;
	private $site = array();
	private $fpFileList = false;
	private $facebookFile = false;
	private $theme;
	private $postCount = 0;
	private $postFile;
	private $indexFile;
	private $postUrls = array();
	private $source;
	private $public;
	private $rebuild;
	private $customFiles;
	private $randomize = false;
	private $lang;


	public function __construct($theme, $source = './source', $public = './public', $rebuild = false) {
		$this->theme = $theme;
		$this->postFile = "./themes/".$this->theme."/post.php";
		$this->indexFile = "./themes/".$this->theme."/index.php";
		$this->rebuild = $rebuild;
		$this->site['version'] = time();
		$this->source = rtrim($source, '/');
		$this->public = rtrim($public, '/');
		$this->setup();
	}

	private function setup() {
		if ($this->rebuild) {
			echo "Rebuilding\n";
			$this->cleanPublicDir();
		}
		
		@mkdir($this->public);
		@mkdir($this->public."/page");
		$copyCmd = "cp ".$this->source."/* ".$this->public."/ -r -u";
		system($copyCmd);
	}

	private function cleanPublicDir() {
		if (is_dir($this->public) && isset($this->public)) {
			$rmCmd = "rm ".$this->public."/* -fr";
			system($rmCmd);
		}
	}

	public function addCustomFiles($themeFile, $filename, $meta) {
		$this->customFiles[] = array(
			'themeFile' => "./themes/".$this->theme."/".$themeFile,
			'filename' => $filename,
			'meta' => $meta,
			);
	}

	private function renderCustomFiles() {

		foreach ($this->customFiles as $customFile) {

			$customFile['meta']['url'] = '/'.$customFile['filename'];
			$vars = array(
				'site' => $this->site,
				'post' => $customFile['meta'],
				);
			$this->createFile($customFile['filename'], $customFile['themeFile'], $vars);
			$this->urlList[] = $customFile['meta']['url'];
			$this->addFileToList($customFile['meta']['url']);
		}
	}

	private function addFileToList($filename) {
		if ($this->fpFileList === false) {
			$this->fpFileList = fopen($this->public . "/.filelist", 'w+');
		}
		fwrite($this->fpFileList, $filename . PHP_EOL);
	}
	private function addPostToFacebookPoster($post) {
		if ($this->facebookFile === false) {
			$this->facebookFile = fopen($this->public . "/facebook.posts", 'w+');
		}
		fwrite($this->facebookFile, json_encode($post) . PHP_EOL);		
	}
	private function closeFileListHandler() {
		if ($this->fpFileList) {
			fclose($this->fpFileList);
		}
		
	}

	public function setLang($lang) {
		$this->lang = $lang;
	}

	private function getLangFile() {
		return "./themes/".$this->theme."/lang/".$this->lang.".php";
	}
	private function getLangConstants() {
		include $this->getLangFile();
	}

	public function setSiteAuthor($author) {
		$this->site['author'] = $author;
	}
	public function setSiteName($name) {
		$this->site['name'] = $name;
	}
	public function setSiteUrl($url) {
		$this->site['url'] = rtrim($url, '/');
		$this->site['url_encode'] = urlencode($this->site['url']);
	}
	public function setSiteImagePath($path) {
		$this->site['image_path'] = $path;
		$this->site['image_path_encode'] = urlencode($this->site['image_path']);

	}
	public function isValidPost($post) {
		if (isset($post['title']) && isset($post['image']) && isset($post['tags']) && isset($post['category'])) {
			return true;
		}
	}
	public function setRandomize() {
		$this->randomize = true;
	} 
	public function addPost($post) {
		if (!$this->isValidPost($post)) {
			return;
		}
		$slug = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($post['title']) );
		$slug = preg_replace("/-+/", "-", $slug); 
		$slug = substr($slug, 0, 50);
		$slug = rtrim($slug, '-');
		if (strlen($slug) == 0) {
			return;
		}
		if (!isset($post['tags'])) {
			$post['tags'] = false;
		}

		$postFolder = 'page/'.substr( preg_replace('/[^A-Za-z0-9]/', '', $slug) , 0, 2);

		@mkdir($this->public.'/'.$postFolder);

		#Avoid file overwrite
		$postRepeatedNum = 0;
		do {

			if ($postRepeatedNum == 0) {
				$postFile = $postFolder."/".$slug.".html";
			}  else {
				echo "File duplicated $postFile!\n";
				die();
				$postFile = $postFolder."/".$slug."-".$postRepeatedNum .".html";
			}
			$postRepeatedNum++;
			echo $this->public ."/". $postFile.PHP_EOL;
		} while( isset($this->posts[$postUrl]) );

		$postUrl = "/".$postFile;
		$title = trim(htmlentities($post['title'], ENT_QUOTES, 'UTF-8'));
		$youtubeid = (isset($post['youtubeid'])) ? $post['youtubeid'] : false;
		$custom = (isset($post['custom'])) ? $post['custom'] : false;

		$this->posts[$postUrl] = array(
			'title' => $title,
			'title_encode' => urlencode($post['title']),
			'url' => $postUrl,
			'url_encode' => urlencode( $postUrl ),
			'image' => $post['image'],
			'image_encode' => urlencode($post['image']),
			'slug' => $slug,
			'file' => $postFile,
			'tags' => $post['tags'],
			'category' => $post['category'],
			'youtubeid' => $youtubeid,
			'custom' => $custom,
			);
		$this->addFileToList($postUrl);
		$this->addPostToFacebookPoster( array(
			'title' => $title,
			'url' => $this->site['url'] . $postUrl,
			'image' => $this->site['image_path'] . $post['image'],
			'thumb' => $this->site['image_path']."thumb480x360.".$post['image'].".jpg",
			));

	}
	private function createFile($file, $themeFile, $vars) {
		$renderResult = $this->renderFile($themeFile, $vars);
		file_put_contents($this->public ."/". $file, $renderResult);
	}
	private function getLastestPosts() {
		if ( is_array($this->lastestPosts) ) {
			return $this->lastestPosts;
		}

		$this->lastestPosts = array_slice($this->posts, 0, 10);

		return $this->lastestPosts;
	}
	private function getNumPosts() {
		if ($this->postCount == 0) {
			$this->postCount = count($this->posts);
		}	
		return $this->postCount-1;
	}
	private function getRandomPost($num) {
		#Not enough posts so we return the same 
		if ($this->getNumPosts() < 50) {
			return $this->posts;
		}
		$randomPost = array();
		$rndNumbers = array();
		for ($i=0; $i < $num; $i++) {

			do {
				$rndNumber = mt_rand(0, $this->getNumPosts());
			} while(array_key_exists($rndNumber, $rndNumbers));

			$rndNumbers[$rndNumber] = $rndNumber; 
			$randomPost[] = $this->posts[$rndNumber];
			
		}
		return $randomPost;
	}
	private function randomizePosts() {
		echo "Shuffling.\n";
		shuffle($this->posts);
	}

	public function generate() {
		echo "Generating.\n";
		$this->getLangConstants();
		if ($this->randomize === true) {
			$this->randomizePosts();
		}
		$totalPosts = $this->getNumPosts();
		foreach ($this->posts as $id => $post) {
			if (!file_exists($this->public ."/". $post['file'])) {
			#Navigation
				if ($id > 0) {
					$prev = $this->posts[($id-1)];
				} else {
					$prev = $this->posts[$totalPosts];
				}
				if (isset($this->posts[($id+1)])) {
					$next = $this->posts[($id+1)];
				} else {
					$next = $this->posts[0];
				}

				$randomPost = $this->getRandomPost(50);
				$lastestPosts = $this->getLastestPosts();

				$vars = array(
					'site' => $this->site,
					'post' => $post,
					'random' => $randomPost,
					'lastestPosts' => $lastestPosts,
					'next' => $next,
					'prev' => $prev
					,					
					);
				$this->createFile($post['file'], $this->postFile, $vars);
			}
			$this->urlList[] = '/'.$post['file'];
		}
		echo "Creating index.\n";
		$this->generateIndex();
		echo "Adding custom files\n";
		$this->renderCustomFiles();
		echo "Creating sitemap.\n";
		$this->generateSiteMap();
		echo "\nDone\n";

	}
	private function generateIndex() {
		$numPost = $this->getNumPosts();
		$numPostPerPage = 10;

		$indexPagesDir = "/nav";
		@mkdir($this->public . $indexPagesDir);

		$numPages = round( ($numPost / $numPostPerPage), 0) + 1;
		if ( ($numPost % $numPostPerPage) > 0 ) {
			$numPages++;
		}
		
		$prev = array();
		$next = array();
		for ($i=0; $i < $numPages; $i++) { 
			$nextId = $i+1;
			$prevId = $i-1;

			if ($i == 0) {
				$prev['url'] = $indexPagesDir."/page".($numPages-1).".html";
				$next['url'] = $indexPagesDir."/page".$nextId.".html";
			} 
			if ($i == 1) {
				$prev['url'] = "/";
				$next['url'] = $indexPagesDir."/page".$nextId.".html";
			}
			if ($i > 1 && $i < $numPages) {
				$prev['url'] = $indexPagesDir."/page".$prevId.".html";
				$next['url'] = $indexPagesDir."/page".$nextId.".html";
			}
			if ($i == ($numPages-1)) {
				$next['url'] = "/";
			} 

			if ($i == 0) {
				$filename = "/index.html";
				$url = "/";
			}  else {
				$filename = $indexPagesDir."/page".$i.".html";
				$url = "/".$filename;
			}
			$offset = $i * $numPostPerPage;
			$posts = $this->getNextPosts(10, $offset);

			$randomPost = $this->getRandomPost(25);

			$post = array(
				'title' => $this->site['name'],
				'url' => $url,
				);

			$vars = array(
				'site' => $this->site,
				'post' => $post,
				'posts' => $posts,
				'random' => $randomPost,
				'next' => $next,
				'prev' => $prev,
				'numPages' => $numPages,
				);

			$this->addFileToList('/'.$filename);
			$this->urlList[] = '/'.$filename;


			$this->createFile($filename, $this->indexFile, $vars);

		}
	}
	private function getListDirs($path) {
		$files = scandir($path);
		$dirs = array();
		foreach ($files as $file) {
			if ($file != "." && $file != "..") {
				$file = $file;
				if (is_dir($path . $file)) {
					$dirs[] = $file;
				}
			}

		}

		return $dirs;
	}
	public function deploy($bucket){
		$deployCmds = "";
		$this->closeFileListHandler();

		#Sync home folder
		$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/* s3://".$bucket."/ --exclude='assets/' --exclude='page/' --exclude='images/' --exclude='sitemaps/' --exclude='nav/'";
		#echo $deployCmd."\n";
		$deployCmds .= $deployCmd."\n";

		#Sync assets
		$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/assets/* s3://".$bucket."/assets/ --add-header 'Cache-Control: public, max-age=31600000' ";
		#echo $deployCmd."\n";
		$deployCmds .= $deployCmd."\n";

		#Sync Pages
		$pageDirs = $this->getListDirs($this->public."/page/");
	
		foreach ($pageDirs as $pageDir) {
			$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/page/".$pageDir."/* s3://".$bucket."/page/".$pageDir."/";
			#echo $deployCmd."\n";
			$deployCmds .= $deployCmd."\n";
			#system($deployCmd);
		}

		#Sync nav
		$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/nav/* s3://".$bucket."/nav/";
		#echo $deployCmd."\n";
		$deployCmds .= $deployCmd."\n";

		#Sitemaps
		$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/sitemaps/* s3://".$bucket."/sitemaps/";
		#echo $deployCmd."\n";
		$deployCmds .= $deployCmd."\n";

		file_put_contents("./deploy.sh", $deployCmds);
		
	}
	private function generateSiteMap() {
		@mkdir($this->public .'/sitemaps');

		$numUrlsPerSitemap = 50000;
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
		<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84">'.PHP_EOL;
		
		$numUrls = count($this->urlList)-1;
		$numSitemaps =  round(($numUrls/$numUrlsPerSitemap), 0);
		$numSitemaps = ( ($numUrls % $numUrlsPerSitemap) == 0) ? $numSitemaps : ($numSitemaps+1);

		for ($i=0; $i < $numSitemaps; $i++) {
			$offset = $i * $numUrlsPerSitemap; 
			$singleSitemapUrl = $this->generateSingleSitemap($i, $offset, $numUrlsPerSitemap);
			$sitemap .= "<sitemap>
			<loc>".$singleSitemapUrl."</loc>
			<lastmod>".date("Y-m-d")."</lastmod>
			</sitemap>". PHP_EOL;
		}

		$sitemap .= "</sitemapindex>";

		file_put_contents($this->public."/sitemap.xml", $sitemap);
		unset($sitemap);
	}

	private function generateSingleSitemap($num, $offset, $limit) {
		$sitemap = "";
		$limit = $offset + $limit;
		for ($i = $offset; $i < $limit; $i++) {
			if (isset($this->urlList[$i])) {
				$sitemap .= $this->site['url']. $this->urlList[$i] . PHP_EOL;
			} 
		}

		file_put_contents($this->public .'/sitemaps'."/sitemap-".$num.".txt", $sitemap);
		return $this->site['url']."/sitemaps/sitemap-".$num.".txt";
	}
	private function getNextPosts($amount, $offset) {
		$posts = array();
		$amount = $amount + $offset;
		for ($i = $offset; $i < $amount; $i++) { 
			if (isset($this->posts[$i])) {
				$posts[] = $this->posts[$i];
			}
		}

		return $posts;
	}

	private function renderFile($file, $vars) {
		extract($vars);
		ob_start();
		include $file;
		return ob_get_clean();
	}	
}