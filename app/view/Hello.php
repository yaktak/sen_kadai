<?php
class Testapp_View_Hello extends Ethna_ViewClass
{
  public function preforward()
  {
    $this->af->setApp('now', strftime('%Y/%m/%d'));
    
    require_once('adodb5/adodb.inc.php');

    $db = $this->backend->getDB();
    $rs = $db->query('SELECT * FROM test');
    $this->af->setApp('dbtest', implode("l", $rs->GetAll()[0]));
  }
}
