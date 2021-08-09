<?php

namespace App\Common\Helper;

use Collective\Html;
use App\Common\Config\MyConfig;
use Illuminate\Support\Facades\Storage;

class ViewHelper
{
    public static function getStatusBadgeHtml($value)
    {
        $color = $value == 'active' ? 'success' : 'warning';
        $content = MyConfig::getTemplate()['status'][$value]['content'];
        $result = sprintf('<span class="badge badge-lg badge-%s">%s</span>', $color, $content);
        return $result;
    }

    public static function getInfoDataRow($label, $value)
    {
        if ($value)
            return sprintf(
                '<div class="data-row">
                        <span class="label">%s</span>
                        <div class="value">%s</div>
                    </div> ',
                $label,
                $value
            );

        return '';
    }

    public static function getAvatarPath($filename)
    {
        if ($filename) {
            $path = asset('storage/img/profile/avatar/' . $filename);
            if (Storage::disk('public')->exists('img/profile/avatar/' . $filename)) return $path;
        }
        return asset('storage/img/common/avatar-empty.png');
    }

    public static function getMenuItemClass($currentController, $controller){
        return $currentController === $controller ? 'active' : '';
    }
    //
}
