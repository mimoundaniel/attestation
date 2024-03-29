<?php
// L'extention mpdf a besoin de ce fichier pour fontioner alors on ajoute une condition 
require_once __DIR__ . '/vendor/autoload.php';


//on ajoute une condition pour executer la suite du script 
if (
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['birthday']) &&
    isset($_POST['placeofbirth']) &&
    isset($_POST['address']) &&
    isset($_POST['heuresortie']) &&
    isset($_POST['city']) &&
    isset($_POST['zipcode']) &&
    isset($_POST['datesortie'])
) {
    date_default_timezone_set('Europe/Paris');
    // ici je declare la majorité de mes varibles
    $datenow = date("Y-m-j_H-i");
    $spacecenter = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $placeofbirth = $_POST['placeofbirth'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $datesortie = $_POST['datesortie'];
    $heuresortie = $_POST['heuresortie'];
    $motif_sorti = "";

    //ici les checkbox etant cochées seront declarées
    if (isset($_POST["checkbox-travail"])) $motif_sorti .= $_POST["checkbox-travail"] . ",";
    if (isset($_POST["checkbox-sante"])) $motif_sorti .= $_POST["checkbox-sante"] . ",";
    if (isset($_POST["checkbox-famille"])) $motif_sorti .= $_POST["checkbox-famille"] . ",";
    if (isset($_POST["checkbox-handicap"])) $motif_sorti .= $_POST["checkbox-handicap"] . ",";
    if (isset($_POST["checkbox-convocation"])) $motif_sorti .= $_POST["checkbox-convocation"] . ",";
    if (isset($_POST["checkbox-missions"])) $motif_sorti .= $_POST["checkbox-missions"] . ",";
    if (isset($_POST["checkbox-transits"])) $motif_sorti .= $_POST["checkbox-transits"] . ",";
    if (isset($_POST["checkbox-animaux"])) $motif_sorti .= $_POST["checkbox-animaux"] . ",";


    // Créer une nouvelle instance PDF
    $mpdf = new \Mpdf\Mpdf([
        'default_font' => 'SF UI Display Light'
    ]);

    $checked = '<input type="checkbox" checked="yes"/>';
    $no_checked = '<input type="checkbox"/>';

    // Ici on dessine le pdf
    $data = "";

    // Ici on lui ajoute des "données"
    $data .= "<p></p>";
    $data .= '<h2>ATTESTATION DE DÉPLACEMENT DÉROGATOIRE</h2><h4>DURANT LES HORAIRES DU COUVRE-FEU</h4>

<p style="text-align: left; font-size:12px">En application de l’article 4 du décret n° 2020-1310 du 29 octobre 2020 prescrivant les mesures générales<br>
nécessaires pour faire face à l’épidémie de COVID-19 dans le cadre de l’état d’urgence sanitaire</p>';
    '<body >';
    $data .= '<p>Mme/M. :' . $firstname  . " " . $lastname . '</p>';
    $data .= '<p>Né(e) le :' . $birthday . $spacecenter . 'à:' . $placeofbirth . '</p>';
    $data .= '<p>Demeurant :' . $address . " " . $zipcode . '</p>';

    $data .= '<p>certifie que mon déplacement est lié au motif suivant (cocher la case) autorisé en application des<br>
mesures générales nécessaires pour faire face à l’épidémie de COVID-19 dans le cadre de l’état<br>
d’urgence sanitaire<sup>1</sup>&nbsp; :</p><br>';

    if (isset($_POST["checkbox-travail"])) {
        $data .= '<p style="">' . $checked . 'Déplacements entre le domicile et le lieu d’exercice de l’activité professionnelle ou le lieu <br>d’enseignement et de formation, déplacements professionnels ne pouvant être différés</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements entre le domicile et le lieu d’exercice de l’activité professionnelle ou le lieu <br>d’enseignement et de formation, déplacements professionnels ne pouvant être différés</p>';
    }

    if (isset($_POST["checkbox-sante"])) {
        $data .= '<p style="">' . $checked . 'Déplacements pour des consultations, examens, actes de prévention (dont vaccination)<br> et soins ne pouvant être assurés à distance et ne pouvant être différés ou pour l’achat de<br> produits de santé</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements pour des consultations, examens, actes de prévention (dont vaccination)<br> et soins ne pouvant être assurés à distance et ne pouvant être différés ou pour l’achat de<br> produits de santé</p>';
    }

    if (isset($_POST["checkbox-famille"])) {
        $data .= '<p style="">' . $checked . 'Déplacements pour motif familial impérieux, pour l’assistance aux personnes vulnérables<br> ou précaires ou pour la garde d’enfants</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements pour motif familial impérieux, pour l’assistance aux personnes vulnérables<br> ou précaires ou pour la garde d’enfants</p>';
    }


    if (isset($_POST["checkbox-handicap"])) {
        $data .= '<p style="">' . $checked . 'Déplacements des personnes en situation de handicap et de leur accompagnant</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements des personnes en situation de handicap et de leur accompagnant</p>';
    }


    if (isset($_POST["checkbox-convocation"])) {
        $data .= '<p style="">' . $checked . 'Déplacements pour répondre à une convocation judiciaire ou administrative</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements pour répondre à une convocation judiciaire ou administrative</p>';
    }


    if (isset($_POST["checkbox-missions"])) {
        $data .= '<p style="">' . $checked . 'Déplacements pour participer à des missions d’intérêt général sur demande de l’autorité<br> administrative</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements pour participer à des missions d’intérêt général sur demande de l’autorité<br> administrative</p>';
    }


    if (isset($_POST["checkbox-transits"])) {
        $data .= '<p style="">' . $checked . 'Déplacements liés à des transits ferroviaires, aériens ou en bus pour des déplacements de<br> longues distances</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements liés à des transits ferroviaires, aériens ou en bus pour des déplacements de<br> longues distances</p>';
    }


    if (isset($_POST["checkbox-animaux"])) {
        $data .= '<p style="">' . $checked . 'Déplacements brefs, dans un rayon maximal d’un kilomètre autour du domicile pour les<br> besoins des animaux de compagnie</p>';
    } else {
        $data .= '<p style="">' . $no_checked . 'Déplacements brefs, dans un rayon maximal d’un kilomètre autour du domicile pour les<br> besoins des animaux de compagnie</p>';
    }


    $data .= '<p>Fait à :' . $city . '</p><br />';
    $data .= '<p>Le :' . $datesortie . $spacecenter . 'à :' . $heuresortie . '<br />';
    $data .= '<p style="text-align:left">(Date et heure de début de sortie à mentionner obligatoirement)</p><br>';
    $data .= '<p style="text-align:left;font-size:11px;margin-left:80px;"><sup>1</sup>&nbsp; Les personnes souhaitant bénéficier de l’une de ces exceptions doivent se munir s’il y a lieu, lors de leurs
déplacements hors de leur domicile, d’un document leur permettant de justifier que le déplacement considéré
entre dans le champ de l’une de ces exceptions.</p>';

    $mpdf->SetTitle('COVID-19 - Déclaration de déplacement');

    $stylesheet = file_get_contents('css/styles.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

    //ecrire dans le pdf
    $mpdf->WriteHTML($data);

    //Sortie des données et les Ouvrir sur le navigateurs.
    $mpdf->Output('attestation-' . $datenow . '.pdf', 'D');

    $pdo = new PDO('mysql:host=localhost:3306;dbname=corona', 'daniel', 'EQuU1zodeqEhzlc3paSUNBbrUB');
    $data = [
        'firstname' => htmlspecialchars($_POST['firstname']),
        'lastname' => htmlspecialchars($_POST['lastname']),
        'birthday' => htmlspecialchars($_POST['birthday']),
        'placeofbirth' => htmlspecialchars($_POST['placeofbirth']),
        'address' => htmlspecialchars($_POST['address']),
        'city' => htmlspecialchars($_POST['city']),
        'zipcode' => htmlspecialchars($_POST['zipcode']),
        'datesortie' => htmlspecialchars($_POST['datesortie']),
        'heuresortie' => htmlspecialchars($_POST['heuresortie']),
        'checkbox' => ''
    ];

    if (isset($_POST["checkbox-travail"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-travail"]) . ",";
    if (isset($_POST["checkbox-sante"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-sante"]) . ",";
    if (isset($_POST["checkbox-famille"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-famille"]) . ",";
    if (isset($_POST["checkbox-handicap"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-handicap"]) . ",";
    if (isset($_POST["checkbox-convocation"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-convocation"]) . ",";
    if (isset($_POST["checkbox-missions"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-missions"]) . ",";
    if (isset($_POST["checkbox-transits"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-transits"]) . ",";
    if (isset($_POST["checkbox-animaux"])) $data['checkbox'] .= htmlspecialchars($_POST["checkbox-animaux"]) . ",";

    $query = "INSERT INTO `attestation`(`Prenom`, `Nom`, `DateDeNaissance`, `LieuDeNaissance`, `Adresse`, `Ville`, `CodePostal`, `DateDeSortie`, `HeureDeSortie`, `Motif`) VALUES (:firstname, :lastname, :birthday, :placeofbirth, :address, :city, :zipcode, :datesortie, :heuresortie, :checkbox)";

    $success = $pdo->prepare($query)->execute($data);
} else {
    echo '<h1 style="text-align:center; font-family:Arial, sans-serif;">Oups ! rien reçu du formulaire...</h1>';
}
