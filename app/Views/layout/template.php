<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS CODE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <!-- MY CSS CODE -->
    <link rel="stylesheet" href="/css/style.css">

  <title><?= $title ?></title>
</head>

<body>
  
  <?= $this->include('layout/navbar'); ?>

    <?= $this->renderSection('content'); ?>

    <!-- JAVA SCRIPT CODE -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
      
      function preViewImg() {
          
        const sampul = document.querySelector('#sampul');
        const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview')
        
        sampulLabel.textContent = sampul.files[0].name;
        
        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);
        
        fileSampul.onload = function(e) {
          imgPreview.src = e.target.result;
        }
      }
      
    </script>

</body>
</html>