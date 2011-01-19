<?php
$markdown = new CMarkdown;
echo $markdown->transform($data->text);
?>