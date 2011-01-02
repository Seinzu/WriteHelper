<p>
<?php
$Markdown = new CMarkdown;
$Markdown->purifyOutput = true;
echo $Markdown->transform($data->text);
?>
</p>