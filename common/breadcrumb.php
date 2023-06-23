<?php

class Breadcrumb
{
    protected $_trail;


    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->_trail = array();
    }

    public function add($title, $link = '', $hasLink = false)
    {
        array_push($this->_trail, array('title' => $title, 'link' => $link, 'hasLink' => $hasLink));
    }

    public function pop()
    {
        array_pop($this->_trail);
    }

    public function trail()
    {

        if (isset($_SESSION['city'])) {
            $homeLink = $_SESSION['city'];
        } else {
            $homeLink = '';
        }

        $trail_string  = '<div class="Breadcrumb">';
        $trail_string .= '<a class="home-icon text-gray-800" alt="تولیدات" title="تولیدات" href="'.RELA_DIR.$homeLink.'"><i class="fa fa-home" aria-hidden="true"></i> تولیدات </a>';

        foreach ($this->_trail as $key => $value) {
            if ($value['hasLink']) {
                if (strpos($value['link'], 'https://') !== false) {
                    $trail_string .= '> <a class="text-gray-800" href="'.$value['link'].'"><span>'.$value['title'].'</span></a>';
                } else {
                    $trail_string .= '> <a class="container-address" href="'.RELA_DIR.$value['link'].'"><span>'.$value['title'].'</span></a>';
                }
            } else {
                $trail_string .= ' > <span>'.$value['title'].'</span>';
            }
        }

        $trail_string .= '</div>';



        return $trail_string;
    }
}
