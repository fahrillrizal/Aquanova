<?php
if (!function_exists('renderStatusBadge')) {
    function renderStatusBadge($o2, $suhu, $salinitas, $ph)
    {        
        if (($o2 > 4 && $o2 <= 8) && ($suhu > 28 && $suhu <= 30) && ($salinitas > 0 && $salinitas <= 30) && ($ph > 6 && $ph <= 8)) {            
            if (
                ($o2 == 4 || $suhu == 28 || $salinitas == 0 || $ph == 6) 
                || ($o2 < 4 || $o2 > 8 || $suhu < 28 || $suhu > 30 || $salinitas < 0 || $salinitas > 30 || $ph < 6 || $ph > 8)
            ) {
                return '<span class="rounded-full px-2 py-1 bg-yellow-200 text-yellow-600">Netral</span>';
            }
            return '<span class="rounded-full px-2 py-1 bg-green-200 text-green-600">Baik</span>';
        }
        
        if (
            ($o2 == 4 || $suhu == 28 || $salinitas == 0 || $ph == 6) 
            && !($o2 < 4 || $o2 > 8 || $suhu < 28 || $suhu > 30 || $salinitas < 0 || $salinitas > 30 || $ph < 6 || $ph > 8)
        ) {
            return '<span class="rounded-full px-2 py-1 bg-yellow-200 text-yellow-600">Netral</span>';
        }

        return '<span class="rounded-full px-2 py-1 bg-red-200 text-red-600">Buruk</span>';
    }
}
?>