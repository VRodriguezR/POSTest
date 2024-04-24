<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Compra;

class ComprasMensuales extends Component
{
    public function render()
    {
        $comprasDelMes = Compra::whereMonth('created_at', now()->month)->get();

        $totalCompras = $comprasDelMes->sum('total');
        return <<<HTML
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total de Compras(Mensuales)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$$totalCompras</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
