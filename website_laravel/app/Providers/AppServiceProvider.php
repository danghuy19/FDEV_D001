<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Blade;
use Money\Money;

use DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $list_loai_sach = DB::table('bs_loai_sach')
        ->where('id_loai_cha', 0)
        ->get();

        $list_loai_sach = json_decode(json_encode($list_loai_sach));

        foreach($list_loai_sach as $key => $loai_sach_cha){
            $list_ds_loai_con = DB::table('bs_loai_sach')
            ->where('id_loai_cha', $loai_sach_cha->id)
            ->get();

            $list_ds_loai_con = json_decode(json_encode($list_ds_loai_con));

            $list_loai_sach[$key]->ds_loai_con = $list_ds_loai_con;
        }

        View::share('ds_loai_sach', $list_loai_sach);

        Blade::directive('convert_money', function ($money) {
            return "<?php echo number_format($money, 0, '', ','); ?>";
        });
    }
}
