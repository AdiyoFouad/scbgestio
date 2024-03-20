<?php

use Dompdf\Dompdf;
use Dompdf\Options;
require_once 'connexion_db.php';

$req = execSQL(
    'SELECT * FROM users',
    array()
);

$users = $req->fetchAll();

ob_start();

require_once 'pdfcontent.php';
$html = ob_get_contents();
ob_end_clean();


require_once 'includes/dompdf/autoload.inc.php';

$options = new Options();
$options->set('defaultFont', 'Courier');

//utiliser pour permetre d'afficher les img
$options->set('chroot', realpath(''));

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$fichier = 'mon-pdf.pdf';

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("test.pdf",array("Attachment"=>0));
die;
$dompdf->stream($fichier);

?>