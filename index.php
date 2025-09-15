<?php
$hasInputs = isset($_GET['a'], $_GET['b'], $_GET['c']);
$resultHtml = '';
$cgIoutput = '';
if ($hasInputs) {
  $a_raw = $_GET['a'];
  $b_raw = $_GET['b'];
  $c_raw = $_GET['c'];

  $a = is_numeric($a_raw) ? (float)$a_raw : null;
  $b = is_numeric($b_raw) ? (float)$b_raw : null;
  $c = is_numeric($c_raw) ? (float)$c_raw : null;

  if ($a === null || $b === null || $c === null || $a == 0) {
    $resultHtml = "<p style='color:#b00020'>Invalid input. Make sure a, b, c are numbers and a ≠ 0.</p>";
  } else {
    $c_cubed = $c ** 3;
    $sqrt_val = $c_cubed ** 0.5;
    $division = $sqrt_val / $a;
    $multiplication = $division * 10;
    $result = $multiplication + $b;

    $resultHtml = "
      <div style='background:#fff;border:1px solid #ccd;padding:12px;border-radius:8px;max-width:720px'>
        <h3>Calculation Steps (PHP)</h3>
        <ul>
          <li>c³ = {$c_cubed}</li>
          <li>sqrt(c³) = {$sqrt_val}</li>
          <li>sqrt(c³) / a = {$division}</li>
          <li>(sqrt(c³) / a) × 10 = {$multiplication}</li>
          <li><strong>Final result = {$result}</strong></li>
        </ul>
        <p><strong>Calculation completed at:</strong> " . date('Y-m-d H:i:s') . "</p>
      </div>
    ";

    $a_q = urlencode($a_raw);
    $b_q = urlencode($b_raw);
    $c_q = urlencode($c_raw);
    $url = "http://127.0.0.1/cgi-bin/calculate.py?a={$a_q}&b={$b_q}&c={$c_q}";
    $cgIoutput = @file_get_contents($url);
    if ($cgIoutput === false) {
      $cgIoutput = "<p style='color:#b00020'>Python CGI not reachable or returned an error.</p>";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>assignment2 - Henrique</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;background:#f0f5fe;margin:20px;color:#265c8d}
    .container{max-width:880px}
    .card{background:#fff;border:1px solid #cdd;border-radius:10px;padding:16px;margin-bottom:16px}
    input[type=text]{padding:8px;border:1px solid #aac;border-radius:6px;width:140px;margin:6px 0}
    input[type=submit]{padding:10px 14px;border:none;border-radius:8px;background:#265c8d;color:#fff;cursor:pointer}
    .result, .cgi {margin-top:12px}
    h1,h2{margin:6px 0}
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h1>assignment2</h1>
      <h2>Henrique</h2>
      <p>Web Server - simple calculator (Python CGI + PHP)</p>
    </div>

    <div class="card">
      <h3>Enter values</h3>
      <form method="get" action="/index.php">
        a: <input type="text" name="a" value="<?php echo isset($_GET['a'])?htmlspecialchars($_GET['a']):''; ?>"><br>
        b: <input type="text" name="b" value="<?php echo isset($_GET['b'])?htmlspecialchars($_GET['b']):''; ?>"><br>
        c: <input type="text" name="c" value="<?php echo isset($_GET['c'])?htmlspecialchars($_GET['c']):''; ?>"><br>
        <input type="submit" value="Calculate">
      </form>

      <?php if ($hasInputs): ?>
        <div class="result">
          <?php echo $resultHtml; ?>
        </div>

        <div class="cgi card">
          <h3>Output from Python CGI</h3>
          <?php echo $cgIoutput; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
