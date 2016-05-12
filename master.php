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
function medicine_pump($medicine, $fixed_dose, $unit_dose, $unit_dhm, $upper_limit_dose, $lower_limit_dose, $decimals_dose, $fluid_dose, $fluid_unit, $weight ) {
  
   // voorbereiding van variabelen
   $weight = ereg_replace (',', '.', $weight);

   // omzetten numerieke dosering in textdosering 
   // $unit_dose
   if ($unit_dose == 0): $text_unit_dose = "gr";
    elseif ($unit_dose == 1000): $text_unit_dose = "mg";
    elseif ($unit_dose == 1000000): $text_unit_dose = "ug";
    else: $text_unit_dose ="??";
   endif;
   
   // $unit_dhm
   if ($unit_dhm == 0): $text_unit_dhm = "dag";
    elseif ($unit_dhm == 24): $text_unit_dhm = "uur";
    elseif ($unit_dhm == 1440): $text_unit_dhm = "minuut";
    elseif ($unit_dhm == 86400): $text_unit_dhm = "seconde";
    else: $text_unit_dhm ="??";
   endif;
   
   // $fluid_unit
   if ($fluid_unit == 0): $text_fluid_unit = "l";
    elseif ($fluid_unit == 1000): $text_fluid_unit = "ml";
    elseif ($fluid_unit == 1000000): $text_fluid_unit = "ul";
    else: $text_fluid_unit ="??";
   endif;
   
   // berekening stand bij minimale (begin)stand
   $infusion = $lower_limit_dose * $weight; // hoeveelheid units per tijd
   
   
   
    print "medicine: $medicine\n";
    print "fixed dose: $fixed_dose\n";
    print "unit dose in grams (0), milligrams (1000) or micrograms (1000000): $unit_dose\n";
    print "text unit dose: $text_unit_dose\n";
    print "unit per day (0), hour (24) or minute (1440) or second (86400): $unit_dhm\n";
    print "text unit time: $text_unit_dhm\n";
    print "upper limit dose: $upper_limit_dose\n";
    print "lower limit dose: $lower_limit_dose\n";
    print "decimals dose: $decimals_dose\n";
    print "fluid dose: $fluid_dose\n";
    print "fluid unit in liters (0), milliliters (1000) or microliters (1000000): $fluid_unit\n";
    print "text fluid unit: $text_fluid_unit\n";
    print "weight: $weight\n";
  
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
medicine_pump("Midazolam", 25, 1000, 24, 0.1, 0.5, 1, 50, 1000, $weight)

?>

<?
function debug_variables () {
  
    echo "";
    var_export ($_POST);
    echo "";
    die ();

}
?>
