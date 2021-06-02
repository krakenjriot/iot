<?php 
// $content holds your raw content
$content = "";
$content_processed = preg_replace_callback(
  '#\<pre\>(.+?)\<\/pre\>#s',
  create_function(
    '$matches',
    'return "<pre>".htmlentities($matches[1])."</pre>";'
  ),
  $content
);


echo $content_processed;
echo $content;

?>

<h1>An article with PHP code</h1>

<pre>
  <?php echo 'hi'; ?>
  <br/>
  <?php echo 'oh hey there'; ?>
</pre>

<p>
  The above and below pre tags will be
  rendered as code on the screen
</p>

<pre>
  <?php echo 'hello for a second time'; ?>
  <br/>
  <?php echo 'yep, here we are again'; ?>
</pre>

<p>
  Thanks for reading!
</p>

*/