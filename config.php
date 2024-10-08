<?php
// Inclua o arquivo da biblioteca Simple HTML DOM Parser
include 'simple_html_dom.php';

// Função para atualizar a imagem, o valor, as descrições, o DS-Text e o nome
function updateImageValueAndDescriptions($imageURL, $newValue, $newDescription, $newParagraphDescription, $newDsText, $newLocation, $newName, $newPublicationDate) {
    // Lê o conteúdo do arquivo index.html
    $html = file_get_html('index.html');

    // Encontra a tag <img> com a classe específica
    $img = $html->find('img.sc-lvlx2m-0.eCrNOA', 0);
    if ($img) {
        $img->src = $imageURL;
    }

    // Encontra a tag <span> com a classe específica
    $span = $html->find('span.ad__sc-1wimjbb-1.hoHpcC.sc-hSdWYo.dDGSHH', 0);
    if ($span) {
        $span->innertext = 'R$ ' . $newValue;
    }

    // Encontra a tag <h1> com a classe específica
    $h1 = $html->find('h1.ad__sc-45jt43-0.htAiPK.sc-hSdWYo.bYQcLm', 0);
    if ($h1) {
        $h1->innertext = $newDescription;
    }

    // Encontra a tag <p> com a classe específica
    $p = $html->find('p.ad__sc-1kv8vxj-0.jWWQbF', 0);
    if ($p) {
        $p->innertext = $newParagraphDescription;
    }

    // Encontra a tag <span> com o atributo data-ds-component="DS-Text" e a classe específica
    $dsText = $html->find('span[data-ds-component="DS-Text"].ad__sc-1f2ug0x-1.cpGpXB.sc-hSdWYo.gwYTWo', 0);
    if ($dsText) {
        $dsText->innertext = $newDsText;
    }

    // Encontra a tag <span> com o atributo data-ds-component="DS-Text" e a classe específica para a localização
    $location = $html->find('span[data-ds-component="DS-Text"].ad__sc-1f2ug0x-1.cpGpXB.sc-hSdWYo.gwYTWo', 1);
    if ($location) {
        $location->innertext = $newLocation;
    }

    // Encontra a tag <span> com as classes específicas para o nome
    $name = $html->find('span.sc-fBuWsC.sc-cNQqM.bcDyFL.sc-cqPOvA.cuZcdS.sc-ifAKCX.cmFKIN strong', 0);
    if ($name) {
        $name->innertext = $newName;
    }

    // Encontra a tag <span> com o atributo data-ds-component="DS-Text" e a classe específica para a data de publicação
    $publicationDate = $html->find('span[data-ds-component="DS-Text"].ad__sc-1oq8jzc-0.dWayMW.sc-hSdWYo.jFeRvR', 0);
    if ($publicationDate) {
        $publicationDate->innertext = $newPublicationDate;
    }

    // Salva o HTML atualizado de volta no arquivo index.html
    file_put_contents('index.html', $html);
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["imageURL"]) && isset($_POST["newValue"]) && isset($_POST["newDescription"]) && isset($_POST["newParagraphDescription"]) && isset($_POST["newDsText"]) && isset($_POST["newLocation"]) && isset($_POST["newName"]) && isset($_POST["newPublicationDate"])) {
    $imageURL = $_POST["imageURL"];
    $newValue = $_POST["newValue"];
    $newDescription = $_POST["newDescription"];
    $newParagraphDescription = $_POST["newParagraphDescription"];
    $newDsText = $_POST["newDsText"];
    $newLocation = $_POST["newLocation"];
    $newName = $_POST["newName"];
    $newPublicationDate = $_POST["newPublicationDate"];
    updateImageValueAndDescriptions($imageURL, $newValue, $newDescription, $newParagraphDescription, $newDsText, $newLocation, $newName, $newPublicationDate);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Imagem, Valor e Descrição</title>
</head>
<body>

    <h1>Atualizar Imagem, Valor e Descrição</h1>

    <form action="config.php" method="post">
        <label for="imageURL">URL da Imagem:</label><br>
        <input type="text" id="imageURL" name="imageURL"><br><br>
        
        <label for="newValue">Novo Valor (R$):</label><br>
        <input type="text" id="newValue" name="newValue"><br><br>

        <label for="newDescription">Nova Descrição:</label><br>
        <input type="text" id="newDescription" name="newDescription"><br><br>
        
        <label for="newParagraphDescription">Nova Descrição do Parágrafo:</label><br>
        <input type="text" id="newParagraphDescription" name="newParagraphDescription"><br><br>

        <label for="newDsText">Novo DS-Text:</label><br>
        <input type="text" id="newDsText" name="newDsText"><br><br>

        <label for="newLocation">Nova Localização:</label><br>
        <input type="text" id="newLocation" name="newLocation"><br><br>

        <label for="newName">Novo Nome:</label><br>
        <input type="text" id="newName" name="newName"><br><br>

        <label for="newPublicationDate">Nova Data de Publicação:</label><br>
        <input type="text" id="newPublicationDate" name="newPublicationDate"><br><br>
        

        <button type="submit">Atualizar</button>
    </form>

</body>
</html>
