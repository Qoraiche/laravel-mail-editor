<?php

namespace Qoraiche\MailEclipse\Templates;

use Illuminate\Support\Collection;
use Qoraiche\MailEclipse\MailEclipse;

class TemplateSkeletons
{

    /**
     * Gets the template Skeletons from the configuration file.
     *
     * @return \Illuminate\Support\Collection
     * @throws Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function getTemplateSkeletons()
    {
        return new Collection(config('maileclipse.skeletons'));
    }

    public static function getTemplateSkeleton($type, $name, $skeleton)
    {

        $skeletonView = MailEclipse::VIEW_NAMESPACE."::skeletons.{$type}.{$name}.{$skeleton}";

        if (view()->exists($skeletonView)) {
            $skeletonViewPath = View($skeletonView)->getPath();
            $templateContent = file_get_contents($skeletonViewPath);

            return [
                'type' => $type,
                'name' => $name,
                'skeleton' => $skeleton,
                'template' => self::templateComponentReplace($templateContent, true),
                'view' => $skeletonView,
                'view_path' => $skeletonViewPath,
            ];
        }
    }
}
