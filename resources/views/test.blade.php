<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Barcode Scanner Sample</title>
    <script src="https://cdn.jsdelivr.net/npm/dynamsoft-javascript-barcode@9.4.0-iv11082320/dist/dbr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dynamsoft-camera-enhancer@3.3.1/dist/dce.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mozilla/localForage@master/dist/localforage.js"></script>
    <link rel="stylesheet" href="{{ asset('css/isbn.css') }}">
  </head>
  <body>
    <div class="app">
      <h2 class="title">ISBN Barcode Scanner</h2>
      <div class="inputContainer">
        <input type="text" class="barcodeInput"/>
        <button class="scanButton">Scan</button>
        <button class="insertButton">Insert</button>
      </div>
      <div>
        <label for="queryTitle">Query title:
        <input type="checkbox" id="queryTitle" checked/></label>
        <span id="status"></span>
      </div>
      <div class="scanner"></div>
    </div>

    <script src="{{ asset('js/isbn.js') }}"></script>
  </body>
</html>