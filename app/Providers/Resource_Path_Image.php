<?php

namespace App\Providers;
use App\Providers\Folder_Path;
use App\Providers\Folder_Path_Function;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class Resource_Path_Image extends ServiceProvider
{
    public function boot(): void
    {
        $fpFunc = new Folder_Path_Function();

        View::composer('*', function ($view) use ($fpFunc) {
            //Global Resources

            $CompanyLogoIcon = $fpFunc->Global_Resource(Folder_Path::IMAGE, 'company_logo_icon.ico');
            $view->with('CompanyLogoIcon', $CompanyLogoIcon);

            //Resources

            $FireBgImage = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::IMAGE, 'fire_bg_image.jpg');
            $view->with('FireBgImage', $FireBgImage);

            $KitchenBgTablet = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::IMAGE, 'kitchen_bg_tablet.jpg');
            $view->with('KitchenBgTablet', $KitchenBgTablet);

            $ChefBgDesktop = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::IMAGE, 'chef_bg_desktop.jpg');
            $view->with('ChefBgDesktop', $ChefBgDesktop);

            $SecurityMeaningImage = $fpFunc->Resource(Folder_Path::AUTH, Folder_Path::IMAGE, 'security_meaning_image.png');
            $view->with('SecurityMeaningImage', $SecurityMeaningImage);

            $TempUserIcon = $fpFunc->Resource(Folder_Path::TEMPLATE, Folder_Path::IMAGE, 'temp_user_icon.png');
            $view->with('TempUserIcon', $TempUserIcon);
        });
    }
}
