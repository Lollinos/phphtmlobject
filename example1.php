$table = new table();
$column = new column();
$table->inizializeOnlyBody(10)->getBodyIndex(3)->addRows(3)->addColumn()->addColumnByIndex(1)->addColumnByObject($column->addHtml("prova"));//->addColumn()->addHtml("prova")->getContent());
var_dump($table->getContent());
