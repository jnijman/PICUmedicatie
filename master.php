<?
function medicine_fixed_dose($medicine, $fixed_dose, $max_dose, $unit_dose, $decimals_dose, $weight ) {
  
   // voorbereiding van variabelen
   $weight = ereg_replace (',', '.', $weight);

   // dosisberekening & afronding decimalen
   $dose = $fixed_dose * $weight;
   $dose = number_format($dose, $decimals_dose, '.', '');
   
   // maximale dosering checken
   if ($dose > $max_dose)
    $dose = $max_dose;

   print "$medicine $dose $unit_dose (dosering: $fixed_dose $unit_dose, maximum: $max_dose $unit_dose)\n";
}
function medicine_pump($medicine, $fixed_dose_SST, $dose_unit_SST, $fixed_fluid_SST, $fluid_unit_SST, $upper_limit_dose_pt, $lower_limit_dose_pt, $dose_unit_pt, $unit_dhm, $decimals_dose, $weight ) {
  
   // voorbereiding van variabelen
   $weight = ereg_replace (',', '.', $weight);

   // omzetten numerieke dosering in textdosering 
   $dose_unit_SST_array = array (0 => 'gr', 1 => 'dgr', 2 => 'cgr', 3 => 'mg', 6=> 'microg', 9=> 'nanog');
   $fluid_unit_SST_array = array (0 => 'l', 1 => 'dl', 2 => 'cl', 3 => 'ml', 6=> 'microl', 9=> 'nanol');
   $dose_unit_pt_array = array (0 => 'gr', 1 => 'dgr', 2 => 'cgr', 3 => 'mg', 6=> 'microg', 9=> 'nanog');
   $unit_dhm_array = array (0 => 'dag', 1 => 'uur', 2 => 'minuut', 3 => 'seconde', 4 => 'miliseconde');
   
   // berekening stand bij minimale (begin)stand 
   $infusion = $lower_limit_dose_pt * $weight; // hoeveelheid per $unit_dhm
   
   // terugrekenen naar mg
   switch ($dose_unit_pt) {
     case 0: $infusion = $infusion * 1000; break;
     case 1: $infusion = $infusion * 100; break;
     case 2: $infusion = $infusion * 10; break;
     case 3: $infusion = $infusion * 1; break;
     case 6: $infusion = $infusion / 1000; break;
     case 9: $infusion = $infusion / 1000000; break;
   } 
   
   // terugrekenen naar per uur
   switch ($unit_dhm) {
     case 0: $infusion = $infusion * 24; break;
     case 1: $infusion = $infusion * 1; break;
     case 2: $infusion = $infusion / 60; break;
     case 3: $infusion = $infusion / 3600; break;
     case 4: $infusion = $infusion / 3600 / 1000; break;
   }
   
   // hoeveelheid dosis per hoeveelheid vloeistof
   $dose_per_SST = $fixed_dose_SST / $fixed_fluid_SST;
   
   // dosis in SST terugrekenen naar mg
    switch ($dose_unit_SST) {
     case 0: $dose_per_SST = $dose_per_SST * 1000; break;
     case 1: $dose_per_SST = $dose_per_SST * 100; break;
     case 2: $dose_per_SST = $dose_per_SST * 10; break;
     case 3: $dose_per_SST = $dose_per_SST * 1; break;
     case 6: $dose_per_SST = $dose_per_SST / 1000; break;
     case 9: $dose_per_SST = $dose_per_SST / 1000000; break;
   }
   
   // dosis in SST terugrekenen naar ml
    switch ($fluid_unit_SST) {
     case 0: $dose_per_SST = $dose_per_SST * 1000; break;
     case 1: $dose_per_SST = $dose_per_SST * 100; break;
     case 2: $dose_per_SST = $dose_per_SST * 10; break;
     case 3: $dose_per_SST = $dose_per_SST * 1; break;
     case 6: $dose_per_SST = $dose_per_SST / 1000; break;
     case 9: $dose_per_SST = $dose_per_SST / 1000000; break;
   }

    echo "medicine: $medicine\n";
      echo "fixed dose in SST: $fixed_dose_SST\n";
      echo "dose unit in SST: $dose_unit_SST_array[$dose_unit_SST]\n";
      echo "fixed quantity of fluid in SST: $fixed_fluid_SST\n";
      echo "unit of fluid in SST: $fluid_unit_SST_array[$fluid_unit_SST]\n";
      echo "upper limit of dose in pt: $upper_limit_dose_pt\n";
      echo "lower limit of dose in pt: $lower_limit_dose_pt\n";
      echo "dose unit in pt: $dose_unit_pt_array[$dose_unit_pt]\n";
      echo "fluid unit in pt: $fluid_unit_pt_array[$fluid_unit_pt]\n";
      echo "time unit in pt: $unit_dhm_array[$unit_dhm]\n";
      echo "number of decimals: $decimals_dose\n";
    echo "weight: $weight\n\n";
    echo "hoeveelheid per tijdseenheid bij minimale stand (mg/uur): $infusion\n\n";
    echo "dosis per uur (mg/ml/uur): $dose_per_SST\n\n";
    echo "infuusstand: ". $infusion / $dose_per_SST ." ml/uur";

}


$weight = 31.0825;
$birthdate = "10-10-14";

echo "Online PICU medicatie versie 1.01 \n \n" ;

echo "Gewicht: $weight kg \n";
echo "Geboortedatum: $birthdate \n";
echo "Leeftijd: \n \n";

echo "Reanimatie: \n";
// medicine_fixed_dose("Adrenaline", 10, 1000, "ug/kg", 0, $weight );
// medicine_fixed_dose("Amiodarone", 5, 500, "mg/kg", 0, $weight );

// parameters: medicijnnaam, dosering in SST, eenheid in SST, hoeveelheid SST, eenheid SST,
// bovenlimiet hoeveelheid medicijn per tijd, onderlimiteit hoeveelheid medicijn per tijd,
// eenheid medicijn per tijd, tijd, aantal decimalen
medicine_pump("Midazolam", 25, 3, 50, 3, 0.5, 0.1, 3, 1, 1, $weight);

?>

<?
function debug_variables () {
  
    echo "";
    var_export ($_POST);
    echo "";
    die ();

}
?>
