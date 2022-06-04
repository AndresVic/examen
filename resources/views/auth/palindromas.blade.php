<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">  
    <title>Palabras palíndromas</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <header>
        <a href="{{ route('dashboard') }}">Inicio</a>
        <h1>Revisar palabras palíndromas</h1>
        <p>Un palíndromo es una palabra o frase que se lee igual al revés que al derecho, p. nivel, consulte.</p>
      </header>
      <div class="inputs">
        <input type="text" spellcheck="false" placeholder="Ingrese texto o número">
        <button>Ejecutar</button>
      </div>
      <p class="info-txt"></p>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>