<?php

require_once __DIR__ . '\ParserVideoUrl.php';

$obParserVideoUrl = new ParserVideoUrl($_REQUEST['URL']);

echo json_encode(
    [
        'NAME_HOST' => $obParserVideoUrl->getNameHost(),
        'VIDEO_ID' => $obParserVideoUrl->getVideoId(),
        'HTML_FRAME' => $obParserVideoUrl->getHtmlFrame(),
        'ERROR' => $obParserVideoUrl->getError()
    ];
);
