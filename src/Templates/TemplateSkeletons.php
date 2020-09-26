<?php

namespace Qoraiche\MailEclipse\Templates;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Qoraiche\MailEclipse\MailEclipse;
use Qoraiche\MailEclipse\Utils\Replacer;

class TemplateSkeletons
{
    /**
     * Gets the template Skeletons from the configuration file.
     *
     * @return \Illuminate\Support\Collection
     */
    public function skeletons()
    {
        return new Collection(config('maileclipse.skeletons'));
    }

    /**
     *
     * @param mixed $type
     * @param mixed $name
     * @param mixed $skeleton
     * @return array|void
     */
    public function templateSkelton($type, $name, $skeleton)
    {
        $skeletonView = MailEclipse::VIEW_NAMESPACE."::skeletons.{$type}.{$name}.{$skeleton}";

        if (View::exists($skeletonView)) {

            $skeletonViewPath = View::make($skeletonView)->getPath();
            $templateContent = file_get_contents($skeletonViewPath);

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
