<?php

namespace App\View\Components;

use App\Models\Perangkat;
use Illuminate\View\Component;

class ModalSuhuDaily extends Component
{

    public $historyHours;
    public $perangkat;
    public $day;
    public $date;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( Perangkat $perangkat , $day , array $historyHours , string $date)
    {
        $this->historyHours = $historyHours;
        $this->perangkat = $perangkat;
        $this->day = $day;
        $this->date = $date;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-suhu-daily');
    }

    public function getSuhuHour($hour)
    {
        $suhu = null;

        foreach ($this->historyHours as $history) {
            $hour_available = date('G', strtotime($history['created_at']));
            if($hour_available == $hour){
                $suhu = $history;
            }
        }

        return $suhu;
    }
}
