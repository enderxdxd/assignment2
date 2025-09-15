<?php
$hasInputs = isset($_GET['a'], $_GET['b'], $_GET['c']);
$resultHtml = '';

if ($hasInputs) {
  $a = urlencode($_GET['a']);
  $b = urlencode($_GET['b']);
  $c = urlencode($_GET['c']);
  $url = "http://127.0.0.1/cgi-bin/calculate.py?a={$a}&b={$b}&c={$c}";
  $resultHtml = @file_get_contents($url);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assignment 2</title>
</head>
<body>
  <h1>Assignment 2</h1>
  <form method="get" action="/index.php">
    a: <input type="text" name="a"><br>
    b: <input type="text" name="b"><br>
    c: <input type="text" name="c"><br>
    <input type="submit" value="Calculate">
  </form>
  <?php if ($hasInputs): ?>
    <div><?php echo $resultHtml; ?></div>
  <?php endif; ?>
</body>
</html>
