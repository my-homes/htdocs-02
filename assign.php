<?php
require_once('./smarty/libs/Smarty.class.php');

use \Smarty\Smarty;

function convert_title(string $title): string
{
    $found = strpos($title, '👀作品タイトル👀: ');
    if ($found === false) {
        $title = '【XXX】' . trim(explode('#', $title)[0]);
    } else {
        $title = substr($title, $found);
        $title = str_replace('👀作品タイトル👀: ', '', $title);
        $title = '【DMM】' . trim(explode('サンプルムービー: ', $title)[0]);
    }
    return $title;
}

function convert_data(mixed $data, int $pos): array
{
    $title = $data[2];
    $url = $data[3];
    $view = $data[4];
    if ($pos > 0)
    {
        $title = convert_title($title);
        $title = mb_strimwidth($title, 0, 50, "…", 'UTF-8');
        $view = intval($view);
    }
    return array(
        'title' => $title,
        'url' => $url,
        'view' => $view,
    );
}

$smarty = new Smarty;
$smarty->debugging = false;

$smarty->assign('x', 123);
$home = getenv('HOME');
$smarty->assign('home', $home);

//'D:\home12\dart\twitter.json'
$cont = file_get_contents($home .'\dart\twitter.json');
$json = json_decode($cont, true);
//$smarty->assign('_json', $json);

$map = array();
foreach ($json as $item)
{
    $url = $item['url'];
    $map[$url] = $item;
}
//$smarty->assign('__map', $map);

$array = array();
$fp = fopen('C:\Users\user\Downloads\xxx.csv', "r");
$pos = 0;
while($data = fgetcsv($fp)){
    if ($data[0] == '') continue;
    if ($pos > 0)
    {
        $array[] = convert_data($data, $pos);
    }
    $pos++;
}
//$smarty->assign('array', $array);

$array0 = array();
$fp = fopen('C:\Users\user\Downloads\xxx.csv', "r");
while($data = fgetcsv($fp)){
    if ($data[0] == '') continue;
    $array0[] = $data;
}
//$smarty->assign('array0', $array0);

$list = array();
foreach ($array as $item)
{
    $url = $item['url'];
    if (array_key_exists($url, $map))
    {
        $old = $map[$url];
        $view_plus = $item['view'] - $old['view'];
    }
    else
    {
        $view_plus = $item['view'];
    }
    $item['view+'] = $view_plus;
    $list[] = $item;
}
usort($list, function($a, $b)
{
    if ($a['view+'] != $b['view+'])
    {
        return $a['view+'] <=> $b['view+'];
    }
    return $a['view'] <=> $b['view'];
});
$smarty->assign('list', $list);

$total = 0;
$diff_total = 0;
foreach ($list as $item)
{
    $total += $item['view'];
    $diff_total += $item['view+'];
}

$smarty->assign('total', $total);
$smarty->assign('diff_total', $diff_total);

$smarty->display('assign.tpl');
