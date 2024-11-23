<?php
/**
 * @frontend/modules/letter/site/index.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Main view for displaying letter content.
 *
 * @var yii\web\View $this
 * @var array $bodyContent Contains the processed content items
 * @var string|null $faqLink FAQ link generated from body content
 */
$bodyContent = $this->params['bodyContent'];

/*
var_dump($this->params['rawContent']);
var_dump($this->params['rawItem']);
var_dump($this->params['htmlContent']);
var_dump($bodyContent);
var_dump($this->params['assetUrl']);
var_dump($this->params['basePath']);
var_dump($this->params['basename']);
var_dump($this->params['frontend']);
 */
?><section class="py-1"><?= $this->render('@app/modules/letter/layouts/languages.php') ?><div class="container my-4"><?= $this->params['faqLink'] ?><?php foreach ($bodyContent as $index => $contentItem): ?><?php $layoutFile=$index%2===0?'@app/modules/letter/layouts/letter-row-left.php':'@app/modules/letter/layouts/letter-row-right.php'; ?><?=$this->render($layoutFile,['contentItem'=>$contentItem['content'],'image'=>$contentItem['image'],])?><?php endforeach; ?><?= $this->params['faqLink'] ?></div><?= $this->render('@app/modules/letter/layouts/letter-foot.php') ?></section>
