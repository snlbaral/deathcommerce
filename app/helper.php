<?php
use App\Models\Country;



function getPaymentGateways() {
    return [
        ["name"=>"Stripe"],
        ["name"=>"PayPal"],
        ["name"=>"Paystack"],
        ["name"=>"Flutterwave"],
        ["name"=>"RazorPay"],
        ["name"=>"Paytm"],
        ["name"=>"Mercado Pago"],
        ["name"=>"Mollie"],
        ["name"=>"Skrill"],
        ["name"=>"CoinGate"],
        ["name"=>"Toyyibpay"],
        ["name"=>"Payfast"],
    ];
}

function getDeliveryMethods() {
    return [
        ["name"=>"Correios", "slug"=>"correios"],
        ["name"=>"Custom Shipping", "slug"=>"custom-shipping"],
        ["name"=>"Pick up Products", "slug"=>"pick-up-products"],
    ];
}

function getCorreiosMethods() {
    return [
        ["name"=>"PAC","slug"=>"pac"],
        ["name"=>"SEDEX","slug"=>"sedex"],
        ["name"=>"Mini Envios", "slug"=>"mini_envios"],
    ];
}

function getWeightDimensionsInput() {
    return [
        ["name"=>"Weight","slug"=>"weight", "measurement"=>"kg"],
        ["name"=>"Length","slug"=>"length", "measurement"=>"cm"],
        ["name"=>"Height","slug"=>"height", "measurement"=>"cm"],
        ["name"=>"Width","slug"=>"width", "measurement"=>"cm"],
    ];
}


