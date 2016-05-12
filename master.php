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

$weight = 31.0825;
$birthdate = "10-10-14";

echo "Online PICU medicatie versie 1.01 \n \n" ;

echo "Gewicht: $weight kg \n";
echo "Geboortedatum: $birthdate \n";
echo "Leeftijd: \n \n";

echo "Reanimatie: \n";
echo medicine_fixed_dose("Adrenaline", 10, 1000, "ug/kg", 0, $weight );
echo medicine_fixed_dose("Amiodarone", 5, 500, "mg/kg", 0, $weight );

?>

<?
function debug_variables () {
  
    echo "";
    var_export ($_POST);
    echo "";
    die ();

}
?>
