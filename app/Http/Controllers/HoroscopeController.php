<?php

namespace App\Http\Controllers;

use App\Models\Horoscope;
use App\Http\Requests\StoreHoroscopeRequest;
use App\Http\Requests\UpdateHoroscopeRequest;
use App\Models\Lang;

class HoroscopeController extends Controller
{
    /**
     * Imports horoscopes from an external API and saves them to the database.
     */
    public function importHoroscope() {
        $allLanguages = Lang::all(); // Retrieve all languages
        $horoscopeSigns = [
            'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
            'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
        ];
        $periods = ['Today', 'Yesterday', 'Week', 'Month'];

        foreach ($periods as $period) {
            $date = $this->resolveDate($period); // Determine the date based on the period

            foreach ($horoscopeSigns as $sign) {
                $response = file_get_contents("https://www.astrology-zodiac-signs.com/api/call.php?time=$period&sign=$sign");
                Horoscope::create([
                    'date' => $date,
                    'lang' => 'en', // Assuming language is 'en' for all entries
                    'sign' => $sign,
                    'time' => $period,
                    'phrase' => $response,
                ]);
            }
        }
    }

    /**
     * Helper method to calculate date based on period.
     */
    private function resolveDate($period) {
        switch ($period) {
            case 'Today':
                return date('d/m/Y');
            case 'Yesterday':
                return date('d/m/Y', strtotime('-1 day'));
            case 'Week':
                return date('d/m/Y', strtotime('last Monday'));
            case 'Month':
                return date('d/m/Y', strtotime('first day of this month'));
            default:
                return date('d/m/Y');
        }
    }

    // The rest of the controller methods (index, create, store, show, edit, update, destroy)
    // are placeholders for typical RESTful operations and do not contain specific implementations.

    public function index() { /* List resources */ }
    public function create() { /* Show create form */ }
    public function store(StoreHoroscopeRequest $request) { /* Store new resource */ }
    public function show(Horoscope $horoscopes) { /* Show specific resource */ }
    public function edit(Horoscope $horoscopes) { /* Show edit form */ }
    public function update(UpdateHoroscopeRequest $request, Horoscope $horoscopes) { /* Update specific resource */ }
    public function destroy(Horoscope $horoscopes) { /* Delete resource */ }
}
