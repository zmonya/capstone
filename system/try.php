$input_document = trim($_POST["document"]);
    if(empty($input_document)){
        $document_err = "Please enter a document.";     
    } else{
        $document = $input_document;
    }