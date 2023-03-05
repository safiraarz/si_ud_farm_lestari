<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //MasterData
        Gate::define('checkbarang','App\Policies\MasterDataPolicy@checkbarang');
        Gate::define('checkflok','App\Policies\MasterDataPolicy@checkflok');
        Gate::define('checksupplier','App\Policies\MasterDataPolicy@checksupplier');
        Gate::define('checkcustomer','App\Policies\MasterDataPolicy@checkcustomer');
        Gate::define('checkjabatanpengguna','App\Policies\MasterDataPolicy@checkjabatanpengguna');
        Gate::define('checkakun','App\Policies\MasterDataPolicy@checkakun');
        //Transaksi
        Gate::define('checktambahnota','App\Policies\TransaksiPolicy@checktambahnota');
        Gate::define('checknotapembelian','App\Policies\TransaksiPolicy@checknotapembelian');
        Gate::define('checknotapenjualan','App\Policies\TransaksiPolicy@checknotapenjualan');
        Gate::define('checknotapemesanan','App\Policies\TransaksiPolicy@checknotapemesanan');
        Gate::define('checknotapemasukantelur','App\Policies\TransaksiPolicy@checkpemasukantelur');
        Gate::define('checkpemberianpakan','App\Policies\TransaksiPolicy@checkpemberianpakan');
        // Produksi
        Gate::define('check_bom_mps_mrp_hasilproduksi','App\Policies\ProduksiPolicy@check_bom_mps_mrp_hasilproduksi');
        Gate::define('check_spk_lpb','App\Policies\ProduksiPolicy@check_spk_lpb');
        Gate::define('check_sk_bahanbaku','App\Policies\ProduksiPolicy@check_sk_bahanbaku');
        // Akuntansi
        Gate::define('checkakuntansi','App\Policies\AkuntansiPolicy@checkakun');
        Gate::define('checkpenutupanperiode','App\Policies\AkuntansiPolicy@checkpenutupanperiode');


        
        
    }
}
