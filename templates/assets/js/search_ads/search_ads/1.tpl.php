<div class="navbar menu1 ">
  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
  <div class="nav-collapse collapse top-margin">
    <?  echo module_menu_template_top::showMenu($resultShowMudule); ?>
  </div>
</div>
<?
return ;
?>

<?
class module_menu_template_top
{
	public $menu;
	private $level;
	public $category;
	function __construct()
	{
		global $member_info;
		$this->menu='';
		$this->menu.='<ul class="nav  nav-pills menu-painty">';
		
		if($member_info==-1):
			$this->menu.="<li><a href='".RELA_DIR."?component=member&action=login' title='ورود'>ورود</a></li>";
			$this->menu.="<li><a href='".RELA_DIR."?component=member&action=register' title='عضویت'>عضویت</a></li>";
		else :
        	$this->menu.=		"<li><a style='color:#fff; background-color:#999 !important;'  href='".RELA_DIR."?component=member' title='پنل کاربری شما'>پنل کاربری شما</a></li>";
			$this->menu.=		"<li><a href='".RELA_DIR."?component=member&action=logOut' title='خروج'>خروج</a></li>";
			
       endif ;
		$this->menu.="<li  class='dropdown'><a class='dropdown-toggle' href='".RELA_DIR."درج-آگهی-تبلیغات-ساختمانی' title='درج آگهی و تبلیغات در دکورنما'>تعرفه درج آگهی</a></li>";
								
		
		
		$this->level=0;
	}
	static function showMenu($cat)
	{
		$class=new module_menu_template_top();
		$class->category=$cat;
		$menu1=$class->show_template_menu($class->category[0]);

		//echo '<pre/>';
		//print_r($menu1);
		//die();
		return $class->menu;
	}

	
	function show_template_menu($cat)
	{
		
		$this->level = $this->level + 1;
		if($this->level == 1)
		{
			//$this->menu.='<ul class="nav nav-pills">';
			//$this->menu.='<ul class="nav nav-pills">';
		}
		else
		{
			$this->menu.='<ul class="dropdown-menu js-activated " style="display: none;">';
		}
		foreach($cat as $k=>$v)
		{

			if($v['component']=='DEFULT')
			{
				$link=$v['action'];
			}else if($v['action']=='DEFULT')
			{
				$link=RELA_DIR.linkOut($v['component'].'/');

			}else
			{
				$link=RELA_DIR.linkOut($v['component'].'/'.$v['action']);
			}
			
					
			if(($this->level) ==1 and (is_array($this->category[$v['id']])))
			{							
				//$this->menu.='<li class="dropdown"> <a class="dropdown-toggle" data-toggle="" href="'.$link.'">'.$v['label'].' <span class="caret"></span></a>';
				 
				$this->menu.='<li class="dropdown">
				 <a class="dropdown-toggle" data-toggle="" href="'.$link.'">'.$v['label'].' <span class="caret"></span></a>';	 
				 
				 
			}else if(($this->level) >1 and (is_array($this->category[$v['id']])))
			{
					//ino ke bar dashtam menoyi ke zir menu darad click khor shod data-toggle="dropdown"
					//$this->menu.='<li class="dropdown-submenu">
					// <a class="dropdown-toggle" data-toggle="" href="'.$link.'">'.$v['label'].' <span class=""></span></a>';
					 
						$this->menu.='<li class="dropdown-submenu">
					 <a class="dropdown-toggle" data-toggle="" href="'.$link.'">'.$v['label'].' <span class=""></span></a>';				 
			}else if(($this->level) ==1 and (!is_array($this->category[$v['id']])))
			{
					
				$this->menu.='<li><a  href="'.$link.'">'.$v['label'].'</a>';
	
												 			 
			}
			else
			{
				//$this->menu.='<li><a  href="'.$link.'">'.$v['label'].'</a>';
				$this->menu.='<li><a  href="'.$link.'">'.$v['label'].'</a>';
				

			}
			if($v['action']!='DEFULT')
			{
				$action=$v['action'];
			}else
			{
				$action='';
			}
			
			if(is_array($this->category[$v['id']]))
			{
				
				$this->show_template_menu($this->category[$v['id']]);

			}
			else
			{
				
				//echo '<br/>finish<br/>'.$this->menu;
				//return $this->menu;
			}
			$this->menu.='</li>';

			
			//$this->menu.='</ul>';	
		}
		$this->level = $this->level -1;
		$this->menu.='</ul>';	
		return $this->menu;
	}
}
?>
