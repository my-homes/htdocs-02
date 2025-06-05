<?php
print('abc');
print("\n");
$a = 123;
print($a);
print("\n");
var_dump($a);
print("\n");
$fp = fopen('C:\Users\user\Downloads\xxx.csv', "r");
# テーブルタグを作成し、テーブルヘッダーで見出しを作る
/*
echo '<table border="1">
      <tr>
      <th>ID</th>
      <th>フルーツ</th>
      </tr>';
echo "\n";
echo "\n";
*/

echo '<table border="1">';
echo "\n";
# while文でCSVファイルのデータを1つずつ繰り返し読み込む
while($data = fgetcsv($fp)){
    if ($data[0] == '') continue;
    // テーブルセルに配列の値を格納
    echo '<tr>';
    for ($i = 0; $i < count($data); $i++) {
        echo '<td>'.$data[$i].'</td>';
    }
    echo '<td>'.$data[0].'</td>';
    //echo '<td>'.$data[1].'</td>';
    //echo '</tr>';
    echo "\n";
}

# テーブルの閉じタグ
echo '</table>';

fclose($fp);

var_dump(array(1,2,3));
$array = array(
    "foo" => "bar",
    "bar" => "foo",
    100   => -100,
    -100  => 100,
);
var_dump($array);
echo("\n<br />");
?>
<pre>
<?php echo nl2br(json_encode($array, JSON_PRETTY_PRINT)); ?>
</pre>
