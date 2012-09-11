<?php
/**
 * Pushes changes, but checks for changes and asks for confirmation first.
 */
class GitConfirmedPushTask extends SilverStripeBuildTask {

	private $dir  = null;

	private $gitPath = 'git';

	private $msg = 'Happy to push?';

	public function setDir($dir) {
		$this->dir = $dir;
	}

	public function setGitPath($gitPath) {
		$this->gitPath = $gitPath;
	}

	public function setMsg($msg) {
		$this->msg = $msg;
	}

	public function main() {
		if (!is_dir($this->dir)) {
			throw new BuildException("Invalid directory: $this->dir");
		}

		$cwd = realpath(getcwd());
		chdir($this->dir);

		$currentBranch = str_replace(array("\n","\r"), '', $this->exec("$this->gitPath rev-parse --abbrev-ref HEAD", true));
		$remote = str_replace(array("\n","\r"), '', $this->exec("$this->gitPath config --get branch.{$currentBranch}.remote", true));
		$remoteBranch = basename(str_replace(array("\n","\r"), '', $this->exec("$this->gitPath config --get branch.{$currentBranch}.merge", true)));

		$changes = $this->exec("$this->gitPath diff $currentBranch..{$remote}/{$remoteBranch}", true);
		if($changes) {
			if($this->getInputConfirmation($this->msg)) {
				$result = $this->exec("$this->gitPath push", true);
				$this->log($result);
			}	
		} else {
			$this->log('No changes detected');
		}

		chdir($cwd);
		return;
	}
}