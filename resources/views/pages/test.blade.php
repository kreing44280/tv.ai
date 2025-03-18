<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div id="editor-container"></div>
    <input type="hidden" name="content" id="quill-content">
</body>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow'
    });

    // Save Quill content before submitting form
    document.querySelector('form').onsubmit = function() {
        document.querySelector('#quill-content').value = quill.root.innerHTML;
    };
</script>

</html>
