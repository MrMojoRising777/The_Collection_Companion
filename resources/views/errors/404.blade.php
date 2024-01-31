<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 - Page Not Found</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #b4311f;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    #notfound {
      text-align: center;
    }

    .notfound {
      max-width: 520px;
      width: 100%;
      line-height: 1.4;
      background-color: #b4311f;
      color: #e5c73b;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .notfound-404 h1 {
      font-size: 132px;
      color: #e5c73b;
      margin: 0;
    }

    .notfound h2 {
      font-size: 20px;
      font-weight: 400;
      margin: 10px 0;
    }

    .notfound p {
      font-size: 16px;
      margin: 0;
    }

    .notfound a {
      font-size: 14px;
      text-decoration: none;
      color: #e5c73b;
    }

    .notfound a:hover {
      color: #fff;
    }

    @media only screen and (max-width: 767px) {
      .notfound-404 h1 {
        font-size: 110px;
      }
    }
  </style>
</head>

<body>
  <div id="notfound">
    <div class="notfound">
      <div class="notfound-404">
        <h3>Oops! Page not found</h3>
        <h1><span>4</span><span>0</span><span>4</span></h1>
        <img class="w-full h-auto rounded-lg" src="{{ asset('images/sw_wait.png') }}" alt="Placeholder Image">
      </div>
      <h2>We are sorry, but the page you requested was not found</h2>
    </div>
  </div>
</body>

</html>
