<script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.min.js"></script>
<p>Most Recently Scanned Code-128 barcode</p><h1 id="output"></h1>
<div id="container">
  <div id="viewport" />
  <div id="canvas" />
</div>

<script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.min.js"></script>
<script>
Quagga.init(
  {
    inputStream: {
      name: "Live",
      type: "LiveStream",
      target: document.querySelector("#viewport")
    },
    decoder: {
    readers: [
      'ean_reader'
    ]
}
  },
  function (err) {
    if (err) {
      console.log(err);
      return;
    }
    console.log("Initialization finished. Ready to start");
    Quagga.start();
  }
);

Quagga.onDetected(function (result) {
  var code = result.codeResult.code;
  console.log(code);
  document.getElementById("output").innerHTML = result.codeResult.code;
});
</script>