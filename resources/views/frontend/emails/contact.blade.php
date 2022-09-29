<!-- Complete Email template -->
<body style="background-color:white">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="550" bgcolor="white" style="border:2px solid black">
      <tbody>
        <tr>
          <td align="center">
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="col-550" width="550">
              <tbody>
                <tr>
                  <td align="center" style="background-color: #1E050B;
                                             height: 80px;">
                    <a href="#" style="text-decoration: none;">
                      <p style="color:white;
                                                    font-weight:bold;">
                        <a class="navbar-brand" href="{{ route('index') }}">
                          <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="img-responsive">
                        </a>
                      </p>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <tr style="height: 165px;">
          <td align="center" style="border: none;
                             padding-right: 20px;padding-left:20px">
            <p style="font-weight: bolder;font-size: 42px;
                                letter-spacing: 0.025em;
                                color:#B90A5B;font-family: system-ui;"> New Query! <br>
            <p style="font-weight: bolder;font-size: 32px;
                                letter-spacing: 0.025em;
                                color:black;font-family: system-ui;"> {{ $name }} </p>
                                <p style="font-weight: bolder;font-size: 32px;
                                letter-spacing: 0.025em;
                                color:black;font-family: system-ui;"> {{ $email }} </p>
            </p>
          </td>
        </tr>
        <tr>
          <td style="height: 150px;
                             padding: 20px;
                             border: none;
                             background-color: white;">
            <h2 style="text-align: center;
                                 align-items: center;font-family: system-ui;">Subject: {{ $subject }} </h2>
            <p class="data" style="text-align: center;
                                align-items: center;
                                font-size: 15px;
                                padding-bottom: 12px;font-family: system-ui;">Message: {!! $messag !!}</p>
            <p style="text-align: center">
              <a href="{{ route('login') }}" style="text-decoration: none;
                                    color:black;
                                    border: 2px solid #A80033;
                                    padding: 10px 30px;
                                    font-weight: bold;font-family: system-ui;"> Login </a>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding-top:40px;font-family:'Open Sans', Arial, sans-serif;font-size:11px; line-height:18px; color:#999999;" valign="top" align="center">
            <a href="{{ route('privacy-policy') }}" target="_blank" style="color:#999999;
            text-decoration:underline;">PRIVACY POLICY</a> | <a href="{{ route('terms-and-conditions') }}" target="_blank" style="color:#999999; text-decoration:underline;">TERMS & CONDITIONS</a>
            <br> © 2022 Sugarsweeps. All Rights Reserved.
          </td>
        </tr>
      </tbody>
    </table>
    </td>
    </tr>
    <tr>
      <td class="em_hide" style="line-height:1px;
                   min-width:700px;
                   background-color:#ffffff;">
        <img alt="" src="images/spacer.gif" style="max-height:1px;
                min-height:1px;
                display:block;
                width:700px;
                min-width:700px;" width="700" border="0" height="1">
      </td>
    </tr>
    </tbody>
    </table>
  </body>
