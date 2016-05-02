yii2-ynote
======================
YII2 有道云笔记的SDK

install
---------------
composer require colee/yii2-ynote

usage
---------------
在配置文件中配置components
``` php
'ynote'=>[
    'class'=>'colee\ynote\YNote',
    'oauth_consumer_key'=>'',
    'oauth_consumer_secret'=>'',
    'domain'=>'http://note.youdao.com',
    'oauth_access_token'=>'',
    'oauth_access_secret'=>'',
],
```
常用的方法：
> 
``` php
\Yii::$app->ynote->getNoteBookList(); //获取笔记本列表
\Yii::$app->ynote->getNotePaths($notebook->path);//传入笔记本path，获取本子下的所有笔记的path
\Yii::$app->ynote->getNodeByPath($node_path); //通过path获取笔记详情

```