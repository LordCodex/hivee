<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&display=swap"
      rel="stylesheet"
    />
    <title>Reset your Digital Advisor password</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */

      /*All the styling goes here*/

      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%;
      }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%;
      }
      table td {
        font-family: sans-serif;
        font-size: 14px;
        vertical-align: top;
      }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */
      :root {
        --primary-color: #336af3;
      }

      .body {
        background-color: #f6f6f6;
        width: 100%;
      }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        width: 580px;
      }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px;
      }
      .logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 64px;
        margin-bottom: 48px;
      }
      .logo img {
        width: 274px;
      }
      .title-img {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .title {
        font-family: 'Merriweather', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
      }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%;
      }

      .wrapper {
        box-sizing: border-box;
        padding: 40px;
      }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%;
      }
      .footer td,
      .footer p,
      .footer span,
      .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
      }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px;
      }

      h1 {
        font-weight: 300;
        text-align: center;
        text-transform: capitalize;
      }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px;
      }
      p li,
      ul li,
      ol li {
        list-style-position: inside;
        margin-left: 5px;
      }

      a {
        color: var(--primary-color);
        text-decoration: underline;
      }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        display: block;
        border: solid 1px var(--primary-color);
        border-radius: 60px;
        box-sizing: border-box;
        display: inline-block;
        font-size: 24px;
        font-weight: 500;
        margin: 0;
        padding: 8px 40px;
      }

      .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #ffffff;
      }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .center {
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .last {
        margin-bottom: 0;
      }

      .first {
        margin-top: 0;
      }

      .align-center {
        text-align: center;
      }

      .align-right {
        text-align: right;
      }

      .align-left {
        text-align: left;
      }

      .clear {
        clear: both;
      }

      .mt0 {
        margin-top: 0;
      }

      .mb0 {
        margin-bottom: 0;
      }

      .powered-by a {
        text-decoration: none;
      }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        margin: 20px 0;
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table.body h1 {
          font-size: 24px !important;
          margin-bottom: 10px !important;
        }
        table.body p,
        table.body ul,
        table.body ol,
        table.body td,
        table.body span,
        table.body a {
          font-size: 16px !important;
        }
        table.body .wrapper,
        table.body .article {
          padding: 10px !important;
        }
        table.body .content {
          padding: 0 !important;
        }
        table.body .container {
          padding: 0 !important;
          width: 100% !important;
        }
        table.body .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important;
        }
        table.body .btn table {
          width: 100% !important;
        }
        table.body .btn p {
          width: 100% !important;
        }
        table.body .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important;
        }
      }

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%;
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%;
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important;
        }
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit;
        }
      }
    </style>
  </head>
  <body>
    <div class="logo">
      <img
        src="data:image/png;base64,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"
        alt="Logo"
      />
    </div>
    <table
      role="presentation"
      border="0"
      cellpadding="0"
      cellspacing="0"
      class="body"
    >
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table
                    role="presentation"
                    border="0"
                    cellpadding="0"
                    cellspacing="0"
                  >
                    <tr>
                      <div class="title-img">
                        <img
                          src="data:image/png;base64,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"
                          alt="password reset"
                        />
                      </div>
                      <h1 class="title">Password Reset</h1>
                    </tr>
                    <tr>
                      <td>
                        <p>Hi Dear,</p>
                        <p>
                          A request was sent to change your password for your
                          Digital Advisor account. Here is your verification
                          code:
                        </p>
                        <div class="center" style="margin-top: 24px">
                          <div class="btn btn-primary">{{ $mailData['otp'] }}</div>
                        </div>
                        <div style="margin-top: 32px">
                          <b>Didn’t request to reset your password?</b>
                          <p>
                            This is a really simple email template. Its sole
                            purpose is to get the recipient to click the button
                            with no distractions.
                          </p>
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer">
              <table
                role="presentation"
                border="0"
                cellpadding="0"
                cellspacing="0"
              >
                <tr>
                  <td class="content-block">
                    <span class="apple-link"
                      >Company Inc, 3 Abbey Road, San Francisco CA 94102</span
                    >
                    <br />
                    Don't like these emails?
                    <a href="#">Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="http://htmlemail.io">HTMLemail</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>