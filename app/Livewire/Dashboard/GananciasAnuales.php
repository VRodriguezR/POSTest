<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Venta;
use App\Models\Compra;

class GananciasAnuales extends Component
{
    public function render()
    {
        $ventasDelMes = Venta::whereYear('created_at', now()->year)->get();
        $comprasDelMes = Compra::whereYear('created_at', now()->year)->get();

        $totalVentas = $ventasDelMes->sum('total');
        $totalCompras = $comprasDelMes->sum('total');
        $diferenciaTotal = $totalVentas - $totalCompras;
        return <<<HTML
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Ganancias (Anuales)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$$diferenciaTotal</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        HTML;
    }
}
