<?php

//set all @required values

$set_product_link = "https://www.flipkart.com/flipkart-smartbuy-microfibre-solid-sleeping-pillow-pack-2/p/itm0c0937d6194e9?pid=PLWFZ42H5QWD2DWX&lid=LSTPLWFZ42H5QWD2DWXAVIPSL&marketplace=FLIPKART&pageUID=1598887936056";

$set_cookie = "T=BR%3Ackbka3b4f0me27l1tet5sgbpy.1592454161679; vw=360; dpr=3; AMCVS_17EB401053DAF4840A490D4C%40AdobeOrg=1; s_cc=true; vh=670; gpv_pn=ProductViewPage%3AMobile; gpv_pn_t=Product; S=d1t10P0o/Pz9dPz8aP1k/PngTPzUW7HXpwinpAm0QssBHA2+M40L1iRRR20kSvQqR6YXxojavvfh9ryDNrtXXQilqTA==; SN=VI62C91D79B7D2432785F8E443ECF8B920.TOKA5C88D2643EB4FFB9B296A46D6FE78CE.1598773194.LI; s_sq=flipkart-mob-web%3D%2526pid%253DProductViewPage%25253AMobile%2526pidt%253D1%2526oid%253Dfunctiongr%252528%252529%25257B%25257D%2526oidt%253D2%2526ot%253DDIV; AMCV_17EB401053DAF4840A490D4C%40AdobeOrg=-227196251%7CMCIDTS%7C18505%7CMCMID%7C68724336241997605816528412656874269407%7CMCAID%7CNONE%7CMCOPTOUT-1598780398s%7CNONE"; 


$parse = parse_url($set_product_link);

parse_str($parse['query'], $query);

$set_product_id = $query['pid'];

$cart_context = $query['lid'];

$quantity = "2";


//do not change/modify these headers
//@required

$headers = array('Content-type: application/json','X-User-Agent: Mozilla/5.0 (Linux; Android 10; MI567 Build/KQ1.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/830.90.3.96 Mobile Safari/537.36 FKUA/msite/0.0.1/msite/Mobile','Cookie: '.$set_cookie.'');

$headers2 = array('Content-type: application/x-www-form-urlencoded','X-User-Agent: Mozilla/5.0 (Linux; Android 10; MI567 Build/KQ1.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/830.90.3.96 Mobile Safari/537.36 FKUA/msite/0.0.1/msite/Mobile','Cookie: '.$set_cookie.'');


?>