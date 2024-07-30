<?php 
echo $orderno="123-456-789-11";
echo "<br>";
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderno, 'C39+',3,33) . '" alt="barcode"   />';
// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('Shivam', 'C39+',3,33,array(1,1,1)) . '" alt="barcode"/>';
// echo DNS1D::getBarcodeHTML($orderno, 'C39');
// echo DNS2D::getBarcodeSVG('4445645656', 'DATAMATRIX');	
// echo DNS2D::getBarcodePNGPath($orderno, 'PDF417');
// echo '<img src="'.DNS1D::getBarcodeHTML($orderno, 'C39').'">';
 ?>