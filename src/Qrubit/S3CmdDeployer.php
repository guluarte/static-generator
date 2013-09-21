<?php
namespace Qrubit;
class S3CmdDeployer {
	
	private $bucket;

	public function __construct($bucket) {
		$this->bucket = $bucket;
	}
	public function deploy($sourceDir, $destDir) {
		$pageDirs = $this->getListDirs($sourceDir);
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
}