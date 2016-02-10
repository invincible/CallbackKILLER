<?php
/*
Plugin Name: CallbackKILLER
Plugin URI: http://cbkiller.ru/url/d78ed9/
Description: CallbackKILLER - Единственный бесплатный сервис обратного звонка с сайта за 24 секунды. 
Version: 0.01
Author: Печенов Сергей
Author URI: http://pechenov.livejournal.com/
*/

// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

if (!class_exists('CallbackKILLER')) {
    class CallbackKILLER {
    
        //Constructor
        function CallbackKILLER(){
            
            // Объявляем константу инициализации нашего плагина
            //DEFINE('CallbackKILLER', true);
            
            //$this->site_id = 5042;
            // ИД сайта
            add_option('cbkiller_site_id');
            
            // Название файла нашего плагина
            $this->plugin_dir = plugin_dir_url( __FILE__ );
            
            // Функция которая исполняется при активации плагина
            //register_activation_hook( $this->plugin_name, array(&$this, 'activate') );
            
            // Функция которая исполняется при деактивации плагина
		    //register_deactivation_hook( $this->plugin_name, array(&$this, 'deactivate') );
		    
            // Если мы в адм. интерфейсе
		    if ( is_admin() ) {
		        // Добавляем меню для плагина
			    add_action( 'admin_menu', array(&$this, 'admin_generate_menu') );
		    } else {
		        // Добавляем стили и скрипты
			    add_action('wp_print_scripts', array(&$this, 'site_load_scripts'));
			    add_action('wp_print_styles', array(&$this, 'site_load_styles'));
		    }
		
        }
        
        function site_load_scripts()
    	{
    		wp_register_script('cbkillerJs', 'https://cdn.callbackkiller.com/widget/cbk.js?wcb_code='. get_option('cbkiller_site_id') );
    		wp_enqueue_script('cbkillerJs');
    	}
    
    	function site_load_styles()
    	{
    		wp_register_style('cbkillerCss', 'https://cdn.callbackkiller.com/widget/cbk.css' );
    		wp_enqueue_style('cbkillerCss');
    	}
    	
        // Генерируем меню
    	function admin_generate_menu()
    	{
    		// Добавляем основной раздел меню
    		add_menu_page('О плагине CallbackKILLER', 'CallbackKILLER', 'manage_options', 'cbkiller_plugin_info', array(&$this,'cbkiller_plugin_info'), $this->plugin_dir.'cbk-logo.png');
    	}
        
    	// Показываем статическую страницу
    	public function cbkiller_plugin_info()
    	{
    		$action = isset($_GET['action']) ? $_GET['action'] : null;
    		
    		if ($action=='submit'){
    		    $siteId=intval($_POST['site_id']);
    		    if ($siteId == 0) return false;
    		    update_option('cbkiller_site_id',$siteId);
    		}
    		
    		include_once('plugin_info.php');
    	}
    	
    	// Активация плагина
    	/*function activate() 
    	{
            return true;
    	}*/
    	
    	// Deactivate plugin
    	/*function deactivate() 
    	{
    		return true;
    	}*/
    }
}
 
global $cbkiller;
$cbkiller = new CallbackKILLER();

?>