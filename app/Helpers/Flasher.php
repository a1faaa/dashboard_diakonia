<?php

namespace App\Helpers;

class Flasher
{
    public static function setFlash($type = 'warning', $message){
        $class = 'alert alert-' . $type;
        $html  = '';
        $html .= '<div class="row mb-3">';
        $html .= '    <div class="col-12">';
        $html .= '        <div class="' . $class . ' alert-dismissible fade show" role="alert">';
        $html .= '            ' . $message;
        $html .= '            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        $html .= '        </div>';
        $html .= '    </div>';
        $html .= '</div>';
        session()->flash('flash', [
            'message' => $html
        ]);
    }

    public static function success($message)
    {
        self::setFlash('success', $message);
    }

    public static function warning($message)
    {
        self::setFlash('warning', $message);
    }

    public static function danger($message)
    {
        self::setFlash('danger', $message);
    }
}
