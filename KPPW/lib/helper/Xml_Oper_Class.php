<?php

class Xml_Oper_Class {
	
	var $_filepath;    //xml文件路径  
	var $_xmlnode;    //XML文件节点
	var $_nodevalue;   //XML节点的值
	var $_nodeattr;    //XML节点的属性 
	var $_doc;
	var $_xpath;
    var $_K;
	function __construct($filepath='')
	{
		global $_K;
		$this->_K = $_K;
		$this->_filepath = $filepath;
		$this->_doc = new DOMDocument();
		$this->_doc->load($this->_filepath);
		$this->_xpath = new DOMXPath($this->_doc);
	}
    /**
	 * 获取XML节点的值
	 */
	function get_xml_node($nodename='') {
		$node = $this->_doc->getElementsByTagName ( $nodename );
		return $node->item ( 0 )->nodeValue;
	
	}
	/**
	 * 设置修改XML节点的值
	 *
	 * @return unknown
	 */
	function setxml($nodename='',$nodevalue='') {
		global $_K;
		if ($_K['charset']=="GBK"){
			$nodevalue = Func_comm_class::gbktoutf($nodevalue);
		}
		$node = $this->_doc->getElementsByTagName ( $nodename );
		$node->item ( 0 )->nodeValue = $nodevalue;
		return $this->_doc->save ( $this->_filepath );
	}
	/**
	 *读取xml将内容生成array
	 *
	 * @param unknown_type $xml_path
	 * @return  xml_array;
	 */
	static function get_xml_toarr($xml_path=''){
		global $_K;
		$xml_o =  simplexml_load_file($xml_path); 
        $xml_arr = (array) $xml_o;
        if ($_K['charset']=="GBK"){
        	return  Func_comm_class::utftogbk($xml_arr);
        }
        else {
        	return $xml_arr;
        }
       
	}
	/**
	 * 创建一个节点
	 *
	 * @param string $nodename
	 * @param string $nodetext
	 */
	function  create_node($nodename='',$nodetext=''){
	  if($this->_K['charset']!='UTF-8'){
		   $nodename = Func_comm_class::gbktoutf($nodename);
		   $nodetext = Func_comm_class::gbktoutf($nodetext);
		}
	  $xmlroot = $this->_doc->getElementsByTagName('root')->item(0);
	  $ele = new DOMElement($nodename,$nodetext);
	  $xmlroot->appendChild($ele);
	  $this->_doc->save($this->_filepath);
	}
	/**
	 * 创建子节点
	 *
	 * @param Element $ele
	 * @param string $nodename
	 * @param string $nodetext
	 */
	function create_child_node($ele='',$nodename='',$nodetext=''){
		if($this->_K['charset']!='UTF-8'){
		   $nodename = Func_comm_class::gbktoutf($nodename);
		   $nodetext = Func_comm_class::gbktoutf($nodetext);
		}
		$child_node = new DOMElement($nodename,$nodetext);
		$ele->appendChild($child_node);
		$this->_doc->save($this->_filepath);
	}
	/**
	 * 添加节点属性
	 *
	 * @param Element $element
	 * @param string $attrname
	 * @param string $attrvalue
	 */
	function create_node_attr($element='',$attrname='',$attrvalue=''){
	if($this->_K['charset']!='UTF-8'){
		   $attrname = Func_comm_class::gbktoutf($attrname);
		   $attrvalue = Func_comm_class::gbktoutf($attrvalue);
		}
		$attr = new DOMAttr($attrname,$attrvalue);
		$element->appendChild($attr);
		$this->_doc->save($this->_filepath);
	}
	/**
	 * 删除节点
	 *
	 * @param Element $element    
	 * 
	 */
	function reomve_node($element){
		$element->parentNode->removeChild($element);
		$this->_doc->save($this->_filepath);
	}
	/**
	 * 节点查询返回节点对象
	 *
	 * @param string $query   '/root/book'
	 * @param int  $item
	 * @return Element
	 */
	function query_node($query,$item){
		$node  = $this->_xpath->query($query)->item($item);
		return $node;
	}
	

}

?>