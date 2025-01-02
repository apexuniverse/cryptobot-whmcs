
# CryptoBot for WHMCS

CryptoBot payment module for WHMCS client panel


## Demo

The module is used in [ApexNodes](https://client.apexnodes.xyz) and [MadHost](https://my.madhost.pw) client panel


## Installation

[Download the latest release](https://github.com/polen1kaa/cryptobot-whmcs/releases/tag/release) and upload the files from the archive to the following path:

```bash
/var/www/whmcs/modules/gateways/
```


## FAQ

#### How do I get a Token?

First, you need to create a new app and get API token. Open [@CryptoBot](http://t.me/CryptoBot?start=pay), go to [Crypto Pay](https://t.me/CryptoBot?start=pay) and tap **Create App** to get API Token.

#### How to enable Webhooks?

Open [@CryptoBot](http://t.me/CryptoBot?start=pay), go to [Crypto Pay](https://t.me/CryptoBot?start=pay) → My Apps, choose an app, then choose **Webhooks...** and tap 🌕 **Enable Webhooks**. Then enter the following link:
```bash
https://<YOUR WHMCS DOMAIN>/modules/gateways/callback/cryptobot.php
```

#### From which IP addresses are notifications sent via webhook?

Unfortunately, CryptoBot does not provide specific addresses. If you use a firewall (such as [Cloudflare](https://cloudflare.com)), create a custom WAF rule that will skip all requests sent to your handler URL(https://.../modules/gateways/callback/cryptobot.php).

#### I made a bypass rule for webhook, but that opened the backdoor to possible DDoS attacks. How to fix it?

Open [@CryptoBot](http://t.me/CryptoBot?start=pay), go to [Crypto Pay](https://t.me/CryptoBot?start=pay) → My Apps, choose an app, then choose **Webhooks...** and tap 🌕 **Enable Webhooks**. Then enter the following link:
```bash
https://<YOUR WHMCS DOMAIN>/modules/gateways/callback/cryptobot.php?<RANDOM CHARACTERS WITHOUT SPACES>
```

Characters after the ? sign count as GET parameters that only you know. Now make a custom WAF rule (e.g. via [Cloudflare](https://cloudflare.com)) that checks the full URL path:
```bash
(starts_with(http.request.full_uri, "https://<YOUR WHMCS DOMAIN>/modules/gateways/callback/cryptobot.php?<RANDOM CHARACTERS WITHOUT SPACES>"))
```
## Support

Any questions? Write me in Telegram: [@polenikaa](https://t.me/polenikaa)

