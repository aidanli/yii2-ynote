<?php
namespace colee\ynote;
/**
 * 这是一个常用的功能函数类
 * @author CoLee
 */
require_once dirname(__FILE__).'/YNote_SDK_PHP/ynote_client.php';

use yii\base\Component;
class YNote extends Component
{
    public $oauth_consumer_key;
    public $oauth_consumer_secret;
    public $domain;
    public $oauth_access_token;
    public $oauth_access_secret;

    private $_client;
    public function init(){
        $this->_client = new \YnoteClient(
            $this->oauth_consumer_key, 
            $this->oauth_consumer_secret, 
            $this->domain
        );
    }
	/**
	 * 截取字符串
	 * @param unknown $str
	 * @param number $length
	 * @return string
	 */
	public function substr( $str, $start=0, $length=160 )
	{
		return mb_substr( strip_tags($str),$start, $length, 'UTF8' );
	}

	/**
	 * 笔记本列表
	 */
	public function getNoteBookList()
	{
		$list_notebook_response = $this->_client->listNotebooks($this->oauth_access_token, $this->oauth_access_secret);
		$list_notebook = json_decode($list_notebook_response);
		return $list_notebook;
	}

	/**
	 * 通过笔记本路径列出笔记路径列表
	 */
	public function getNotePaths($notebook)
	{
		$list_notes_response = $this->_client->listNotes($this->oauth_access_token, $this->oauth_access_secret, $notebook);
		$list_note = json_decode($list_notes_response, true);
		return $list_note;
	}
	/**
	 * 获取笔记
	 * @param string $path 笔记路径
	 * @param string $notebook  笔记本路径
	 */
	public function getNodeByPath($path)
	{
	    $note = $this->_client->getNote($this->oauth_access_token, $this->oauth_access_secret, $path);
	    $note = json_decode($note, true);
	    $note['excerpt'] = $this->substr($note['content'],0, 200 );
	    return $note;
	}
	
	public function getImageUrl($url)
	{
	    $download_attachment_response = $this->_client->getAuthorizedDownloadLink($this->oauth_access_token, $this->oauth_access_secret, $url);
	}
}