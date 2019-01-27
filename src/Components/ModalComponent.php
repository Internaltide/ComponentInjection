<?php

namespace Internaltide\ComponentInjection\Components;

class ModalComponent
{
    public function __construct()
    {
        // do nothing
    }

    /**
     * The only method that was not load body content, its used to load modal frame.
     * Body content 將再由元件另外使用 ajax 來載入所需內容
     */
    public function frame($title,$tpl=null)
    {
        return view('componentInjection::'.config('component.view.modalframe'), [
            'modalLabel' => ( empty($title) ) ? 'Undefined Title':$title,
            'modalBackground' => config('component.extra.modalbg')
        ]);
    }
}
