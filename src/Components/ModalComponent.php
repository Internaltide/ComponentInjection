<?php

namespace Internaltide\ComponentInjection\Components;

class ModalComponent
{
    private $withAPI = true; // 是否夾帶JS Library，預設夾帶

    public function __construct()
    {
        // do nothing
    }

    /**
     * The method that was not load body content, its used to load modal frame.
     * Body content 將再由元件另外使用 ajax 來載入所需內容
     */
    public function frame($withAPI=true, $title='Undefined Title', $tpl=null)
    {
        $this->withAPI = $withAPI;

        $vendor = config('component.modal.vendor');
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
        return view('componentInjection::modalframe', [
            'api' => $this->withAPI,
            'modalLabel' => ( empty($title) ) ? 'Undefined Title':$title,
            'modalBackground' => config('component.modal.background'),
            'headerColor' => config('component.modal.headercolor'),
            'contentColor' => config('component.modal.contentcolor')
        ]);
    }

    public function jqueryui($title,$tpl=null)
    {
        // Pendding
    }
}
