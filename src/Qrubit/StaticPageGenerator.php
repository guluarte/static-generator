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
		$postFolder = 'page/'.base_convert(mt_rand(0,100), 10, 32);
		@mkdir($this->public.'/'.$postFolder);
		$postFile = $postFolder."/".$slug.".html";
		$postUrl = "/".$postFile;
		$title = trim(htmlentities($post['title'], ENT_QUOTES, 'UTF-8'));

		$this->posts[] = array(
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
			);
		$this->addFileToList($postUrl);
		$this->addPostToFacebookPoster( array(
			'title' => $title,
			'url' => $this->site['url'] . $postUrl,
			'image' => $this->site['url'] . $post['image'],
			'thumb' => $this->site['image_path']."thumb480x360.".$post['image'].".jpg",
			));

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
		$randomPost = array();
		for ($i=0; $i < $num; $i++) {
			$rndNumber = mt_rand(0, $this->getNumPosts()); 
			$randomPost[] = $this->posts[$rndNumber];
		}
		return $randomPost;
	}
	public function generate() {
		echo "Generating ";
		foreach ($this->posts as $id => $post) {
			if (!file_exists($this->public ."/". $post['file'])) {
			#Navigation
				if ($id > 0) {
					$prev = $this->posts[($id-1)];
				} else {
					$prev = false;
				}
				if (isset($this->posts[($id+1)])) {
					$next = $this->posts[($id+1)];
				} else {
					$next = false;
				}

				$randomPost = $this->getRandomPost(30);
				$lastestPosts = $this->getLastestPosts();

				$vars = array(
					'site' => $this->site,
					'post' => $post,
					'random' => $randomPost,
					'lastestPosts' => $lastestPosts,
					'next' => $next,
					'prev' => $prev,
					);
				$postResult = $this->renderFile($this->postFile, $vars);
				echo ".";

				file_put_contents($this->public ."/". $post['file'], $postResult);
			}
			$this->urlList[] = '/'.$post['file'];
		}
		echo "Creating index.\n";
		$this->generateIndex();
		echo "Creating sitemap.\n";
		$this->generateSiteMap();
		echo "\nDone\n";

	}
	private function generateIndex() {
		$numPost = $this->getNumPosts();
		$numPostPerPage = 10;
		$numPages = round( ($numPost / $numPostPerPage), 0);
		$prev = array();
		$next = array();
		for ($i=0; $i < $numPages; $i++) { 
			$nextId = $i+1;
			$prevId = $i-1;

			if ($i == 0) {
				$prev = false;
				$next['url'] = "/page".$nextId.".html";
			} 
			if ($i == 1) {
				$prev['url'] = "/index.html";
				$next['url'] = "/page".$nextId.".html";
			}
			if ($i > 1 && $i < $numPages) {
				$prev['url'] = "/page".$prevId.".html";
				$next['url'] = "/page".$nextId.".html";
			}
			if ($i == ($numPages-1)) {
				$next['url'] = "/index.html";
			} 

			if ($i == 0) {
				$filename = "index.html";
			}  else {
				$filename = "page".$i.".html";
			}
			$offset = $i * $numPostPerPage;
			$posts = $this->getNextPosts(10, $offset);

			$randomPost = $this->getRandomPost(25);

			$post = array(
				'title' => $this->site['name'],
				'url' => '/'.$filename,
				'image' => 'default.jpg',
				);

			$vars = array(
				'site' => $this->site,
				'post' => $post,
				'posts' => $posts,
				'random' => $randomPost,
				'next' => $next,
				'prev' => $prev,
				);

			$renderResult = $this->renderFile($this->indexFile, $vars);

			$this->addFileToList('/'.$filename);
			$this->urlList[] = '/'.$filename;
			file_put_contents($this->public.'/'.$filename, $renderResult);

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
		$this->closeFileListHandler();
		$pageDirs = $this->getListDirs($this->public."/page/");
		foreach ($pageDirs as $pageDir) {
			$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/page/".$pageDir."/* s3://".$bucket."/page/".$pageDir."/";
			echo $deployCmd."\n";
			system($deployCmd);
		}

		$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/assets/* s3://".$bucket."/assets/ --add-header 'Cache-Control: public, max-age=31600000' ";
		echo $deployCmd."\n";
		system($deployCmd);

		$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$this->public."/* s3://".$bucket."/ --exclude='assets/*' --exclude='page/*'";
		echo $deployCmd."\n";
		system($deployCmd);
	}
	private function generateSiteMap() {
		$sitemap = "";
		foreach ($this->urlList as $url) {
			$sitemap .= $this->site['url'].$url."\n";
		}
		file_put_contents($this->public."/sitemap.txt", $sitemap);
		unset($sitemap);
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