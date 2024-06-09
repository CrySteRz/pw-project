<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;


final class UpdateWithCsv extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $uploadedFiles = $request->getUploadedFiles();
        if (empty($uploadedFiles['file'])) {
            return $this->jsonResponse($response, 'error', 'No file uploaded', 400);
        }
    
        $uploadedFile = $uploadedFiles['file'];
    
        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            return $this->jsonResponse($response, 'error', 'Upload error', 500);
        }
    
        $fileStream = $uploadedFile->getStream();
        $csvString = $fileStream->__toString();
    
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $csvString);
        rewind($stream);
    
        $csvData = [];
        while (($row = fgetcsv($stream)) !== false) {
            $csvData[] = $row;
        }
    
        $result = $this->getGradeService()->UpdateWithCsv($csvData);
        return $this->jsonResponse($response, 'success', $result, 200);
    }
}