<?php

namespace Qoraiche\MailEclipse\Utils;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Qoraiche\MailEclipse\MailEclipse;

class TemplateSkeletons
{
    /**
     * Gets the template Skeletons from the configuration file.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function skeletons()
    {
        return new Collection(config('maileclipse.skeletons'));
    }

    /**
     * @param  mixed  $type
     * @param  mixed  $name
     * @param  mixed  $skeleton
     * @return array|void
     */
    public static function get($type, $name, $skeleton)
    {
        $skeletonView = MailEclipse::VIEW_NAMESPACE."::skeletons.{$type}.{$name}.{$skeleton}";

        if (View::exists($skeletonView)) {
            $skeletonViewPath = View::make($skeletonView)->getPath();
            $templateContent = File::get($skeletonViewPath);

            return [
                'type' => $type,
                'name' => $name,
                'skeleton' => $skeleton,
                'template' => Replacer::toEditor($templateContent),
                'view' => $skeletonView,
                'view_path' => $skeletonViewPath,
            ];
        }
    }
}
