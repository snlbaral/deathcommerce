<?php


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
        ["name"=>"Correios "],
        ["name"=>"Custom Shipping "],
        ["name"=>"Pick up Products "],
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
    return [
        [
        "country" => "Afghanistan", 
        "currency_code" => "AFN" 
        ], 
        [
        "country" => "Albania", 
        "currency_code" => "ALL" 
        ], 
        [
        "country" => "Algeria", 
        "currency_code" => "DZD" 
        ], 
        [
        "country" => "American Samoa", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Andorra", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Angola", 
        "currency_code" => "AOA" 
        ], 
        [
        "country" => "Anguilla", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Antarctica", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Antigua and Barbuda", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Argentina", 
        "currency_code" => "ARS" 
        ], 
        [
        "country" => "Armenia", 
        "currency_code" => "AMD" 
        ], 
        [
        "country" => "Aruba", 
        "currency_code" => "AWG" 
        ], 
        [
        "country" => "Australia", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "Austria", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Azerbaijan", 
        "currency_code" => "AZN" 
        ], 
        [
        "country" => "Bahamas", 
        "currency_code" => "BSD" 
        ], 
        [
        "country" => "Bahrain", 
        "currency_code" => "BHD" 
        ], 
        [
        "country" => "Bangladesh", 
        "currency_code" => "BDT" 
        ], 
        [
        "country" => "Barbados", 
        "currency_code" => "BBD" 
        ], 
        [
        "country" => "Belarus", 
        "currency_code" => "BYR" 
        ], 
        [
        "country" => "Belgium", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Belize", 
        "currency_code" => "BZD" 
        ], 
        [
        "country" => "Benin", 
        "currency_code" => "XOF" 
        ], 
        [
        "country" => "Bermuda", 
        "currency_code" => "BMD" 
        ], 
        [
        "country" => "Bhutan", 
        "currency_code" => "BTN" 
        ], 
        [
        "country" => "Bolivia", 
        "currency_code" => "BOB" 
        ], 
        [
        "country" => "Bosnia and Herzegovina", 
        "currency_code" => "BAM" 
        ], 
        [
        "country" => "Botswana", 
        "currency_code" => "BWP" 
        ], 
        [
        "country" => "Bouvet Island", 
        "currency_code" => "NOK" 
        ], 
        [
        "country" => "Brazil", 
        "currency_code" => "BRL" 
        ], 
        [
        "country" => "British Indian Ocean Territory", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Brunei", 
        "currency_code" => "BND" 
        ], 
        [
        "country" => "Bulgaria", 
        "currency_code" => "BGN" 
        ], 
        [
        "country" => "Burkina Faso", 
        "currency_code" => "XOF" 
        ], 
        [
        "country" => "Burundi", 
        "currency_code" => "BIF" 
        ], 
        [
        "country" => "Cambodia", 
        "currency_code" => "KHR" 
        ], 
        [
        "country" => "Cameroon", 
        "currency_code" => "XAF" 
        ], 
        [
        "country" => "Canada", 
        "currency_code" => "CAD" 
        ], 
        [
        "country" => "Cape Verde", 
        "currency_code" => "CVE" 
        ], 
        [
        "country" => "Cayman Islands", 
        "currency_code" => "KYD" 
        ], 
        [
        "country" => "Central African Republic", 
        "currency_code" => "XAF" 
        ], 
        [
        "country" => "Chad", 
        "currency_code" => "XAF" 
        ], 
        [
        "country" => "Chile", 
        "currency_code" => "CLP" 
        ], 
        [
        "country" => "China", 
        "currency_code" => "CNY" 
        ], 
        [
        "country" => "Christmas Island", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "Cocos (Keeling) Islands", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "Colombia", 
        "currency_code" => "COP" 
        ], 
        [
        "country" => "Comoros", 
        "currency_code" => "KMF" 
        ], 
        [
        "country" => "Congo", 
        "currency_code" => "XAF" 
        ], 
        [
        "country" => "Cook Islands", 
        "currency_code" => "NZD" 
        ], 
        [
        "country" => "Costa Rica", 
        "currency_code" => "CRC" 
        ], 
        [
        "country" => "Croatia", 
        "currency_code" => "HRK" 
        ], 
        [
        "country" => "Cuba", 
        "currency_code" => "CUP" 
        ], 
        [
        "country" => "Cyprus", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Czech Republic", 
        "currency_code" => "CZK" 
        ], 
        [
        "country" => "Denmark", 
        "currency_code" => "DKK" 
        ], 
        [
        "country" => "Djibouti", 
        "currency_code" => "DJF" 
        ], 
        [
        "country" => "Dominica", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Dominican Republic", 
        "currency_code" => "DOP" 
        ], 
        [
        "country" => "East Timor", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Ecuador", 
        "currency_code" => "ECS" 
        ], 
        [
        "country" => "Egypt", 
        "currency_code" => "EGP" 
        ], 
        [
        "country" => "El Salvador", 
        "currency_code" => "SVC" 
        ], 
        [
        "country" => "England", 
        "currency_code" => "GBP" 
        ], 
        [
        "country" => "Equatorial Guinea", 
        "currency_code" => "XAF" 
        ], 
        [
        "country" => "Eritrea", 
        "currency_code" => "ERN" 
        ], 
        [
        "country" => "Estonia", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Ethiopia", 
        "currency_code" => "ETB" 
        ], 
        [
        "country" => "Falkland Islands", 
        "currency_code" => "FKP" 
        ], 
        [
        "country" => "Faroe Islands", 
        "currency_code" => "DKK" 
        ], 
        [
        "country" => "Fiji Islands", 
        "currency_code" => "FJD" 
        ], 
        [
        "country" => "Finland", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "France", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "French Guiana", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "French Polynesia", 
        "currency_code" => "XPF" 
        ], 
        [
        "country" => "French Southern territories", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Gabon", 
        "currency_code" => "XAF" 
        ], 
        [
        "country" => "Gambia", 
        "currency_code" => "GMD" 
        ], 
        [
        "country" => "Georgia", 
        "currency_code" => "GEL" 
        ], 
        [
        "country" => "Germany", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Ghana", 
        "currency_code" => "GHS" 
        ], 
        [
        "country" => "Gibraltar", 
        "currency_code" => "GIP" 
        ], 
        [
        "country" => "Greece", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Greenland", 
        "currency_code" => "DKK" 
        ], 
        [
        "country" => "Grenada", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Guadeloupe", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Guam", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Guatemala", 
        "currency_code" => "QTQ" 
        ], 
        [
        "country" => "Guinea", 
        "currency_code" => "GNF" 
        ], 
        [
        "country" => "Guinea-Bissau", 
        "currency_code" => "CFA" 
        ], 
        [
        "country" => "Guyana", 
        "currency_code" => "GYD" 
        ], 
        [
        "country" => "Haiti", 
        "currency_code" => "HTG" 
        ], 
        [
        "country" => "Heard Island and McDonald Islands", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "Holy See (Vatican City State)", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Honduras", 
        "currency_code" => "HNL" 
        ], 
        [
        "country" => "Hong Kong", 
        "currency_code" => "HKD" 
        ], 
        [
        "country" => "Hungary", 
        "currency_code" => "HUF" 
        ], 
        [
        "country" => "Iceland", 
        "currency_code" => "ISK" 
        ], 
        [
        "country" => "India", 
        "currency_code" => "INR" 
        ], 
        [
        "country" => "Indonesia", 
        "currency_code" => "IDR" 
        ], 
        [
        "country" => "Iran", 
        "currency_code" => "IRR" 
        ], 
        [
        "country" => "Iraq", 
        "currency_code" => "IQD" 
        ], 
        [
        "country" => "Ireland", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Israel", 
        "currency_code" => "ILS" 
        ], 
        [
        "country" => "Italy", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Ivory Coast", 
        "currency_code" => "XOF" 
        ], 
        [
        "country" => "Jamaica", 
        "currency_code" => "JMD" 
        ], 
        [
        "country" => "Japan", 
        "currency_code" => "JPY" 
        ], 
        [
        "country" => "Jordan", 
        "currency_code" => "JOD" 
        ], 
        [
        "country" => "Kazakhstan", 
        "currency_code" => "KZT" 
        ], 
        [
        "country" => "Kenya", 
        "currency_code" => "KES" 
        ], 
        [
        "country" => "Kiribati", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "Kuwait", 
        "currency_code" => "KWD" 
        ], 
        [
        "country" => "Kyrgyzstan", 
        "currency_code" => "KGS" 
        ], 
        [
        "country" => "Laos", 
        "currency_code" => "LAK" 
        ], 
        [
        "country" => "Latvia", 
        "currency_code" => "LVL" 
        ], 
        [
        "country" => "Lebanon", 
        "currency_code" => "LBP" 
        ], 
        [
        "country" => "Lesotho", 
        "currency_code" => "LSL" 
        ], 
        [
        "country" => "Liberia", 
        "currency_code" => "LRD" 
        ], 
        [
        "country" => "Libyan Arab Jamahiriya", 
        "currency_code" => "LYD" 
        ], 
        [
        "country" => "Liechtenstein", 
        "currency_code" => "CHF" 
        ], 
        [
        "country" => "Lithuania", 
        "currency_code" => "LTL" 
        ], 
        [
        "country" => "Luxembourg", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Macau", 
        "currency_code" => "MOP" 
        ], 
        [
        "country" => "North Macedonia", 
        "currency_code" => "MKD" 
        ], 
        [
        "country" => "Madagascar", 
        "currency_code" => "MGF" 
        ], 
        [
        "country" => "Malawi", 
        "currency_code" => "MWK" 
        ], 
        [
        "country" => "Malaysia", 
        "currency_code" => "MYR" 
        ], 
        [
        "country" => "Maldives", 
        "currency_code" => "MVR" 
        ], 
        [
        "country" => "Mali", 
        "currency_code" => "XOF" 
        ], 
        [
        "country" => "Malta", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Marshall Islands", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Martinique", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Mauritania", 
        "currency_code" => "MRO" 
        ], 
        [
        "country" => "Mauritius", 
        "currency_code" => "MUR" 
        ], 
        [
        "country" => "Mayotte", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Mexico", 
        "currency_code" => "MXN" 
        ], 
        [
        "country" => "Micronesia, Federated States of", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Moldova", 
        "currency_code" => "MDL" 
        ], 
        [
        "country" => "Monaco", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Mongolia", 
        "currency_code" => "MNT" 
        ], 
        [
        "country" => "Montserrat", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Morocco", 
        "currency_code" => "MAD" 
        ], 
        [
        "country" => "Mozambique", 
        "currency_code" => "MZN" 
        ], 
        [
        "country" => "Myanmar", 
        "currency_code" => "MMR" 
        ], 
        [
        "country" => "Namibia", 
        "currency_code" => "NAD" 
        ], 
        [
        "country" => "Nauru", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "Nepal", 
        "currency_code" => "NPR" 
        ], 
        [
        "country" => "Netherlands", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Netherlands Antilles", 
        "currency_code" => "ANG" 
        ], 
        [
        "country" => "New Caledonia", 
        "currency_code" => "XPF" 
        ], 
        [
        "country" => "New Zealand", 
        "currency_code" => "NZD" 
        ], 
        [
        "country" => "Nicaragua", 
        "currency_code" => "NIO" 
        ], 
        [
        "country" => "Niger", 
        "currency_code" => "XOF" 
        ], 
        [
        "country" => "Nigeria", 
        "currency_code" => "NGN" 
        ], 
        [
        "country" => "Niue", 
        "currency_code" => "NZD" 
        ], 
        [
        "country" => "Norfolk Island", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "North Korea", 
        "currency_code" => "KPW" 
        ], 
        [
        "country" => "Northern Ireland", 
        "currency_code" => "GBP" 
        ], 
        [
        "country" => "Northern Mariana Islands", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Norway", 
        "currency_code" => "NOK" 
        ], 
        [
        "country" => "Oman", 
        "currency_code" => "OMR" 
        ], 
        [
        "country" => "Pakistan", 
        "currency_code" => "PKR" 
        ], 
        [
        "country" => "Palau", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Palestine", 
        "currency_code" => null 
        ], 
        [
        "country" => "Panama", 
        "currency_code" => "PAB" 
        ], 
        [
        "country" => "Papua New Guinea", 
        "currency_code" => "PGK" 
        ], 
        [
        "country" => "Paraguay", 
        "currency_code" => "PYG" 
        ], 
        [
        "country" => "Peru", 
        "currency_code" => "PEN" 
        ], 
        [
        "country" => "Philippines", 
        "currency_code" => "PHP" 
        ], 
        [
        "country" => "Pitcairn Islands", 
        "currency_code" => "NZD" 
        ], 
        [
        "country" => "Poland", 
        "currency_code" => "PLN" 
        ], 
        [
        "country" => "Portugal", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Puerto Rico", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Qatar", 
        "currency_code" => "QAR" 
        ], 
        [
        "country" => "Reunion", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Romania", 
        "currency_code" => "RON" 
        ], 
        [
        "country" => "Russian Federation", 
        "currency_code" => "RUB" 
        ], 
        [
        "country" => "Rwanda", 
        "currency_code" => "RWF" 
        ], 
        [
        "country" => "Saint Helena", 
        "currency_code" => "SHP" 
        ], 
        [
        "country" => "Saint Kitts and Nevis", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Saint Lucia", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Saint Pierre and Miquelon", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Saint Vincent and the Grenadines", 
        "currency_code" => "XCD" 
        ], 
        [
        "country" => "Samoa", 
        "currency_code" => "WST" 
        ], 
        [
        "country" => "San Marino", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Sao Tome and Principe", 
        "currency_code" => "STD" 
        ], 
        [
        "country" => "Saudi Arabia", 
        "currency_code" => "SAR" 
        ], 
        [
        "country" => "Scotland", 
        "currency_code" => "GBP" 
        ], 
        [
        "country" => "Senegal", 
        "currency_code" => "XOF" 
        ], 
        [
        "country" => "Serbia", 
        "currency_code" => "RSD" 
        ], 
        [
        "country" => "Seychelles", 
        "currency_code" => "SCR" 
        ], 
        [
        "country" => "Sierra Leone", 
        "currency_code" => "SLL" 
        ], 
        [
        "country" => "Singapore", 
        "currency_code" => "SGD" 
        ], 
        [
        "country" => "Slovakia", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Slovenia", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Solomon Islands", 
        "currency_code" => "SBD" 
        ], 
        [
        "country" => "Somalia", 
        "currency_code" => "SOS" 
        ], 
        [
        "country" => "South Africa", 
        "currency_code" => "ZAR" 
        ], 
        [
        "country" => "South Georgia and the South Sandwich Islands", 
        "currency_code" => "GBP" 
        ], 
        [
        "country" => "South Korea", 
        "currency_code" => "KRW" 
        ], 
        [
        "country" => "South Sudan", 
        "currency_code" => "SSP" 
        ], 
        [
        "country" => "Spain", 
        "currency_code" => "EUR" 
        ], 
        [
        "country" => "Sri Lanka", 
        "currency_code" => "LKR" 
        ], 
        [
        "country" => "Sudan", 
        "currency_code" => "SDG" 
        ], 
        [
        "country" => "Suriname", 
        "currency_code" => "SRD" 
        ], 
        [
        "country" => "Svalbard and Jan Mayen", 
        "currency_code" => "NOK" 
        ], 
        [
        "country" => "Swaziland", 
        "currency_code" => "SZL" 
        ], 
        [
        "country" => "Sweden", 
        "currency_code" => "SEK" 
        ], 
        [
        "country" => "Switzerland", 
        "currency_code" => "CHF" 
        ], 
        [
        "country" => "Syria", 
        "currency_code" => "SYP" 
        ], 
        [
        "country" => "Tajikistan", 
        "currency_code" => "TJS" 
        ], 
        [
        "country" => "Tanzania", 
        "currency_code" => "TZS" 
        ], 
        [
        "country" => "Thailand", 
        "currency_code" => "THB" 
        ], 
        [
        "country" => "The Democratic Republic of Congo", 
        "currency_code" => "CDF" 
        ], 
        [
        "country" => "Togo", 
        "currency_code" => "XOF" 
        ], 
        [
        "country" => "Tokelau", 
        "currency_code" => "NZD" 
        ], 
        [
        "country" => "Tonga", 
        "currency_code" => "TOP" 
        ], 
        [
        "country" => "Trinidad and Tobago", 
        "currency_code" => "TTD" 
        ], 
        [
        "country" => "Tunisia", 
        "currency_code" => "TND" 
        ], 
        [
        "country" => "Turkey", 
        "currency_code" => "TRY" 
        ], 
        [
        "country" => "Turkmenistan", 
        "currency_code" => "TMT" 
        ], 
        [
        "country" => "Turks and Caicos Islands", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Tuvalu", 
        "currency_code" => "AUD" 
        ], 
        [
        "country" => "Uganda", 
        "currency_code" => "UGX" 
        ], 
        [
        "country" => "Ukraine", 
        "currency_code" => "UAH" 
        ], 
        [
        "country" => "United Arab Emirates", 
        "currency_code" => "AED" 
        ], 
        [
        "country" => "United Kingdom", 
        "currency_code" => "GBP" 
        ], 
        [
        "country" => "United States", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "United States Minor Outlying Islands", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Uruguay", 
        "currency_code" => "UYU" 
        ], 
        [
        "country" => "Uzbekistan", 
        "currency_code" => "UZS" 
        ], 
        [
        "country" => "Vanuatu", 
        "currency_code" => "VUV" 
        ], 
        [
        "country" => "Venezuela", 
        "currency_code" => "VEF" 
        ], 
        [
        "country" => "Vietnam", 
        "currency_code" => "VND" 
        ], 
        [
        "country" => "Virgin Islands, British", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Virgin Islands, U.S.", 
        "currency_code" => "USD" 
        ], 
        [
        "country" => "Wales", 
        "currency_code" => "GBP" 
        ], 
        [
        "country" => "Wallis and Futuna", 
        "currency_code" => "XPF" 
        ], 
        [
        "country" => "Western Sahara", 
        "currency_code" => "MAD" 
        ], 
        [
        "country" => "Yemen", 
        "currency_code" => "YER" 
        ], 
        [
        "country" => "Zambia", 
        "currency_code" => "ZMW" 
        ], 
        [
        "country" => "Zimbabwe", 
        "currency_code" => "ZWD" 
        ] 
    ];
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