function pixelSourceCode($platform, $pixelId)
{
    // Facebook Pixel script
    if ($platform === 'facebook') {
        $script = "
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '%s');
                fbq('track', 'PageView');
            </script>

            <noscript><img height='1' width='1' style='display:none' src='https://www.facebook.com/tr?id=%d&ev=PageView&noscript=1'/></noscript>
        ";

        return sprintf($script, $pixelId, $pixelId);
    }


    // Twitter Pixel script
    if ($platform === 'twitter') {
        $script = "
        <script>
        !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
        },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
        a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
        twq('config','%s');
        </script>
        ";

        return sprintf($script, $pixelId);
    }


    // Linkedin Pixel script
    if ($platform === 'linkedin') {
        $script = "
            <script type='text/javascript'>
                _linkedin_data_partner_id = %d;
            </script>
            <script type='text/javascript'>
                (function () {
                    var s = document.getElementsByTagName('script')[0];
                    var b = document.createElement('script');
                    b.type = 'text/javascript';
                    b.async = true;
                    b.src = 'https://snap.licdn.com/li.lms-analytics/insight.min.js';
                    s.parentNode.insertBefore(b, s);
                })();
            </script>
            <noscript><img height='1' width='1' style='display:none;' alt='' src='https://dc.ads.linkedin.com/collect/?pid=%d&fmt=gif'/></noscript>
        ";

        return sprintf($script, $pixelId, $pixelId);
    }


    // Pinterest Pixel script
    if ($platform === 'pinterest') {
        $script = "
        <!-- Pinterest Tag -->
        <script>
        !function(e){if(!window.pintrk){window.pintrk = function () {
        window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
          n=window.pintrk;n.queue=[],n.version='3.0';var
          t=document.createElement('script');t.async=!0,t.src=e;var
          r=document.getElementsByTagName('script')[0];
          r.parentNode.insertBefore(t,r)}}('https://s.pinimg.com/ct/core.js');
        pintrk('load', '%s');
        pintrk('page');
        </script>
        <noscript>
        <img height='1' width='1' style='display:none;' alt=''
          src='https://ct.pinterest.com/v3/?event=init&tid=2613174167631&pd[em]=<hashed_email_address>&noscript=1' />
        </noscript>
        <!-- end Pinterest Tag -->

        ";

        return sprintf($script, $pixelId, $pixelId);
    }


    // Quora Pixel script
    if ($platform === 'quora') {
        $script = "
           <script>
                !function (q, e, v, n, t, s) {
                    if (q.qp) return;
                    n = q.qp = function () {
                        n.qp ? n.qp.apply(n, arguments) : n.queue.push(arguments);
                    };
                    n.queue = [];
                    t = document.createElement(e);
                    t.async = !0;
                    t.src = v;
                    s = document.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s);
                }(window, 'script', 'https://a.quora.com/qevents.js');
                qp('init', %s);
                qp('track', 'ViewContent');
            </script>

            <noscript><img height='1' width='1' style='display:none' src='https://q.quora.com/_/ad/%d/pixel?tag=ViewContent&noscript=1'/></noscript>
        ";

        return sprintf($script, $pixelId, $pixelId);
    }



    // Bing Pixel script
    if ($platform === 'bing') {
        $script = '
            <script>
            (function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[] ,f=function(){var o={ti:"%d"}; o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")} ,n=d.createElement(t),n.src=r,n.async=1,n.onload=n .onreadystatechange=function() {var s=this.readyState;s &&s!=="loaded"&& s!=="complete"||(f(),n.onload=n. onreadystatechange=null)},i= d.getElementsByTagName(t)[0],i. parentNode.insertBefore(n,i)})(window,document,"script"," //bat.bing.com/bat.js","uetq");
            </script>
            <noscript><img src="//bat.bing.com/action/0?ti=%d&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>
        ';

        return sprintf($script, $pixelId, $pixelId);
    }



    // Google adwords Pixel script
    if ($platform === 'google-adwords') {
        $script = "
            <script type='text/javascript'>

            var google_conversion_id = '%s';
            var google_custom_params = window.google_tag_params;
            var google_remarketing_only = true;

            </script>
            <script type='text/javascript' src='//www.googleadservices.com/pagead/conversion.js'>
            </script>
            <noscript>
            <div style='display:inline;'>
            <img height='1' width='1' style='border-style:none;' alt='' src='//googleads.g.doubleclick.net/pagead/viewthroughconversion/%s/?guid=ON&amp;script=0'/>
            </div>
            </noscript>
        ";

        return sprintf($script, $pixelId, $pixelId);
    }


    // Google tag manager Pixel script
    if ($platform === 'google-tag-manager') {
        $script = "
            <script async src='https://www.googletagmanager.com/gtag/js?id=%s'></script>
            <script>

              window.dataLayer = window.dataLayer || [];

              function gtag(){dataLayer.push(arguments);}

              gtag('js', new Date());

              gtag('config', '%s');

            </script>
        ";

        return sprintf($script, $pixelId, $pixelId);
    }

    //snapchat
    if ($platform === 'snapchat') {
        $script = " <script type='text/javascript'>
        (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
        {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
        a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
        r.src=n;var u=t.getElementsByTagName(s)[0];
        u.parentNode.insertBefore(r,u);})(window,document,
        'https://sc-static.net/scevent.min.js');

        snaptr('init', '%s', {
        'user_email': '__INSERT_USER_EMAIL__'
        });

        snaptr('track', 'PAGE_VIEW');

        </script>";
        return sprintf($script, $pixelId, $pixelId);
    }

    //tiktok
    if ($platform === 'tiktok') {
        $script = " <script>
        !function (w, d, t) {
          w.TiktokAnalyticsObject=t;
          var ttq=w[t]=w[t]||[];
          ttq.methods=['page','track','identify','instances','debug','on','off','once','ready','alias','group','enableCookie','disableCookie'],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};
          for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;
         n++)ttq.setAndDefer(e,ttq.methods[n]);
         return e},ttq.load=function(e,n){var i='https://analytics.tiktok.com/i18n/pixel/events.js';
        ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};
        var o=document.createElement('script');
        o.type='text/javascript',o.async=!0,o.src=i+'?sdkid='+e+'&lib='+t;
        var a=document.getElementsByTagName('script')[0];
        a.parentNode.insertBefore(o,a)};

          ttq.load('%s');
          ttq.page();
        }(window, document, 'ttq');
        </script>";

        return sprintf($script, $pixelId, $pixelId);
    }




}


