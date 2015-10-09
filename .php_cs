<?php

use Symfony\CS\Fixer\Contrib\HeaderCommentFixer;

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__)
;

$header = <<<EOF
This file is part of the RestBundle package.

(c) EXSyst

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;
HeaderCommentFixer::setHeader($header);

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(array('align_double_arrow', 'header_comment'))
    ->finder($finder)
    ->setUsingCache(true)
;
