<?php

namespace Internaltide\ComponentInjection\Components;

class ModalComponent
{
    public function __construct()
    {
        // do nothing
    }

    /**
     * The method that was not load body content, its used to load modal frame.
     * Body content 將再由元件另外使用 ajax 來載入所需內容
     */
    public function frame($title, $vendor='bootstrap', $tpl=null)
    {
        switch($vendor){
            case 'bootstrap':
                return $this->bootstrap($title, $tpl);
                break;
            case 'jqueryui':
                return $this->jqueryui($title, $tpl);
                break;
            default:
                return $this->bootstrap($title, $tpl);
                break;
        }
    }

    public function bootstrap($title,$tpl=null)
    {
        return view('componentInjection::'.config('component.view.modalframe'), [
            'modalLabel' => ( empty($title) ) ? 'Undefined Title':$title,
            'modalBackground' => config('component.extra.modalbg')
        ]);
    }

    public function jqueryui($title,$tpl=null)
    {
        // Pendding
    }
}
