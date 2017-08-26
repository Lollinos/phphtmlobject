abstract class HTMLTag {
    private $tag;
    private $attributes = array();
    private $content = array();
    
    function __construct($tag) {
        $this->tag = $tag;
    }
    
    protected function addContent($obj) {
        $this->content[] = $obj;
        return $this->getLastContentElement();
    }
    
    protected function getLastContentElement() {
        $length = count($this->content);
		if($length <= 0) return null;
        return $this->content[$length-1];
    }
    
    public function getContent() {
        return $this->content;
    }
    public function getOneContent($type) {
        foreach($this->content as $index => $obj) {
            if(is_a($obj, $type)) {
                return $this->content[$index];
            }
        }
        return null;
    }
    public function getOneContentByIndex($type, $index) {
        $count = 0;
        foreach($this->content as $i => $obj) {
            if(is_a($obj, $type)) {
                if($count == $index) return $this->content[$i];
                else $count++;
            }
        }
        return null;
    }
}
