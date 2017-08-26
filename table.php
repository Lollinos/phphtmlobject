final class table extends HTMLTag {
    function __construct() {
        parent::__construct("table");
    }
    public function inizialize() {
        $this->addHead();
        $this->addBody();
        return $this;
    }
    public function inizializeOnlyBody($number) {
        for($i = 0; $i < $number; $i++)
            $this->addBody();
        return $this;
    }
    public function addHead() {
        return $this->addContent(new head());
    }
    public function addBody() {
        return $this->addContent(new body());
    }
    public function addFooter() {
        return $this->addContent(new footer());
    }
    public function getHead() {
        return $this->getOneContent("head");
    }
    public function getBody() {
        return $this->getOneContent("body");
    }
    public function getBodyIndex($index) {
        return $this->getOneContentByIndex("body",$index);
    }
    public function getFooter() {
        return $this->getOneContent("footer");
    }
}
final class head extends HTMLTag {
    function __construct() {
        parent::__construct("thead");
    }
    public function addRow() {
        return $this->addContent(new row());
    }
}
final class body extends HTMLTag {
    function __construct() {
        parent::__construct("tbody");
    }
    public function addRow() {
        return $this->addContent(new row());
    }
    public function addRows($number) {
		$rows = new rows();
		$rows->addRows($number);
		$this->addContent($rows);
        return $this->getLastContentElement();
    }
}
final class footer extends HTMLTag {
    function __construct() {
        parent::__construct("tfooter");
    }
    public function addRow() {
        return $this->addContent(new row());
    }
}
final class row extends HTMLTag {
    function __construct() {
        parent::__construct("tr");
    }
    public function addColumn() {
		$tmpColumns = $this->getLastContentElement();
		if($tmpColumns == null) $tmpColumns = new columns();
        return $this->addContent($tmpColumns->addColumn());
    }
    public function addColumns($number) {
		$tmpColumns = new columns();
		for($i = 0; $i < $number; $i++) $tmpColumns->addColumn();
        return $this->addContent($tmpColumns);
    }
    public function addColumnByObject($column) {
		$tmpColumns = $this->getLastContentElement();
		if($tmpColumns == null) $tmpColumns = new columns();
        return $this->addContent($tmpColumns->addColumnByObject($column));
    }
    public function addColumnsByArray($columns) {
        return $this->addContent(clone $columns);
    }
}
final class rows extends HTMLTag {
	private $rows = array();
	
    function __construct() {
        parent::__construct("tr");
    }
    public function addRow() {
        $this->rows[] = new row();
        return $this;
    }
    public function addRows($number) {
		for($i = 0; $i < $number; $i++) $this->rows[] = new row();
        return $this;
    }
    public function addRowsByArray($array) {
		foreach($array as $row) $this->rows[] = clone $row;
        return $this;
    }
    public function addRowAfterIndex($index) {
		if($index > count($this->rows)) $this->rows[] = new row();
		else $this->rows = array_merge(array_slice($this->rows,0,$index+1), array(new row()),array_slice($this->rows,$index+1));
        return $this;
    }
    public function addRowsAfterIndexByNumber($index, $number) {
		if($index > count($this->rows)) $this->rows[] = new row();
		else {
			$tmpRows = array(); 
			for($i = 0; $i < $number; $i++) $tmpRows[] = new row();
			$this->rows = array_merge(array_slice($this->rows,0,$index+1), $tmpRows,array_slice($this->rows,$index+1));
		}
        return $this;
    }
    public function addColumn() {
		foreach($this->rows as $index => $row) $this->rows[$index]->addColumn();
        return $this;
    }
    public function addColumnByIndex($index) {
		if(array_key_exists($index, $this->rows)) {
			$this->rows[$index]->addColumn();
		}
        return $this;
    }
    public function addColumnByObject($object) {
		foreach($this->rows as $index => $row) $this->rows[$index]->addColumnByObject($object);
        return $this;
    }
    public function addColumnByIndexAndObject($index, $object) {
		if(array_key_exists($index, $this->rows)) $this->rows[$index]->addColumnByObject($object);
        return $this;
    }
    public function addColumns() {
		foreach($this->rows as $index => $row) $this->rows[$index]->addColumns();
        return $this;
    }
    public function addColumnsByIndex($index) {
		if(array_key_exists($index, $this->rows)) {
			$this->rows[$index]->addColumn();
		}
        return $this;
    }
    public function addColumnsByObject($object) {
		foreach($this->rows as $index => $row) $this->rows[$index]->addColumnByObject($object);
        return $this;
    }
    public function addColumnsByIndexAndObject($index, $object) {
		if(array_key_exists($index, $this->rows)) $this->rows[$index]->addColumnByObject($object);
        return $this;
    }
}
final class column extends HTMLTag {
    function __construct() {
        parent::__construct("td");
    }
    public function addHtml($html) {
        $this->addContent($html);
		return $this;
    }
}
final class columns extends HTMLTag {
	private $columns = array();
	
    function __construct() {
        parent::__construct("td");
    }
    public function addColumn() {
        $this->columns[] = new column();
        return $this;
    }
    public function addColumnByObject($column) {
        $this->columns[] = clone $column;
        return $this;
    }
    public function addColumns($number) {
		for($i = 0; $i < $number; $i++) $this->columns[] = new column;
        return $this;
    }
    public function addColumnsByArray($array) {
		foreach($array as $column) $this->columns[] = clone $column;
        return $this;
    }
    public function addColumnAfterIndex($index) {
		if($index > count($this->columns)) $this->columns[] = new column();
		else $this->columns = array_merge(array_slice($this->columns,0,$index+1), array(new column()),array_slice($this->columns,$index+1));
        return $this;
    }
    public function addColumnsAfterIndexByNumber($index, $number) {
		if($index > count($this->columns)) $this->columns[] = new column();
		else {
			$tmpColumns = array(); 
			for($i = 0; $i < $number; $i++) $tmpColumns[] = new column();
			$this->columns = array_merge(array_slice($this->columns,0,$index+1), $tmpColumns,array_slice($this->columns,$index+1));
		}
        return $this;
    }
}
