<?php
// YAPF command line conforms with AutoPEP8
final class YAPFLinter extends AutoPEP8Linter {
  public function getInfoName() {
    return 'yapf';
  }

  public function getInfoURI() {
    return 'https://github.com/google/yapf';
  }

  public function getInfoDescription() {
    return pht('Use yapf for processing specified files.');
  }

  public function getLinterName() {
    return 'yapf';
  }

  public function getLinterConfigurationName() {
    return 'yapf';
  }

  public function getDefaultBinary() {
    return 'yapf';
  }

  public function getInstallInstructions() {
    return pht('Make sure yapf is in directory specified by $PATH');
  }
}
