<?php 
include "menu_item.php";
class Menu{
    public $text;
    public $user_role;
    private $menus;

    function __construct($text="Home",$user_role=3){
        $this->text=$text;
        $this->user_role=$user_role;

        $this->menus = [
            new Menu_Item("Home","/",3,"Opening Screen"),
            new Menu_Item("Dashboard","dashboard.php",3,"Your Dashboard"),
            new Menu_Item("Mark","mark_attendance.php",3,"Mark Attendance"),
            new Menu_Item("Past","attendance_log.php",3,"Past Attendance"),
            new Pull_Down_Menu_Item("Manage",[new Menu_Item("Add Student","add_student.php",2,"Add A student to the system"),
            new Menu_Item("Sessions","manage_sessions.php",2,"Add, Remove, Edit upcoming class sessions")
        ],2,"Manage Class"),
            new Menu_Item("Logout","../login/logout.php",3,"Logout of system")
        ];

        foreach($this->menus as $item){
            if($item->text==$this->text){
                $item->active=true;
            }
        }
    }

    public function get_html(){
        $menu_html = "";
        foreach ($this->menus as $menu) {
            $menu->active = $menu->text == $this->text;
            if($menu->role_can_view($this->user_role)) {
                $menu_html.= $menu->get_html();
            }
        }
       return $menu_html;
    }

    public function add_menu_item($menuItem){
        array_push($this->menus,$menuItem);
    }

    public function get_menu_item($menuItem){
        foreach($this->menus as $item){
            if($item->text==$menuItem){
                return $item;
            }
        
        }
        return null;
    }

    public function delete_menu_item($menuItem){
        for ($i=0;$i<count($this->menus);$i++){
            if($this->menus[$i]->text==$menuItem){
                unset($this->menus[$i]);
                return true;
            }
        }
        return false;
    }

}
?>