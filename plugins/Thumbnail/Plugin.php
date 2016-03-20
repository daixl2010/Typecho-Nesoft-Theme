<?php
/**
 * 文章缩略图
 * 
 * @package Thumbnail
 * @author Mr.Asong
 * @version 1.0.5
 * @update: 2011.12.18
 * @link http://mrasong.com
 * @useage    Thumbnail_Plugin::show($this); 
 *      
 *      version: 1.0.5  
 *      通过在文章中添加 <!--NoThumbnail--> 来实现无缩略图输出，返回空。
 *      默认返回值为 
 *      <a href="'.$obj->permalink.'" title="'. $obj->title .'"><img class="thumbnail" src="'.$img.'" /></a>
 
 *      version: 1.0.3  
 *      加入文章分类图片，随机图片
 *      附件 -> 文章内第一张 -> 分类图片 -> 随机图片 ->  默认图
 *      默认返回值为图片的 url
 
 *      version: 1.0.1  
 *      实现从附件中读取第一张图片做为缩略图，若附件无图片，则从文章中匹配第一张图。
 *      附件 -> 文章内第一张 ->  默认图
 */
class Thumbnail_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate(){}

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){}

    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
	
    /**
     * 判断是否为图片
     * 
	 * 貌似Typecho本身写的图片检测就有问题，没有按mime检测，而是按上传文件后缀，
	 * 这里也就用检测文件后缀的方法了。
	 *
	 * Thumbnail_Plugin::isImage( $type,$arr_ext );
	 *
     * @access public
     * @param string $type  附件后缀
     * @param array $arr_ext  附件后缀数组
     * @return bool
     */
	public static function isImage($type,$arr_ext){
	
	    for($i = 0;$i<count($arr_ext);$i++){
				if( $type == $arr_ext[$i]  ){
					$isImg = true;
					break;
				}
		}
		if( $isImg ){
			return true;
		}else{
		    return false;
		}
	}
	
    /**
     * 随机获取一张图片
     * 
	 * 语法: Thumbnail_Plugin::randPic( $dir_rand, $default_img, $arr_ext );
	 *
     * @access public
     * @param string $dir_rand  随机图片路径，相对系统根目录
	 * @param string $default_img  不存在随机图片时的默认图片
	 * @param string $arr_ext  图片后缀数组
     * @return string $img  图片uri
     */
	public static function randPic( $dir_rand, $default_img, $arr_ext )
	{
		if ($handle = @opendir( $_SERVER['DOCUMENT_ROOT'].$dir_rand )) {
			$count = 0; //初始化
			while (false !== ($file = readdir($handle))) {
				$ext = ltrim(strstr($file,"."),".");
				if( in_array( $ext, $arr_ext )  ){
					$imgArr[$count] = $file;
					$count++;
				}
			}
			if( $count >0 ){
				$rand = rand(0,19881223)%count($imgArr);
				$img =  $dir_rand.$imgArr[$rand];
			}else{
				$img = $default_img;
			}
			closedir($handle);
		}else{
		    $img = $default_img;
		}
		return $img;
	}
	
	
    /**
     * 从附件中获取上传的最后一张图
     *
     * 语法: Thumbnail_Plugin::show($this);
     *
     * @access public
     * @param int     $obj   $this
     * @return string  $img  缩略图的地址
     */
    public static function show($obj)
    {
		
        $options = Typecho_Widget::widget('Widget_Options');
		
		$url_plugin = $options->pluginUrl . '/Thumbnail/';  //插件地址  ->  http://domain.com/usr/plugins/Thumbnail/
		$url_resource = $options->resourceUrl ; //资源地址  ->  http://domain.com/usr/resources/
		$dir_resource = "/".str_replace( $options->siteUrl,"",$url_resource );  //资源路径  ->  /usr/resources/
		
		/*********  以下可以自定义  ************/
		$dir_cate = $dir_resource . "cate/"; // 分类图片相对位置  ->  /usr/resources/cate/
		$dir_rand = $dir_resource . "rand/"; // 随机图片相对位置  ->  /usr/resources/rand/
		$default_img = $url_plugin . "default.png";  // 默认图片  ->  http://domain.com/usr/plugins/Thumbnail/default.png
		$default_ext = '.png' ;  //默认分类图片类型  ->  /usr/resources/cate/xxx.png
		$arr_ext = array('jpg','gif','png','bmp','jpeg'); //随机图片的后缀名
		/*********  以上可以自定义  ************/
		
        $cid = $obj->cid;
		$cate = $obj->category;
		$content = $obj->text;
		$img = $default_img;
		if( strpos( $content, "<!--NoThumbnail-->" ) === false ){
		    
			$db = Typecho_Db::get();
			$attach = $db->fetchAll($db->select()->from('table.contents')
					 ->where('type = ? AND parent = ? ', 'attachment', $cid)
					 );
				
			if( empty($attach) ){ //没有附件的时候 从文章中匹配

				/**↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓**/
				preg_match_all( "/\<img.*?src\=(\'|\")(.*?)(\'|\")[^>]*>/i", $content, $matches );
				$imgCount = count($matches[0]);
				if( $imgCount >=1 ){
					$img = $matches[2][0];
				}else {
					
					if( file_exists( $_SERVER['DOCUMENT_ROOT'] . $dir_cate . $cate . $default_ext ) ){
						$img = $dir_cate . $cate . $default_ext ;
					}else{
						$img = Thumbnail_Plugin::randPic( $dir_rand, $default_img, $arr_ext );  //随机图片
					}
				}
				/**↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑**/
				
				/*****  1、只从附件中读取，请将以上↓↑之间代码注释即可。  ******/
				/*****  2、不存在附件时读分类图片，请将以上↓↑之间代码注释，并打开以下代码  
				if( file_exists( $_SERVER['DOCUMENT_ROOT'] . $dir_cate . $cate . $default_ext ) ){
					$img = $dir_cate . $cate . $default_ext ;
				} 
				*****/

			}else{ //直接从附件中找出第一个上传的图片
			
				foreach( $attach as $attach ){
					$attach_text = unserialize($attach['text']);
					if( Thumbnail_Plugin::isImage($attach_text['type'],$arr_ext) ){
						$img = $attach_text['path'];
						break;
					}			
				}
			
			}
			$img = $img;
		}else{
			$img = "";
		}
		
		echo $img;
		
    }

}
