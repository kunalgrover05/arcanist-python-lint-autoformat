<?php
class AutoPEP8Linter extends ArcanistExternalLinter {
  public function getInfoName() {
    return 'autopep8';
  }
  public function getInfoURI() {
    return 'https://github.com/hhatto/autopep8';
  }
  public function getInfoDescription() {
    return pht('Use autopep8 for processing specified files.');
  }
  public function getLinterName() {
    return 'autopep8';
  }
  public function getLinterConfigurationName() {
    return 'autopep8';
  }
  public function getDefaultBinary() {
    return 'autopep8';
  }
  public function getInstallInstructions() {
    return pht('Make sure autopep8 is in directory specified by $PATH');
  }
  protected function parseLinterOutput($path, $err, $stdout, $stderr) {
    $root = $this->getProjectRoot();
    $path = Filesystem::resolvePath($path, $root);
    $orig = file_get_contents($path);

    if (!strcmp($stdout, $orig)) {
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
      ->setReplacementText($stdout);
    return array($message);
  }
}
