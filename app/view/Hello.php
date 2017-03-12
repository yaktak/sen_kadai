<?php
class Testapp_View_Hello extends Ethna_ViewClass
{
  public function preforward()
  {
    $this->af->setApp('now', strftime('%Y/%m/%d %H:%M.%S'));
    
    require_once('adodb5/adodb.inc.php');

    $db = $this->backend->getDB();

    //$db.query('INSERT INTO test');

    $rows = $db->getAll('select * from app_user');
    $rows_str = "";
    for ($i = 0, $size = count($rows); $i < $size; ++$i) {
        $rows_str .= implode(", ", $rows[$i]) . "\n";
    }
    $this->af->setApp('dbtest', $rows_str);
  }
}
