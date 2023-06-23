<?php

$xml = ('C:/Users/daba/Downloads/Book1.xml');
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);
$wb = $xmlDoc->getElementsByTagName('Workbook')->item(0);
$ws = $wb->getElementsByTagName('Worksheet')->item(0);
$table = $ws->getElementsByTagName('Table')->item(0);
$row = $table->getElementsByTagName('Row');

$fields = array();
foreach ($row as $rowkey => $rowValue) {
    $cell = $rowValue->getElementsByTagName('Cell');
    foreach ($cell as $cellKey => $cellValue) {
        echo $cellValue->getElementsByTagName('Data')[0]->nodeValue.' - ';
    }
    echo '<br>';
    // $fields[$key]['title'] = $value->getElementsByTagName('title')[0]->nodeValue;
    // $fields[$key]['description'] = $value->getElementsByTagName('description')[0]->nodeValue;
    // $fields[$key]['image'] = $value->getElementsByTagName('enclosure')[0]->attributes['url']->value;
    // $fields[$key]['link'] = $value->getElementsByTagName('guid')[0]->nodeValue;
}
