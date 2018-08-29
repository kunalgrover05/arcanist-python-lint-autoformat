<?php
final class BlackLinter extends ArcanistExternalLinter {
  public function getInfoName() {
    return 'black';
  }
  public function getInfoURI() {
    return 'https://github.com/ambv/black';
  }
  public function getInfoDescription() {
    return pht('Use black for processing specified files.');
  }
  public function getLinterName() {
    return 'black';
  }
  public function getLinterConfigurationName() {
    return 'black';
  }
  public function getDefaultBinary() {
    return 'black';
  }
  public function getInstallInstructions() {
    return pht('Make sure black is in directory specified by $PATH');
  }
  protected function getMandatoryFlags() {
    return array("--diff");
  }
  protected function parseLinterOutput($path, $err, $stdout, $stderr) {
    $root = $this->getProjectRoot();
    $path = Filesystem::resolvePath($path, $root);
    $orig = file_get_contents($path);

    // TODO: patch fails when the patch has no changes. Check if the diff was empty
    //       and apply in that case.
    exec("echo ".escapeshellarg($stdout)." | patch ".$path." -r - -o - ", $dest, $status);
    $out = implode("\n", $dest);

    if (!strcmp(implode("\n", $dest), $orig)) {
      return array();
    }

    $message = id(new ArcanistLintMessage())
      ->setPath($path)
      ->setLine(1)
      ->setChar(1)
      ->setGranularity(ArcanistLinter::GRANULARITY_FILE)
      ->setSeverity(ArcanistLintSeverity::SEVERITY_AUTOFIX)
      ->setName('Code format suggestions')
      ->setDescription("Code format changes suggested. Recommendation is to either accept the changes or mark as ignored for future lints.")
      ->setOriginalText($orig)
      ->setReplacementText($out);
    return array($message);
  }
}
