
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Page Not Found</title>
    <link href='/assets/fonts/fonts.css' rel='stylesheet' type='text/css'>
    <style>
    body {
      direction: rtl;
      font-family: Penobit;
      background: rgb(14, 30, 37);
      color: white;
      overflow: hidden;
      margin: 0;
      padding: 0;
    }

    h1 {
      margin: 0;
      font-size: 22px;
      line-height: 24px;
      font-family: Titr;
    }

    .main {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      width: 100vw;
    }

    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      width: 75%;
      max-width: 364px;
      padding: 24px;
      background: white;
      color: rgb(14, 30, 37);
      border-radius: 8px;
      box-shadow: 0 2px 4px 0 rgba(14, 30, 37, .16);
    }

    a {
      margin: 0;
      text-decoration: none;
      font-weight: 600;
      line-height: 24px;
      color: #007067;
    }

    a svg {
      position: relative;
      top: 2px;
    }

    a:hover,
    a:focus {
      text-decoration: underline;
      text-decoration-color: #f4bb00;
    }

    a:hover svg path{
      fill: #007067;
    }

    p:last-of-type {
      margin-bottom: 0;
    }

    </style>
  </head>
  <body>
    <div class="main">
      <div class="card">
        <div class="header">
          <h1>صفحه مورد نظر پیدا نشد!</h1>
        </div>
        <div class="body">
          <p>به نظر شما آدرس اشتباهی را وارد کردید، همچین صفحه ای در این سایت موجود نیست </p>
          <p>
            <a id="back-link" href="/">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path fill="#007067" d="M11.9998836,4.09370803 L8.55809517,7.43294953 C8.23531459,7.74611298 8.23531459,8.25388736 8.55809517,8.56693769 L12,11.9062921 L9.84187871,14 L4.24208544,8.56693751 C3.91930485,8.25388719 3.91930485,7.74611281 4.24208544,7.43294936 L9.84199531,2 L11.9998836,4.09370803 Z"/>
              </svg>
              بازگشت به سایت
             </a>
          </p>
          <hr><p>در صورتی که فکر میکنید اشتباهی شده میتوانید به ما گزارش دهید <a href="https://penobit.com/contact">تماس با پنوبیت</a>
          </p>
        </div>
      </div>
    </div>
    <script>
      (function() {
        if (document.referrer && document.location.host && document.referrer.match(new RegExp("^https?://" + document.location.host))) {
          document.getElementById("back-link").setAttribute("href", document.referrer);
        }
      })();
    </script>
  </body>
</html>