function getCountriesList() {
    return Country::get();
}


// function get currency symbol by currency code
function getCurrencySymbol($currency = '')
{
    $symbols = array(
        'AED' => '&#1583;.&#1573;', // ?
        'AFN' => '&#65;&#102;',
        'ALL' => '&#76;&#101;&#107;',
        'AMD' => '&#1423;',
        'ANG' => '&#402;',
        'AOA' => '&#75;&#122;', // ?
        'ARS' => '&#36;',
        'AUD' => '&#36;',
        'AWG' => '&#402;',
        'AZN' => '&#1084;&#1072;&#1085;',
        'BAM' => '&#75;&#77;',
        'BBD' => '&#36;',
        'BDT' => '&#2547;', // ?
        'BGN' => '&#1083;&#1074;',
        'BHD' => '.&#1583;.&#1576;', // ?
        'BIF' => '&#70;&#66;&#117;', // ?
        'BMD' => '&#36;',
        'BND' => '&#36;',
        'BOB' => '&#36;&#98;',
        'BRL' => '&#82;&#36;',
        'BSD' => '&#36;',
        'BTC' => '&#3647;',
        'BTN' => '&#78;&#117;&#46;', // ?
        'BWP' => '&#80;',
        'BYR' => '&#112;&#46;',
        'BYN' => '&#66;&#114;',
        'BZD' => '&#66;&#90;&#36;',
        'CAD' => '&#36;',
        'CDF' => '&#70;&#67;',
        'CHF' => '&#67;&#72;&#70;',
        'CLF' => '', // ?
        'CLP' => '&#36;',
        'CNY' => '&#165;',
        'COP' => '&#36;',
        'CRC' => '&#8353;',
        'CUC' => '&#8396;',
        'CUP' => '&#8396;',
        'CVE' => '&#36;', // ?
        'CZK' => '&#75;&#269;',
        'DJF' => '&#70;&#100;&#106;', // ?
        'DKK' => '&#107;&#114;',
        'DOP' => '&#82;&#68;&#36;',
        'DZD' => '&#1583;&#1580;', // ?
        'EGP' => '&#163;',
        'ERN' => '&#78;&#102;&#107;', // ?
        'ETB' => '&#66;&#114;',
        'EUR' => '&#8364;',
        'FJD' => '&#36;',
        'FKP' => '&#163;',
        'GBP' => '&#163;',
        'GEL' => '&#4314;', // ?
        'GGP' => '&#163;',
        'GHS' => '&#162;',
        'GIP' => '&#163;',
        'GMD' => '&#68;', // ?
        'GNF' => '&#70;&#71;', // ?
        'GTQ' => '&#81;',
        'GYD' => '&#36;',
        'HKD' => '&#36;',
        'HNL' => '&#76;',
        'HRK' => '&#107;&#110;',
        'HTG' => '&#71;', // ?
        'PKE' => '&#36;',
        'HUF' => '&#70;&#116;',
        'IDR' => '&#82;&#112;',
        'ILS' => '&#8362;',
        'IMP' => '&#163;',
        'INR' => '&#8377;',
        'IQD' => '&#1593;.&#1583;', // ?
        'IRR' => '&#65020;',
        'IRT' => '&#65020;',
        'ISK' => '&#107;&#114;',
        'JEP' => '&#163;',
        'JMD' => '&#74;&#36;',
        'JOD' => '&#74;&#68;', // ?
        'JPY' => '&#165;',
        'KES' => '&#75;&#83;&#104;', // ?
        'KGS' => '&#1083;&#1074;',
        'KHR' => '&#6107;',
        'KMF' => '&#67;&#70;', // ?
        'KPW' => '&#8361;',
        'KRW' => '&#8361;',
        'KWD' => '&#1583;.&#1603;', // ?
        'KYD' => '&#36;',
        'KZT' => '&#1083;&#1074;',
        'LAK' => '&#8365;',
        'LBP' => '&#163;',
        'LKR' => '&#8360;',
        'LRD' => '&#36;',
        'LSL' => '&#76;', // ?
        'LTL' => '&#76;&#116;',
        'LVL' => '&#76;&#115;',
        'LYD' => '&#1604;.&#1583;', // ?
        'MAD' => '&#1583;.&#1605;.', //?
        'MDL' => '&#76;',
        'MGA' => '&#65;&#114;', // ?
        'MKD' => '&#1076;&#1077;&#1085;',
        'MMK' => '&#75;',
        'MNT' => '&#8366;',
        'MOP' => '&#77;&#79;&#80;&#36;', // ?
        'MRO' => '&#85;&#77;', // ?
        'MUR' => '&#8360;', // ?
        'MVR' => '.&#1923;', // ?
        'MWK' => '&#77;&#75;',
        'MXN' => '&#36;',
        'MYR' => '&#82;&#77;',
        'MZN' => '&#77;&#84;',
        'NAD' => '&#36;',
        'NGN' => '&#8358;',
        'NIO' => '&#67;&#36;',
        'NOK' => '&#107;&#114;',
        'NPR' => '&#8360;',
        'NZD' => '&#36;',
        'OMR' => '&#65020;',
        'PAB' => '&#66;&#47;&#46;',
        'PEN' => '&#83;&#47;&#46;',
        'PGK' => '&#75;', // ?
        'PHP' => '&#8369;',
        'PKR' => '&#8360;',
        'PLN' => '&#122;&#322;',
        'PYG' => '&#71;&#115;',
        'QAR' => '&#65020;',
        'RON' => '&#108;&#101;&#105;',
        'RSD' => '&#1044;&#1080;&#1085;&#46;',
        'RUB' => '&#1088;&#1091;&#1073;',
        'RWF' => '&#1585;.&#1587;',
        'SAR' => '&#65020;',
        'SBD' => '&#36;',
        'SCR' => '&#8360;',
        'SDG' => '&#163;', // ?
        'SEK' => '&#107;&#114;',
        'SGD' => '&#36;',
        'SHP' => '&#163;',
        'SLL' => '&#76;&#101;', // ?
        'SOS' => '&#83;',
        'SPL' => '&#163;',
        'SRD' => '&#36;',
        'STD' => '&#68;&#98;', // ?
        'SVC' => '&#36;',
        'SYP' => '&#163;',
        'SZL' => '&#76;', // ?
        'THB' => '&#3647;',
        'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
        'TMT' => '&#109;',
        'TND' => '&#1583;.&#1578;',
        'TOP' => '&#84;&#36;',
        'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
        'TTD' => '&#36;',
        'TVD' => '&#36;',
        'TWD' => '&#78;&#84;&#36;',
        'TZS' => '',
        'UAH' => '&#8372;',
        'UGX' => '&#85;&#83;&#104;',
        'USD' => '&#36;',
        'UYU' => '&#36;&#85;',
        'UZS' => '&#1083;&#1074;',
        'VEF' => '&#66;&#115;',
        'VND' => '&#8363;',
        'VUV' => '&#86;&#84;',
        'WST' => '&#87;&#83;&#36;',
        'XAF' => '&#70;&#67;&#70;&#65;',
        'XCD' => '&#36;',
        'XDR' => '',
        'XOF' => '',
        'XPF' => '&#70;',
        'ZAR' => '&#82;',
        'ZMW' => '&#90;&#75;',
    );
    if (isset($symbols[$currency])) {
        return $symbols[$currency];
    }
    return $currency;
}

?>