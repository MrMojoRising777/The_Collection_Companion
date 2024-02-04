let reader;
let enhancer;
let interval;
let processing = false;
const priceColumnIndex = 2;

if ("serviceWorker" in navigator) {
  navigator.serviceWorker.register("/sw.js").then(function (registration) {
    console.log('ServiceWorker registration successful with scope: ', registration.scope);
  }, function (err) {
    console.log('ServiceWorker registration failed: ', err);
  }).catch(function (err) {
    console.log(err);
  });
}

window.onload = function() {
  init();
  // BUTTON > START SCAN
  document.getElementsByClassName("scanButton")[0].addEventListener("click",function(){
    startScan();
  });
  // BUTTON > INSERT
  document.getElementsByClassName("insertButton")[0].addEventListener("click",async function(){
    let barcodeText = document.getElementsByClassName("barcodeInput")[0].value;
    await insert(barcodeText);
    calculateTotalPrice();
    updateStatus("");
  });
}

function startScan(){
  if (!enhancer || !reader) {
    alert("Please wait for the initialization of Dynamsoft Barcode Reader");
    return;
  }
  document.getElementsByClassName("scanner")[0].classList.add("active");
  enhancer.open(true);
}

function stopScan(){
  stopProcessingLoop();
  enhancer.close(true);
  document.getElementsByClassName("scanner")[0].classList.remove("active");
}

async function init(){
  updateStatus("Initializing...");
  reader = await Dynamsoft.DBR.BarcodeScanner.createInstance();
  await useEAN13Template();
  enhancer = await Dynamsoft.DCE.CameraEnhancer.createInstance();
  enhancer.on("played", (playCallbackInfo) => {
    startProcessingLoop();
  });
  updateStatus("");
  await enhancer.setUIElement(Dynamsoft.DCE.CameraEnhancer.defaultUIElementURL);
  setScanRegion();
  let container = document.getElementsByClassName("scanner")[0];
  container.appendChild(enhancer.getUIElement());
  document.getElementsByClassName("dce-btn-close")[0].onclick = function () {
    stopScan();
  };
}

function updateStatus(info){
  document.getElementById("status").innerText = info;
}

function setScanRegion(){
  enhancer.setScanRegion({
    regionLeft:0,
    regionTop:25,
    regionRight:100,
    regionBottom:55,
    regionMeasuredByPercentage: 1
  });
}

async function useEAN13Template() {
  await reader.initRuntimeSettingsWithString(`
  {
    "FormatSpecification": {
      "EnableAddOnCode": 1,
      "Name": "defaultFormatParameterForAllBarcodeFormat"
    },
    "ImageParameter": {
      "BarcodeFormatIds": ["BF_EAN_13"],
      "BarcodeFormatIds_2": ["BF2_NULL"],
      "ExpectedBarcodesCount": 1,
      "FormatSpecificationNameArray": [
        "defaultFormatParameterForAllBarcodeFormat"
      ],
      "Name": "default",
      "Timeout": 3000
    },
    "Version": "3.0"
  }`);
};

function startProcessingLoop(isBarcode){
  stopProcessingLoop();
  interval = setInterval(captureAndDecode,100); // read barcodes
}

function stopProcessingLoop(){
  if (interval) {
    clearInterval(interval);
    interval = undefined;
  }
  processing = false;
}

async function captureAndDecode() {
  if (!enhancer || !reader) {
    return
  }
  if (enhancer.isOpen() === false) {
    return;
  }
  if (processing == true) {
    return;
  }
  processing = true; // set decoding to true so that the next frame will be skipped if the decoding has not completed.
  let frame = enhancer.getFrame();
  if (frame) {  
    let results = await reader.decode(frame);
    console.log(results);
    if (results.length > 0) {
      const result = results[0];
      document.getElementsByClassName("barcodeInput")[0].value = result.barcodeText;
      console.log(result.barcodeText);
      getData(result.barcodeText);
      stopScan();
    }
    processing = false;
  }
};

let apiKey = 'AIzaSyDjKMoqjufx6R7ZUd4XV3yiALbsInporn8';
let baseURL = 'https://www.googleapis.com/books/v1/volumes';

function getData(isbn) {
  // Constructing the full URL with the ISBN and API key
  let fullURL = `${baseURL}?q=isbn:${isbn}&key=${apiKey}`;
  console.log('FULL URL:', fullURL);

  // Making the fetch request
  fetch(fullURL)
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    // Handle the data returned from the API
    console.log(data);

    const title = data.items[0].volumeInfo.title;
    console.log('Title:', title);

    sendTitleToController(title);
  })
  .catch(error => {
    // Handle any errors that occurred during the fetch
    console.error('Fetch error:', error);
  });
}

// Function to send the obtained title to the Laravel controller
function sendTitleToController(title) {
  // Make an HTTP request to the Laravel route with the obtained title
  fetch(`/sendTitle/${encodeURIComponent(title)}`, {
    method: 'GET',
  })
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json();
  })
  .then(responseData => {
    // Handle the response from the Laravel controller if needed
    console.log('Response from Laravel controller:', responseData);
  })
  .catch(error => {
    // Handle any errors that occurred during the request
    console.error('Controller request error:', error);
  });
}